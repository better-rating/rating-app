<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;


Route::get('/profiles/list/{media_type}/', [ProfileController::class, 'list']);
Route::get('/profiles/{profile}', [ProfileController::class, 'fetch']);

