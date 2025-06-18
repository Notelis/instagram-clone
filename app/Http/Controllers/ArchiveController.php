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

        if ($photo->is_archived) {
            return redirect()->back()->with('status', 'Foto sudah diarsipkan.');
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

        if (! $photo->is_archived) {
            return redirect()->back()->with('status', 'Foto belum diarsipkan.');
        }

        $photo->is_archived = false;
        $photo->save();

        return redirect()->back()->with('status', 'Foto dikeluarkan dari arsip!');
    }

    public function myArchivedPhotos()
    {
        $photos = Photo::where('user_id', auth()->id())
                        ->where('is_archived', true)
                        ->get();

        return view('photos.archived', compact('photos'));
    }

    public function showArchivedPhotos()
    {
    $photos = Photo::where('user_id', auth()->id())
                   ->where('is_archived', true)
                   ->latest()
                   ->get();

    return view('photos.archived', compact('photos'));
    }
}
