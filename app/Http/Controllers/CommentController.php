<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Photo $photo) // pakai Photo $photo, bukan id
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        Comment::create([
            'body' => $request->body,
            'user_id' => auth()->id(),
            'photo_id' => $photo->id, // tetap butuh id-nya untuk diisi
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }
}
