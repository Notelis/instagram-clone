<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    ///** @use HasFactory<\Database\Factories\UserFactory> */
    //use HasFactory, Notifiable;

    use HasFactory, Notifiable;

    // Laravel uses "id" by default, but we want to use "user_id"
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    public $incrementing = true;
    protected $keyType = 'int';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'bio',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    //protected function casts(): array
    //{
        //return [
            //'email_verified_at' => 'datetime',
            //'password' => 'hashed',
        //];
    //}

    public function likedPosts()
{
    return $this->belongsToMany(Post::class, 'likes')->withTimestamps();
}

    public function savedPhotos()
{
    return $this->belongsToMany(Photo::class, 'saved_photos')->withTimestamps();
}

}
