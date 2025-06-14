<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
     public function showProfile() {
        return view('profile', ['user' => Auth::user()]);
    }

    public function updateBio(Request $request) {
        $request->validate(['bio' => 'nullable|string']);

        $user = Auth::user();
        $user->bio = $request->bio;
        $user->save();

        return redirect('/profile')->with('success', 'Bio updated!');
    }
}
