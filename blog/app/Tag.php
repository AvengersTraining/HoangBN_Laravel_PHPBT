<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'tag_name',
        'deleted_at',
    ];

    /**
     * Get users that belong to the tag
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get the posts belong to the tag
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
