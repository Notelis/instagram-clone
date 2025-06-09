<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Photo;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index($photoId)
    {
        $comments = Comment::where('photo_id', $photoId)->with('user')->latest()->get();
        return response()->json($comments);
    }

    public function store(Request $request, $photoId)
    {
        $request->validate([
            'comment_text' => 'required|string|max:255',
        ]);

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'photo_id' => $photoId,
            'comment_text' => $request->comment_text,
        ]);

        return response()->json([
            'message' => 'Komentar berhasil ditambahkan',
            'comment' => $comment->load('user'),
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        if ($comment->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'comment_text' => 'required|string|max:255',
        ]);

        $comment->update([
            'comment_text' => $request->comment_text,
        ]);

        return response()->json(['message' => 'Komentar berhasil diperbarui', 'comment' => $comment]);
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        if ($comment->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $comment->delete();

        return response()->json(['message' => 'Komentar berhasil dihapus']);
    }
}
