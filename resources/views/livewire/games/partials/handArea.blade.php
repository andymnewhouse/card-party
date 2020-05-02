<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <h2 class="uppercase text-gray-800 text-sm mb-2">{{ auth()->user()->name }} <span
            class="text-gray-600">({{ count($myHand) }})</span></h2>

    <div class="grid grid-cols-6 gap-4">
        <div class="col-span-5">
            <div class="hand flex flex-no-wrap">
                @foreach($myHand as $cardIndex => $stock)
                @if($editMode)
                @if(in_array($stock->id, array_column($selected, 'id')))
                <button type="button" wire:click="selectToPlace({{ $stock->id }})" class="card bg-blue-100 -mt-4"
                    disabled>
                    <x-card :card="$stock->smallCard" />
                </button>
                @else
                <button type="button" wire:click="selectToPlace({{ $stock->id }})" class="card">
                    <x-card :card="$stock->smallCard" />
                </button>
                @endif
                @else
                <button type="button" wire:click="move('hand', 'discard', {{ $stock->id }})" class="card">
                    <x-card :card="$stock->smallCard" />
                </button>
                @endif
                @endforeach
            </div>
        </div>
        <div>
            @if($iHavePlayed)
            <button type="button" wire:click="hotCard" {{ auth()->id() === $activePlayerId ? 'disabled' : ''}}
                class="mb-2 block w-full text-center btn btn-xs btn-secondary">🔥HOT CARD!</button>
            <button type="button" wire:click="playOff" {{ auth()->id() !== $activePlayerId ? 'disabled' : ''}}
                class="mb-2 block w-full text-center btn btn-xs btn-secondary">Play Off Somone Else</button>
            @else
            <button type="button" wire:click="buy" {{ auth()->id() === $activePlayerId ? 'disabled' : ''}}
                class="mb-2 block w-full text-center btn btn-xs btn-secondary">Buy</button>
            <button type="button" wire:click="layDown" {{ auth()->id() !== $activePlayerId ? 'disabled' : ''}}
                class="mb-2 block w-full text-center btn btn-xs btn-secondary">Lay
                Down</button>
            @endif
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