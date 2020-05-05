<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke()
    {
        return view('home', [
            'games' => auth()->user()->games,
            'friends' => auth()->user()->friends,
        ]);
    }
}
