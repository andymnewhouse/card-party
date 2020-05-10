<div class="font-medium text-lg text-center my-2 flex justify-around items-center ">
    <p>{{ $goalsLabel }}</p>
    <p>{{ $instructions }}</p>
</div>
<div class="flex items-center justify-around">
    @foreach($players as $index => $player)
    <x-player :user="$player" size="12" class="flex-1 p-2 {{ $player->id === $activePlayerId ? 'bg-gray-200' : '' }}" />
    @endforeach
</div>