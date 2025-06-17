<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\SaveController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Models\Photo;

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);

// Profile (hanya jika login)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'showProfile']);
    Route::post('/profile/bio', [UserController::class, 'updateBio']);
});

// Upload
Route::get('/upload', function () {
    return view('upload');
});

// Menyimpan foto
Route::post('/photos', [PhotoController::class, 'store'])->name('photos.store');

// Menampilkan feed (semua foto)
Route::get('/feed', function () {
    $photos = \App\Models\Photo::with(['comments.user'])->latest()->get(); // <== PENTING
    return view('photos.feed', compact('photos'));
});

// Like
Route::middleware('auth')->post('/posts/{post}/like', [LikeController::class, 'toggleLike'])->name('posts.like');

// Archive, Save, Comment
Route::middleware('auth')->group(function () {
    // Archive
    Route::post('/photos/{photo}/archive', [ArchiveController::class, 'archive']);
    Route::post('/photos/{photo}/unarchive', [ArchiveController::class, 'unarchive']);
    Route::get('/archived-photos', [ArchiveController::class, 'archivedPhotos']);

    // Save
    Route::post('/photos/{photo}/save', [SaveController::class, 'save']);
    Route::post('/photos/{photo}/unsave', [SaveController::class, 'unsave']);
    Route::get('/saved-photos', [SaveController::class, 'savedPhotos']);

    // Comment (pakai route model binding Photo)
    Route::middleware('auth')->post('/photos/{photo}/comments', [CommentController::class, 'store'])->name('comments.store');
});
