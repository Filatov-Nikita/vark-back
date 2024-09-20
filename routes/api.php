<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\PhotoController;
use App\Http\Controllers\API\VideoController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\VacancyController;

Route::controller(PostController::class)->name('posts.')->group(function () {
    Route::get('/posts', 'index')->name('index');
    Route::get('/posts/others', 'other_posts')->name('others');
    Route::get('/posts/{post:slug}', 'show')->name('show');
});

Route::controller(PhotoController::class)->name('photos.')->group(function () {
    Route::get('/photos', 'index')->name('index');
});

Route::controller(VideoController::class)->name('videos.')->group(function () {
    Route::get('/videos', 'index')->name('index');
});

Route::post('/order', [ OrderController::class, 'execute' ]);
Route::post('/vacancy', [ VacancyController::class, 'execute' ]);
