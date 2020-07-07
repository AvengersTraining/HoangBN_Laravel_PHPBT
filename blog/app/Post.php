<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'thumbnail',
        'post_vote',
        'post_view',
        'is_published',
    ];

    /**
     * Get the user that owns the post
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the tags belong to the post
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag')->withTimestamps();
    }

    /**
     * Get the comments belong to the post
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function commentedUsers()
    {
        return $this->belongsToMany(User::class, 'comments')->withPivot('content', 'deleted_at');
    }
}
