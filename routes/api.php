<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PostController;

Route::controller(PostController::class)->name('posts.')->group(function () {
    Route::get('/posts', 'index')->name('index');
    Route::get('/posts/{post:slug}', 'show')->name('show');
});