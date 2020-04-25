<div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
    <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <h2>Who are you?</h2>

        @foreach($game->players as $index => $player)
        <div class="p-4 rounded border border-gray-100 mb-2 hover:shadow-sm transition duration-150 ease-in-out"
            wire:click="choose({{ $index }})">
            {{ $player['name'] }}
        </div>
        @endforeach
    </div>
</div>