@extends('layouts.app', ['title' => 'Join a Game'])

@section('header')
<header class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
        <div class="flex-1 min-w-0">
            <h1 class="text-lg leading-6 font-semibold text-gray-900">
                Join a {{ $game->game_type->label }} Game
            </h1>
        </div>
        <div class="mt-4 flex md:mt-0 md:ml-4">
            <label for="link" class="sr-only">Link</label>
            <div class="flex rounded-md shadow-sm w-96" x-data="{ open: false }">
                <input id="link" value="{{ $game->joinLink }}" x-ref="clipboardCode"
                    class="form-input flex-1 block w-full px-3 py-2 rounded-none rounded-l-md sm:text-sm sm:leading-5" />
                <span class="inline-flex rounded-md shadow-sm">
                    <button type="button" @click="$refs.clipboardCode.select(); document.execCommand('copy')"
                        class="inline-flex items-center px-2.5 py-1.5 border border-indigo-600 text-xs leading-4 font-medium rounded-r text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                        Copy Link
                    </button>
                </span>
            </div>
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="w-full p-8">
    <livewire:games.join :game="$game" />
</div>
@endsection