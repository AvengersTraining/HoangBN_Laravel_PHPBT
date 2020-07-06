<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'content',
        'deleted',
    ];

    /**
     * Get the user that owns the comment
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the post that owns the comment
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function childComments()
    {
        return $this->hasMany(Comment::class);
    }
}
