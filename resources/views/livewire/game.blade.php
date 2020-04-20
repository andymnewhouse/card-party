<div>
    <div class="flex items-center justify-center">
        @if(count($discard) > 0)
        <x-card class="inline-block mr-2" :card="$discard[0]" wire:click="pick('discard')" />
        @else
        <div class="inline-block bg-gray-100 rounded w-24 h-32 mr-2"></div>
        @endif
        <button type="button" class="border-2 border-black rounded-lg p-4 inline-block w-24 h-32 card-back"
            wire:click="pick('deck')"></button>
    </div>

    <div class="grid grid-cols-2 gap-4 my-8">
        @foreach($players as $player)
        <livewire:player :player="$player" :key="$loop->index" />
        @endforeach
    </div>
</div>