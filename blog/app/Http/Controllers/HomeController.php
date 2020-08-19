<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        switch ($request->get('type')) {
            case config('blog.posts.type.newest'):
                $posts = $this->getPostNewest();
                break;
            case config('blog.posts.type.followings'):
            default:
                $posts = $this->getPostByTagFollowed();
                break;
        }
        $popularPosts = $this->getPopularPosts();

        return view('home', compact('posts', 'popularPosts'));
    }

    private function getPostByTagFollowed()
    {
        $user = auth()->user();
        $tagIds = $user->tags->map(function ($item) {
            return $item->tag_id = $item->pivot->tag_id;
        });

        $posts = Post::join('post_tag', 'posts.id', '=', 'post_tag.post_id')
            ->whereIn('post_tag.tag_id', $tagIds)
            ->published()
            ->latest('posts.created_at')
            ->with('user')
            ->paginate(config('blog.posts.post_limit'));

        return $posts;
    }

    private function getPostNewest()
    {
        $posts = Post::latest()->published()->paginate(config('blog.posts.post_limit'));
    
        return $posts;
    }

    private function getPopularPosts()
    {
        $posts = Post::orderBy('post_view', 'desc')
            ->published()
            ->with('user')
            ->limit(config('blog.posts.popular'))
            ->get();

        return $posts;
    }
}
