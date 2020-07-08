<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'tag_name',
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
