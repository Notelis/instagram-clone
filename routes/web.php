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
Route::post('/register', [AuthController::class, 'register'])->name('register');
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
    $search = request('search');
    $photos = Photo::with(['comments.user'])
        ->where(function ($query) {
            $query->where('is_archived', false)
                  ->orWhere(function ($q) {
                      $q->where('user_id', '!=', auth()->id())
                        ->where('is_archived', true);
                  });
        })
        ->when($search, function ($q) use ($search) {
            $q->where('caption', 'like', '%' . $search . '%');
        })
        ->latest()
        ->get();

    $user = Auth::user();
    return view('photos.feed', compact('photos', 'user'));
})->middleware('auth')->name('photos.feed');

// Like
Route::post('/photos/{photo}/like', [LikeController::class, 'toggleLike'])
    ->middleware('auth')
    ->name('photos.like');

// Archive, Save, Comment
Route::middleware('auth')->group(function () {
    // Archive
    Route::post('/photos/{id}/archive', [ArchiveController::class, 'archive'])->name('photos.archive');
    Route::post('/photos/{id}/unarchive', [ArchiveController::class, 'unarchive'])->name('photos.unarchive');
    Route::get('/my/archived', [ArchiveController::class, 'myArchivedPhotos'])->name('photos.archived');
    Route::get('/photos/archived', [ArchiveController::class, 'showArchivedPhotos'])->name('photos.archived');

    // Save
    Route::post('/photos/{photo}/save', [SaveController::class, 'save'])->name('photos.save');
    Route::post('/photos/{photo}/unsave', [SaveController::class, 'unsave'])->name('photos.unsave');
    Route::get('/photos/saved', [SaveController::class, 'showSavedPhotos'])->name('photos.saved');


    // Comment (pakai route model binding Photo)
    Route::middleware('auth')->post('/photos/{photo}/comments', [CommentController::class, 'store'])->name('comments.store');
});