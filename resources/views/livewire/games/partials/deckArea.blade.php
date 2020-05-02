<div class="h-1/3 flex items-center justify-center">
    @if($discard->count() > 0)
    <button type="button" class="card mr-2" wire:click="move('discard', 'hand', {{ $discard->first()->id }})">
        <x-card :card="$discard->first()->card" />
    </button>
    @else
    <div class="inline-block bg-green-400 rounded-lg w-24 h-32 mr-2"></div>
    @endif

    @if(!$game->currentRound->has_started)
    <button type="button" class="card card-back" wire:click="start"></button>
    @else
    <button type="button" class="card card-back" wire:click="move('deck', 'hand')"></button>
    @endif
</div>