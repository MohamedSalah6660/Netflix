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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('movie/{id}', 'MovieController@show')->name('movies.show');
// Route::get('movies', 'MovieController@index')->name('movies.index');
Route::resource('movies', 'MovieController')->only(['index','show']);

Route::post('/movies/{movie}/increment-views','MovieController@increment_views')->name('movies.increment_views');

Route::post('/movies/{movie}/toggle-favorite','MovieController@toggle_favorite')->name('movies.toggle_favorite');





// Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->where('provider', 'facebook|google');
// Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->where('provider', 'facebook|google');

Route::get('redirect/{service}', 'SocialController@redirect');
Route::get('callback/{service}', 'SocialController@callback');

