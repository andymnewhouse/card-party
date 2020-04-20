@extends('layouts.app', ['title' => $game->game])

@section('content')



<div class="grid grid-cols-2 gap-4 my-8">
    @foreach($game->players as $player)
    <livewire:player :player="$player" :key="$loop->index" />
    @endforeach
</div>

{{-- <div class="grid grid-cols-12 gap-4">
    @foreach($game->deck->cards as $card)
    <x-card :card="$card" :key="$loop->index" />
    @endforeach
</div> --}}
@endsection