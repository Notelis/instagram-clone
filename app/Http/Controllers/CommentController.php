<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, $photo_id)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $comment = new Comment();
        $comment->body = $request->body;
        $comment->user_id = auth()->id();
        $comment->photo_id = $photo_id;
        $comment->save();

        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }
}
