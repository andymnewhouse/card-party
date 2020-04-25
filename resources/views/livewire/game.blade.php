<div class="game-container">
    <div class="instructions-area flex items-center justify-center">
        <div class="font-medium text-lg">{{ $instructions }}</div>
    </div>
    <div class="table-area">
        <div class="max-w-7xl mx-auto h-full sm:px-6 lg:px-8">
            <div class="table">
                @foreach($players as $index => $player)
                <div class="circle{{ $index === $activePlayer ? ' active' : '' }} flex items-center justify-center text-sm text-white"
                    number="{{ $index+1 }}" total="{{ count($players) }}">{{ $player['name'] }}</div>
                @endforeach
            </div>
            <div class="h-1/3 flex bg-green-300 pb-6 items-center justify-center">
                @if(count($discard) > 0)
                <x-card class="inline-block mr-2" :card="$discard[0]" wire:click="pick('discard')" />
                @else
                <div class="inline-block bg-green-400 rounded-lg w-24 h-32 mr-2"></div>
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
        </div>
    </div>
    <div class="hand-area">
        @foreach($players as $index => $player)
        <div class="shadow-lg bg-white  {{ $index === $activePlayer ? '' : 'hidden' }}">
            <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                <h2 class="uppercase text-gray-800 text-sm mb-2">{{ $player['name'] }} <span
                        class="text-gray-600">({{ count($player['hand']) }})</span></h2>

                <div class="grid grid-cols-8 gap-4">
                    <div class="col-span-7 flex hand">
                        @foreach($player['hand'] as $cardIndex => $card)
                        <x-card class="inline-block" :index="$cardIndex" :card="$card" :key="$cardIndex" />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>