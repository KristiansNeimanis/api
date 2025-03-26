<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CommentController extends Controller implements HasMiddleware
{
    public static function middleware() {
        return [
            new Middleware('auth:sanctum')
        ];
    }

    public function store(Request $request, Post $post)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $post = Post::find($post->id); // Get the post to comment on

        // Create the comment
        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->post_id = $post->id;
        $comment->body = $request->body;
        $comment->save();

        return ['success' => 'Comment added successfully!'];
    }
}
