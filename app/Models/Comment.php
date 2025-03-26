<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id', 'post_id', 'body'];

    // Define the relationship to the user who made the comment
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship to the post being commented on
    public function posts()
    {
        return $this->belongsTo(Post::class);
    }
}
