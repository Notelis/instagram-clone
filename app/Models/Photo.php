<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
        protected $fillable = [
        'caption',
        'image_path',
    ];
    public function likes()
    {
    return $this->belongsToMany(User::class, 'likes')->withTimestamps();
    }


     public function savedByUsers()
    {
        return $this->belongsToMany(User::class, 'saved_photos')->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
