<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\Http\Requests\FormRequestPost;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $parent = $request->comment_parent ? : null;
        $validated = $request->validate([
            'post_comment' => 'required'
        ]);

        $post->comments()->create([
            'user_id' => $request->user()->id,
            'comment' => $request->post_comment,
            'parent' => $parent,
        ]);

        return redirect()->back();
    }

    public function show(Comment $comment)
    {
        //
    }

    public function edit(Comment $comment)
    {
        //
    }

    public function update(Request $request, Comment $comment)
    {
        //
    }

    public function destroy(Comment $comment)
    {
        // ddd($comment);
        $comment->delete();
        return response()->json(null); 
    }
}
