<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name',
        'display_name',
        'birthday',
        'phone_number',
        'address',
        'email',
        'password',
        'is_admin',
        'avatar',
        'status',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the posts for the user
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Get tags that belong to the user
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'user_tag')->withPivot('tag_id', 'user_id')->withTimestamps();
    }

    /**
     * Get the comments belong to user
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function commentedPosts()
    {
        return $this->belongsToMany(Post::class, 'comments')->withPivot('content', 'deleted_at')->withTimestamps();
    }

    public function votedPosts()
    {
        return $this->belongsToMany(Post::class, 'votes')->withPivot('type')->withTimestamps();
    }
}
