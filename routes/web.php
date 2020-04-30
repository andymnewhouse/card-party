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

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController')->name('home');
    Route::get('/games/{hash}/join', 'GamesJoinController')->name('games.join');
    Route::get('/games/{hash}/play', 'GamesPlayController')->name('games.play');
});