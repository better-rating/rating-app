<?php

use App\Http\Controllers\MediaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

/*
 |-----------------------------------------------------------------|
 | Actions Handled By Resource Controller                          |
 |-----------------------------------------------------------------|
 | VERB       |  URI                  | ACTION   |  ROUTE NAME     |
 | -----------|-----------------------|----------|-----------------|
 | GET        | /photos               |  index   |  photos.index   |
 | GET        | /photos/create        |  create  |  photos.create  |
 | POST       | /photos               |  store   |  photos.store   |
 | GET        | /photos/{photo}       |  show    |  photos.show    |
 | GET        | /photos/{photo}/edit  |  edit    |  photos.edit    |
 | PUT/PATCH  | /photos/{photo}       |  update  |  photos.update  |
 | DELETE     | /photos/{photo}       |  destroy |  photos.destroy |
 |-----------------------------------------------------------------|
 */

Route::group(['middleware' => ['auth']], function () {
    Route::resource('ratings', 'RatingController')->except('create');
    Route::get('ratings/create/{media_type}/{media_id}', [RatingController::class, 'create'])->name('ratings.create');
    Route::resource('rating-partials', 'RatingPartialController')->except('show');
    Route::resource('profiles', 'ProfileController');

    Route::get('/profiles/list/{media_type}', [ProfileController::class, 'list']);
//    Route::resource('reviews', 'ReviewController');

    Route::resource('movies', 'MovieController');
    Route::resource('books', 'BookController');
    Route::resource('shows', 'ShowController');
    Route::resource('seasons', 'SeasonController');
    Route::resource('episodes', 'EpisodeController');
});

Route::get('/book/{book}', [MediaController::class, 'book']);
Route::get('/movie/{movie}', [MediaController::class, 'movie']);
Route::get('/show/{show}', [MediaController::class, 'show']);
Route::get('/show/{show}/season/{season}', [MediaController::class, 'season']);
Route::get('/show/{show}/season/{season}/episode/{episode}', [MediaController::class, 'episode']);

Route::get('/home', 'HomeController@index')->name('home');

