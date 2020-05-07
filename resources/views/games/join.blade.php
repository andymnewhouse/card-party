@extends('layouts.app', ['title' => 'Join a Game'])

@section('content')
<div class="w-full p-8">
    <livewire:games.join :game="$game" />
</div>
@endsection