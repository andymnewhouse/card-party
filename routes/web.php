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

Route::get('/', function () {
    return view('welcome', [
        'game' => new App\Game([
            ['name' => 'Andy'],
            ['name' => 'Dan'],
            ['name' => 'Becca'],
            ['name' => 'Pam'],
            ['name' => 'Jess'],
        ]),
    ]);
});

Auth::routes();

Route::get('/games/start', 'GamesController@create');
