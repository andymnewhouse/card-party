@extends('layouts.app', ['title' => $game->game])

@section('content')
<livewire:game :game="$game" />
@endsection