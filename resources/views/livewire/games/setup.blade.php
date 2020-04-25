<div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
    <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <h2 class="mb-6 text-xl leading-9 font-extrabold text-gray-900">
            Who are you?
        </h2>

        @foreach($game->players as $index => $player)
        <button type="button"
            class="block w-full p-4 rounded border border-gray-100 mb-2 hover:shadow-sm transition duration-150 ease-in-out"
            wire:click="choose({{ $index }})">
            {{ $player['name'] }}
        </button>
        @endforeach
    </div>
</div>