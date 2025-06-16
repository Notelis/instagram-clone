<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
    'caption',
    'image_path',
    'user_id',
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}
    public function likes()
{
    return $this->hasMany(Like::class);
}


     public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
