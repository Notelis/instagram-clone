<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $photo)
{
    $photo = Photo::findOrFail($photo); // cari model berdasarkan ID

    $request->validate([
        'comment_text' => 'required|string|max:1000',
    ]);

    Comment::create([
        'comment_text' => $request->comment_text,
        'user_id' => auth()->id(),
        'photo_id' => $photo->photo_id,
    ]);

    return back()->with('success', 'Komentar berhasil ditambahkan!');
}

}
