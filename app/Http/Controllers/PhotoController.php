<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;

class PhotoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'caption' => 'nullable|string|max:255', 
        ]);

        $path = $request->file('image')->store('photos', 'public');

        Photo::create([
            'image_path' => $path,
            'caption' => $request->input('caption'),
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Photo Uploaded!');

    }
    public function show(Post $post)
        {
        $post->loadCount('likes'); 
        return view('posts.show', compact('post'));
        }
}