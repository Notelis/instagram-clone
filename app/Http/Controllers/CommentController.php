<?php

use App\Models\Comment;
use App\Models\Photo;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Photo $photo)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $comment = new Comment();
        $comment->body = $request->body;
        $comment->user_id = auth()->id(); // user yang login
        $comment->photo_id = $photo->id; // id foto yang dikomentari
        $comment->save();

        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }
}
