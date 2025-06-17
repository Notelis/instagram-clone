<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Photo;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggleLike(Photo $photo)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->back()->with('error', 'You must be logged in to like a photo.');
        }

        $existingLike = Like::where('user_id', $user->user_id)
                            ->where('photo_id', $photo->photo_id)
                            ->first();

        if ($existingLike) {
            $existingLike->delete();
        } else {
            Like::create([
                'user_id' => $user->user_id,
                'photo_id' => $photo->photo_id,
            ]);
        }

        return redirect()->back();
    }
}
