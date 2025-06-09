<?php

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Photo;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $photoId)
    {
        $request->validate([
            'comment_text' => 'required|string|max:1000',
        ]);

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'photo_id' => $photoId,
            'comment_text' => $request->comment_text,
        ]);

        return response()->json($comment, 201);
    }

    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment); // Optional jika pakai policy

        $request->validate([
            'comment_text' => 'required|string|max:1000',
        ]);

        $comment->update([
            'comment_text' => $request->comment_text,
        ]);

        return response()->json($comment);
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment); // Optional jika pakai policy

        $comment->delete();

        return response()->json(['message' => 'Comment deleted']);
    }

    public function index($photoId)
    {
        $comments = Comment::where('photo_id', $photoId)->with('user')->latest()->get();
        return response()->json($comments);
    }
}