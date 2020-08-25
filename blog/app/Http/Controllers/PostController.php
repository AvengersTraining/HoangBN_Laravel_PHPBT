<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use Exception;
use App\Http\Requests\PostRequest;
use App\Http\Requests\VoteRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web')->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('user_id', Auth::user()->id)->latest()->with('tags')->get();

        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all('tag_name as value', 'id');

        return view('post.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        try {
            $timeCurrent = now();
            $data = [
                'user_id' => Auth::user()->id,
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'is_published' => $request->input('type') == 'publish' ? config('blog.posts.published') : config('blog.posts.un_published'),
            ];
            
            $post = Post::create($data);
            if ($post) {
                $tags = json_decode($request->input('tags'));
                $tagIds = [];
                foreach ($tags as $key => $tag) {
                    if (empty($tag->id)) {
                        $newTag = [
                            'tag_name' => $tag->value,
                            'created_at' => $timeCurrent,
                            'updated_at' => $timeCurrent,
                        ];

                        $tagIds[] = Tag::insertGetId($newTag);
                    } else {
                        $tagIds[] = $tag->id;
                    }
                }

                if (!empty($tagIds)) {
                    $post->tags()->attach($tagIds);
                }
            }

            return redirect()->route('posts.index');
        } catch (Exception $e) {
            Log::error($e);
            return redirect()->back()->with('error', 'Create post failure');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $totalVote = $this->countVote($post);
        $userVoted = false;
        if (Auth::check()) {
            $userVoted = $post->votedUsers()->where('user_id', Auth::user()->id)->first();
        }
        $tags = Tag::join('post_tag', 'tags.id', '=', 'post_tag.tag_id')
                ->where('post_tag.post_id', $post->id)
                ->get();

        $comments = $post->comments()->oldest()->whereNull('parent_comment_id')->with('user')->get();
        $replies = $post->comments()->oldest()->whereNotNull('parent_comment_id')->with('user')->get();
        $replies = $replies->groupBy('parent_comment_id');

        return view('post.show', compact('post', 'tags', 'totalVote', 'userVoted', 'comments', 'replies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updateVoted(VoteRequest $request, $id)
    {
        $type = $request->get('type');
        $post = Post::findOrFail($id);
        $voted = $post->votedUsers()->where('user_id', Auth::user()->id)->first();
        if ($voted) {
            if ($type == config('blog.posts.remove_vote')) {
                $post->votedUsers()->detach(Auth::user());
            } else {
                $post->votedUsers()->updateExistingPivot(Auth::user()->id, ['type' => $type]);
            }
        } else {
            $post->votedUsers()->attach(Auth::user()->id, ['type' => $type]);
        }

        return $this->countVote($post);
    }

    private function countVote(Post $post)
    {
        $upvotes = $post->votedUsers()->where('type', config('blog.posts.up_vote'))->count();
        $downvotes = $post->votedUsers()->where('type', config('blog.posts.down_vote'))->count();
        $totalVote = $upvotes - $downvotes;
        if ($totalVote > 0) {
            $totalVote = '+' . $totalVote;
        }

        return $totalVote;
    }
}
