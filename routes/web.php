<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;



Route::middleware(ProtectAgainstSpam::class)->group(function () {
    Auth::routes(['verify' => true]);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', 'HomeController')->name('home');
    Route::livewire('/my/settings', 'settings')->layout('layouts.app', ['title' => 'My Settings'])->name('settings');
    Route::get('/games/{hash}/join', 'GamesJoinController')->name('games.join');
    Route::get('/games/{hash}/play', 'GamesPlayController')->name('games.play');
});
