<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostThumbnailController;
use App\Http\Controllers\PostImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PhotoController;

Route::get('/', function () {
    return redirect('/crm/home');
});

Route::prefix('crm')->middleware('auth')->name('crm.')->group(function() {
    Route::resource('posts', PostController::class);
    Route::resource('photos', PhotoController::class);

    Route::controller(PostThumbnailController::class)->name('posts.thumbnail.')->group(function () {
        Route::post('/posts/{post}/thumbnail', 'store')->name('store');
        Route::put('/posts/{post}/thumbnail', 'update')->name('update');
    });

    Route::controller(PostImageController::class)->name('posts.image.')->group(function () {
        Route::post('/posts/{post}/image', 'store')->name('store');
        Route::put('/posts/{post}/image', 'update')->name('update');
    });

    Route::get('/home', function () {
        return view('crm.home');
    })->name('home');
});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
