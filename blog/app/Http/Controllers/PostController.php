<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use App\Http\Requests\PostRequest;
use App\Http\Requests\VoteRequest;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // Insert new post
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
        $userVoted = $post->votedUsers()->where('user_id', Auth::user()->id)->first();
        $tags = Tag::join('post_tag', 'tags.id', '=', 'post_tag.tag_id')
                ->where('post_tag.post_id', $post->id)
                ->get();

        return view('post.show', compact('post', 'tags', 'totalVote', 'userVoted'));
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
