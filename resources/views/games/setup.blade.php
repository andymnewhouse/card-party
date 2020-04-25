@extends('layouts.app', ['title' => '🃏🎉 Game'])

@section('content')
<div class="h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <livewire:games.setup :game="$game" />
</div>
@endsection