<div class="game-container h-screen">
    <div class="instructions-area">
        <div class="font-medium text-lg text-center my-2">{{ $instructions }}</div>
        <div class="flex items-center justify-around p-2">
            @foreach($players as $index => $player)
            <div class="text-center">
                <div
                    class="{{ $index === $activePlayer ? 'bg-purple-600' : 'bg-blue-600'}} mx-auto rounded-full border-2 w-8 h-8 flex items-center justify-center text-sm text-white">
                    {{ substr($player['name'], 0, 1) }}</div>
                {{ Str::before($player['name'], ' ') }}
            </div>
            @endforeach
        </div>
    </div>
    <div class="table-area relative bg-green-300 shadow-inner">
        <div class="max-w-7xl mx-auto h-full sm:px-6 lg:px-8">
            <div class="table pt-8">
                <div class="grid grid-cols-4 gap-6">
                    @foreach($table as $group)
                    <div class="shadow-inner p-2 rounded bg-green-400 flex hand">
                        @foreach($group as $cardIndex => $card)
                        <x-card-sm :card="$card" :key="$cardIndex" />
                        @endforeach
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="h-1/3 flex items-center justify-center">
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
        @if($editMode)
        <div class="absolute w-full h-full top-0 bg-gray-transparent flex items-center justify-center">
            <div
                class="bg-white rounded-lg px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-2xl sm:w-full sm:p-6">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        What do you want to lay down?
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm leading-5 text-gray-500">
                            Select a card from your hand then select a box to put it in.
                        </p>
                    </div>
                    <div class="mt-2 flex -mx-4">
                        @foreach($boxes as $index => $box)
                        <div class="flex-1 mx-4 rounded bg-gray-100 h-48 shadow-inner p-4"
                            wire:click="place({{ $index }})" :key="$index">
                            <p class="text-gray-500 text-xs italic mb-2"> {{ $box['label' ]}}</p>
                            <div class="flex hand">
                                @foreach($box['cards'] as $cardIndex => $card)
                                <x-card class="inline-block" :card="$card" :key="$cardIndex" disabled />
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="mt-5 sm:mt-6 grid grid-cols-2 gap-6">
                    <span class="w-full rounded-md shadow-sm">
                        <button type="button"
                            class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-indigo-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Cancel
                        </button>
                    </span>
                    <span class="w-full rounded-md shadow-sm" wire:click="play">
                        <button type="button"
                            class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-indigo-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Play
                        </button>
                    </span>
                </div>
            </div>
        </div>
        @endif
    </div>
    <div class="hand-area">
        <div class="shadow-lg bg-white">
            <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                <h2 class="uppercase text-gray-800 text-sm mb-2">{{ auth()->user()->name }} <span
                        class="text-gray-600">({{ count($my_hand) }})</span></h2>

                <div class="grid grid-cols-6 gap-4">
                    <div class="col-span-5">
                        @if($my_selected->count() > 0)
                        <div class="hand">
                            @foreach($my_selected as $cardIndex => $card)
                            <x-card class="inline-block bg-blue-200" :index="$cardIndex" :card="$card" :key="$cardIndex"
                                :editMode="$editMode" />
                            @endforeach
                        </div>
                        @endif
                        <div class="hand flex flex-no-wrap">
                            @foreach($my_hand as $cardIndex => $card)
                            <x-card class="inline-block" :index="$cardIndex" :card="$card" :key="$cardIndex"
                                :editMode="$editMode" />
                            @endforeach
                        </div>
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