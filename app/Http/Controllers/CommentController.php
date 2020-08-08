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

    public function update(Request $request, Comment $comment)
    {
        $validated = $request->validate([
            'post_comment' => 'required'
        ]);
        $comment->update([
            'comment' => $request->post_comment
        ]);
        // ddd($validated);
        return redirect()->back();
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->back();
        // return response()->json(null); 
    }
}
