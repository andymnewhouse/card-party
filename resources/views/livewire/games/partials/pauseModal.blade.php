<div class="absolute w-full h-full top-0 bg-gray-transparent flex items-center justify-center">
    <div
        class="bg-white rounded-lg px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-2xl sm:w-full sm:p-6">
        <div>
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                {{ $pauseGameReason }}
            </h3>

            @if($roundOver && $finishedTabulating === null)
            <p class="leading-5 text-gray-500">
                Tabulating Scores ....
            </p>
            @else
            <x-tables.scores :players="$players" :scores="$scores" />

            @if(auth()->id() === $game->owner_id)
            <div class="text-center mt-6">
                <span class="btn-shadow">
                    <button wire:click="startNextRound" class="btn btn-red-primary btn-xl">
                        Start Next Round
                    </button>
                </span>
            </div>
            @endif
            @endif
        </div>
    </div>
</div>