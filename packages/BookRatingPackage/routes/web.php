<?php

use Illuminate\Support\Facades\Route;
use BetterRating\BookRatingPackage\Http\Controllers\BookController;

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::resource('books', BookController::class);
});
