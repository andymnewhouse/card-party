<div class="h-1/3 flex items-center justify-center relative">
    @if($discard->count() > 0)
    <button type="button" class="card mr-2" wire:click="pickup('discard')">
        <x-card :card="$discard->first()->card" />
    </button>
    @else
    <div class="inline-block bg-green-400 rounded-lg w-24 h-32 mr-2"></div>
    @endif

    @if(!$game->currentRound->has_started)
    <button type="button" class="card card-back" wire:click="start"></button>
    @else
    <button type="button" class="card card-back" wire:click="pickup('deck')"></button>
    @endif

    @if($editMode && $iHavePlayed)
    <div class="p-2 w-full absolute text-center bottom-0 bg-red-500 rounded shadow mb-1">
        <p>Playing Cards</p>
    </div>
    @endif
</div>