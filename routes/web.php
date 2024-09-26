<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('crm')->name('crm.')->group(function() {
    Route::resource('posts', PostController::class);

});
