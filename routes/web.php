<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('threads/create', 'ThreadController@create');
Route::get('threads/{channel}/{thread}', 'ThreadController@show');
Route::delete('threads/{channel}/{thread}', 'ThreadController@destroy');
Route::get('threads/{channel}', 'ThreadController@index');
Route::post('threads/{channel}/{thread}/replies', 'RepliesController@store');

Route::get('profiles/{user}', 'ProfilesController@show')->name('profile');
Route::post('/replies/{reply}/favorites', 'FavoritesController@store');
Route::get('/profiles/{user}', 'ProfilesController@show')->name('profile');

Route::resources([
  'threads' => 'ThreadController'
]);
