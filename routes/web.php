<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PhotoController;
use App\Models\Photo;

// redirect root to login
Route::get('/', function () {
    return redirect('/login');
});

// authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// protected routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::put('/profile/bio', [UserController::class, 'updateBio'])->name('profile.bio');
});

//Route::get('/', function () {
    //return view('welcome');
//});

Route::get('/upload', function () {
    return view('upload');
});

Route::post('/photos', [PhotoController::class, 'store'])->name('photos.store');

Route::get('/feed', function () {
    $photos = Photo::latest()->get(); // newest first
    return view('photos.feed', compact('photos'));
})->name('photos.feed');
Route::get('/photos/{photo}', function (Photo $photo) {
    return view('photos.feed', compact('photo'));
})->name('photos.feed');

Route::middleware('auth')->group(function () {
    Route::post('/posts/{post}/like', [LikeController::class, 'toggleLike'])->name('posts.like');
});

