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

Auth::routes();

Route::get('/', 'WelcomeController')->name('welcome');
Route::get('/home', 'HomeController')->name('home');
Route::get('/games/start', 'GamesController@create')->name('games.create');
Route::post('/games', 'GamesController@store')->name('games.store');
Route::get('/games/{hash}/setup', 'GamesSetupController')->name('games.setup');
Route::get('/games/{hash}/play', 'GamesPlayController')->name('games.play');
