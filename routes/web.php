<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PhotoController;
use App\Models\Photo;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\SaveController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'showProfile']);
    Route::post('/profile/bio', [UserController::class, 'updateBio']);
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

Route::middleware('auth')->group(function () {
    // Archive
    Route::post('/photos/{id}/archive', [ArchiveController::class, 'archive']);
    Route::post('/photos/{id}/unarchive', [ArchiveController::class, 'unarchive']);
    Route::get('/archived-photos', [ArchiveController::class, 'archivedPhotos']);

    // Save
    Route::post('/photos/{id}/save', [SaveController::class, 'save']);
    Route::post('/photos/{id}/unsave', [SaveController::class, 'unsave']);
    Route::get('/saved-photos', [SaveController::class, 'savedPhotos']);
});

