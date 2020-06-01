<?php

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
    Route::resource('ratings', 'RatingController');
    Route::resource('rating-partials', 'RatingPartialController')->except('show');
    Route::resource('profiles', 'ProfileController');
});

Route::get('/home', 'HomeController@index')->name('home');

