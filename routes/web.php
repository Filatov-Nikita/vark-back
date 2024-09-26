<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostThumbnailController;
use App\Http\Controllers\PostImageController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('crm')->name('crm.')->group(function() {
    Route::resource('posts', PostController::class);

    Route::controller(PostThumbnailController::class)->name('posts.thumbnail.')->group(function () {
        Route::post('/posts/{post}/thumbnail', 'store')->name('store');
        Route::put('/posts/{post}/thumbnail', 'update')->name('update');
    });

    Route::controller(PostImageController::class)->name('posts.image.')->group(function () {
        Route::post('/posts/{post}/image', 'store')->name('store');
        Route::put('/posts/{post}/image', 'update')->name('update');
    });
});
