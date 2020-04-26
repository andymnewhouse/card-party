<div class="game-container h-screen">
    <div class="instructions-area flex items-center justify-center">
        <div class="font-medium text-lg">{{ $instructions }}</div>
    </div>
    <div class="table-area">
        <div class="max-w-7xl mx-auto h-full sm:px-6 lg:px-8">
            <div class="table">
                @foreach($players as $index => $player)
                <div class="circle{{ $index === $activePlayer ? ' active' : '' }} flex items-center justify-center text-sm text-white"
                    number="{{ $index+1 }}" total="{{ count($players) }}">{{ substr($player['name'], 0, 1) }}</div>
                @endforeach
            </div>
            <div class="h-1/3 flex bg-green-300 pb-6 items-center justify-center">
                @if(count($discard) > 0)
                <x-card class="inline-block mr-2" :card="$discard[0]" wire:click="pick('discard')" />
                @else
                <div class="inline-block bg-green-400 rounded-lg w-24 h-32 mr-2"></div>
                @endif

                @if(!$game->has_started)
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
        <div class="shadow-lg bg-white">
            <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                <h2 class="uppercase text-gray-800 text-sm mb-2">{{ auth()->user()->name }} <span
                        class="text-gray-600">({{ count($my_hand) }})</span></h2>

                <div class="grid grid-cols-6 gap-4">
                    <div class="col-span-5 flex hand">
                        @foreach($my_hand as $cardIndex => $card)
                        <x-card class="inline-block" :index="$cardIndex" :card="$card" :key="$cardIndex" />
                        @endforeach
                    </div>
                    <div>
                        <button type="button" wire:click="buy"
                            class="mb-2 block w-full text-center items-center px-2.5 py-1.5 border border-transparent text-xs leading-4 font-medium rounded text-indigo-700 bg-indigo-100 hover:bg-indigo-50 focus:outline-none focus:border-indigo-300 focus:shadow-outline-indigo active:bg-indigo-200 transition ease-in-out duration-150">Buy</button>
                        <button type="button" wire:click="layDown"
                            class="mb-2 block w-full text-center items-center px-2.5 py-1.5 border border-transparent text-xs leading-4 font-medium rounded text-indigo-700 bg-indigo-100 hover:bg-indigo-50 focus:outline-none focus:border-indigo-300 focus:shadow-outline-indigo active:bg-indigo-200 transition ease-in-out duration-150">Lay
                            Down</button>
                        <span class="w-full relative z-0 inline-flex shadow-sm">
                            <button type="button" wire:click="sort('asc')"
                                class="flex-1 relative text-center items-center px-2.5 py-1.5 rounded-l border border-gray-300 bg-white text-xs leading-5 font-medium text-gray-700 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                                2 -> A
                            </button>
                            <button type="button" wire:click="sort('desc')"
                                class="-ml-px flex-1 relative text-center items-center px-2.5 py-1.5 rounded-r border border-gray-300 bg-white text-xs leading-5 font-medium text-gray-700 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                                A -> 2
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>