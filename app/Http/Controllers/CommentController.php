<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller implements HasMiddleware
{
    public static function middleware() {
        return [
            new Middleware('auth:sanctum', except: ['show', 'index'])
        ];
    }

    public function store(Request $request, Post $post)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        // $post = Post::find($post->id); // Get the post to comment on

        // Create the comment
        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->post_id = $post->id;
        $comment->body = $request->body;
        $comment->save();

        return ['success' => 'Comment added successfully!'];
    }

    public function show(Post $post)
    {
        return $post->comments()->get();
    }
    public function index()
    {
        return Comment::all();
    }

    public function delete(Post $post, Comment $comment)
    {
        Gate::authorize('delete', $comment);

        // Delete the comment
        $comment->delete();

        return ['message' => 'comment has been deleted'];
    }
}
