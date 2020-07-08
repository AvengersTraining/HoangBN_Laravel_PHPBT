<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'content',
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
        return $this->hasMany(Comment::class, 'parent_comment_id', 'id');
    }

    public function allChildComments()
    {
        return $this->childComments()->with('allChildComments');
    }
}
