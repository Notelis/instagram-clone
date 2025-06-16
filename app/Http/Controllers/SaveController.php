<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;    
use App\Models\Photo;

class SaveController extends Controller
{
    public function save($id)
    {
        $photo = Photo::findOrFail($id);
        auth()->user()->savedPhotos()->attach($photo);

        return redirect()->back()->with('status', 'Foto disimpan!');
    }

    public function unsave($id)
    {
        $photo = Photo::findOrFail($id);
        auth()->user()->savedPhotos()->detach($photo);

        return redirect()->back()->with('status', 'Foto dihapus dari simpanan!');
    }

    public function savedPhotos()
    {
        $photos = auth()->user()->savedPhotos()->get();

        return view('photos.saved', compact('photos'));
    }
}
