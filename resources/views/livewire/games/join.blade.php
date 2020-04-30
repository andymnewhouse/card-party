<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white rounded shadow p-4">
        Copy the link and send to your friends and family to get started! You'll see them pop up below when they are
        connected.
    </div>

    <div class="w-full h-64 mt-8 grid grid-cols-4 gap-6">
        @foreach($players as $user)
        <x-player :user="$user" size="24" />
        @endforeach
    </div>

    @if(auth()->id() === $game->owner_id)
    <div class="text-center">
        <span class="inline-flex rounded-md shadow-sm mx-auto">
            <button wire:click="start" @if($players->count() < $game->game_type->min_players) disabled @endif
                    class="inline-flex items-center px-6 py-3 border border-transparent text-base leading-6 font-medium
                    rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700
                    focus:shadow-outline-indigo active:bg-indigo-700 disabled:opacity-75 transition ease-in-out
                    duration-150">
                    All Set, Let's Start
            </button>
        </span>
    </div>
    @endif

</div>