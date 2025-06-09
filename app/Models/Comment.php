<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'photo_id',
        'comment_text',
    ];

    //Relasi ke User: komentar ini dibuat oleh satu user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Relasi ke Photo: komentar ini milik satu photo/post
    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }
}
