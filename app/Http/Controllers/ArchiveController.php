<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Photo;
use Illuminate\Routing\Controller;

class ArchiveController extends Controller
{
    public function archive($id)
    {
        $photo = Photo::findOrFail($id);

        if ($photo->user_id != auth()->id()) {
            abort(403);
        }

        $photo->is_archived = true;
        $photo->save();

        return redirect()->back()->with('status', 'Foto diarsipkan!');
    }

    public function unarchive($id)
    {
        $photo = Photo::findOrFail($id);

        if ($photo->user_id != auth()->id()) {
            abort(403);
        }

        $photo->is_archived = false;
        $photo->save();

        return redirect()->back()->with('status', 'Foto dibuka dari arsip!');
    }

    public function archivedPhotos()
    {
        $photos = Photo::where('user_id', auth()->id())->where('is_archived', true)->get();

        return view('photos.archived', compact('photos'));
    }
}
