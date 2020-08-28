<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        try {
            $comment = $request->get('comment');
            $data = [
                'user_id' => $comment['user_id'],
                'post_id' => $comment['post_id'],
                'content' => $comment['content'],
            ];

            if (!empty($comment['parentCommentId'])) {
                $data['parent_comment_id'] = $comment['parentCommentId'];
            }
            
            $result = Comment::create($data);
            $result->delete_url = route('comments.destroy', $result->id);
            
            return ['success' => $result];
        } catch (Exception $e) {
            Log::error($e);
            return ['success' => false];
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
        //
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
    public function update(Request $request, $id)
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
        $comment = Comment::findOrFail($id);
        $this->authorize('destroy', $comment);

        try {
            $comment->delete();
            return ['success' => true];
        } catch (Exception $e) {
            Log::error($e);
            return ['success' => false];
        }
    }
}
