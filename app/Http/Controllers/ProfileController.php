<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // update bio user
    // endpoint PUT /api/profile/bio
    public function updateBio(Request $request)
    {
        // validasi bio
        $request->validate([
            'bio' => 'nullable|string|max:150',
        ]);
       
        $user = $request->user();  // ambil data user yang sedang login
        $user->bio = $request->bio; // ambil value dari bio

        // save() method untuk commit perubahan ke database
        // update field updated_at dengan timestamp sekarang
        $user->save(); 

        // Return JSON response dengan data user yang udah ter-update
        return response()->json([
            'message' => 'Bio updated successfully',
            'user' => $user //$user sekarang udah include bio yang baru
        ]);
    }

    
}
