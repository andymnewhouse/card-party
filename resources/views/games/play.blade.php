@extends('layouts.app', ['title' => 'Let\'s Play'])

@section('content')
<livewire:games.play :game="$game" />
@endsection