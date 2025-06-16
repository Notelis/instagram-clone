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

        $existingLike = Like::where('user_id', $user->id)
                            ->where('photo_id', $photo->id)
                            ->first();

        if ($existingLike) {
            $existingLike->delete();
        } else {
            Like::create([
                'user_id' => $user->id,
                'photo_id' => $photo->id,
            ]);
        }

        return redirect()->back();
    }
}
