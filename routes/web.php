<?php

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

Route::get('/', 'WelcomeController@index')->name('welcome');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('movies', 'MovieController')->only(['index','show'])->middleware('verified');

Route::post('/movies/{movie}/increment-views','MovieController@increment_views')->name('movies.increment_views');

Route::post('/movies/{movie}/toggle-favorite','MovieController@toggle_favorite')->name('movies.toggle_favorite');



Route::get('redirect/{service}', 'SocialController@redirect');
Route::get('callback/{service}', 'SocialController@callback');

