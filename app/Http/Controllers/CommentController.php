<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //
    
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required|string',
            'thread_id' => 'required|exists:threads,id',
        ]);

        $comment = new Comment();
        $comment->body = $request->input('body');
        $comment->thread_id = $request->input('thread_id');
        $comment->user_id = Auth::id();
        $comment->save();

        return redirect()->back()->with('success', 'Comment created successfully.');
    }

    public function markAsBestReply(Comment $comment)
    {
        // Check if the authenticated user is the owner of the thread
        if (auth()->user()->id !== $comment->thread->user_id) {
            return back()->with('error', 'You are not authorized to mark the best reply.');
        }
    
        $comment->update(['is_best_reply' => true]);
    
        return back()->with('success', 'Comment marked as the best reply.');
    }
    

}
