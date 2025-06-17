<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'body', 'photo_id', 'user_id',
    ];

    // Relasi ke foto
    public function photo()
    {
        return $this->belongsTo(Photo::class, 'photo_id', 'photo_id');
    }

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
