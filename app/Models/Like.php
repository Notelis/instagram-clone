<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['user_id', 'photo_id'];
    public $timestamps = true;

    public function photo()
    {
        return $this->belongsTo(Photo::class, 'photo_id', 'photo_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
