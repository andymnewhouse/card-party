<div>
    <div class="text-center mb-2 font-medium text-lg">{{ $players[$activePlayer]['name'] }}'s Turn</div>
    <div class="flex items-center justify-center">
        @if(count($discard) > 0)
        <x-card class="inline-block mr-2" :card="$discard[0]" wire:click="pick('discard')" />
        @else
        <div class="inline-block bg-gray-100 rounded w-24 h-32 mr-2"></div>
        @endif
        @if($turn === 0)
        <button type="button"
            class="border-2 border-black rounded-lg p-4 inline-block w-24 h-32 card-back focus:outline-none focus:shadow-outline-blue active:bg-blue-200 transition ease-in-out duration-150"
            wire:click="start"></button>
        @else
        <button type="button"
            class="border-2 border-black rounded-lg p-4 inline-block w-24 h-32 card-back focus:outline-none focus:shadow-outline-blue active:bg-blue-200 transition ease-in-out duration-150"
            wire:click="pick('deck')"></button>
        @endif
    </div>

    <div class="grid grid-cols-2 gap-4 my-8">
        @foreach($players as $player)
        <div class="rounded shadow p-4 bg-gray-100">
            <h2 class="uppercase text-gray-800 text-sm mb-2">{{ $player['name'] }} <span
                    class="text-gray-600">({{ count($player['hand']) }})</span></h2>

            <div class="grid grid-cols-8 gap-4">
                <div class="col-span-7 flex">
                    @foreach($player['hand'] as $cardIndex => $card)
                    @if($cardIndex > 0)
                    <x-card class="inline-block w-24 -ml-8" :index="$cardIndex" :card="$card" :key="$cardIndex" />
                    @else
                    <x-card class="inline-block w-24" :index=" $cardIndex" :card="$card" :key="$cardIndex" />
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>