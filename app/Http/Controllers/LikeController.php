<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class LikeController extends Controller
{
    public function toggleLike(Post $post)
    {
        $user = auth()->user();

        if ($post->likes()->where('user_id', $user->id)->exists()) {
            // Unlike
            $post->likes()->detach($user->id);
            return response()->json(['liked' => false, 'total_likes' => $post->likes()->count()]);
        } else {
            // Like
            $post->likes()->attach($user->id);
            return response()->json(['liked' => true, 'total_likes' => $post->likes()->count()]);
        }
    }
}
