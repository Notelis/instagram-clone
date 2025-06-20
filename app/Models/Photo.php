<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{

    protected $primaryKey = 'photo_id';
    
    protected $fillable = [
    'caption',
    'image_path',
    'user_id',
    ];

    protected $casts = [
    'is_archived' => 'boolean',
    ];

    // app/Models/Photo.php
    public function getRouteKeyName()
    {
        return 'photo_id';
    }

        public function user()
    {
        return $this->belongsTo(User::class);
    }

        public function likes()
    {
        return $this->hasMany(Like::class, 'photo_id', 'photo_id');
    }


    public function comments()
    {
        return $this->hasMany(Comment::class, 'photo_id', 'photo_id');
    }

    public function savedByUsers()
    {
        return $this->belongsToMany(User::class, 'photo_user', 'photo_id', 'user_id')->withTimestamps();
    }
}
