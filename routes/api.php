<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\PhotoController;

Route::controller(PostController::class)->name('posts.')->group(function () {
    Route::get('/posts', 'index')->name('index');
    Route::get('/posts/{post:slug}', 'show')->name('show');
});

Route::controller(PhotoController::class)->name('photos.')->group(function () {
    Route::get('/photos', 'index')->name('index');
});

