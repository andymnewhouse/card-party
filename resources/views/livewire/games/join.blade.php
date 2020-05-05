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
        <span class="btn-shadow">
            <button wire:click="start" class="btn btn-red-primary btn-xl"
                {{ $players->count() < $game->game_type->min_players ? 'disabled' : '' }}>
                All Set, Let's Start
            </button>
        </span>
    </div>
    @endif

</div>