<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <h2 class="uppercase text-gray-800 text-sm mb-2">{{ auth()->user()->firstName }} <span
            class="text-gray-600">({{ count($myHand) }})</span></h2>

    <div class="grid grid-cols-6 gap-4">
        <div class="col-span-5">
            <div class="hand flex flex-no-wrap" wire:sortable="sort">
                @foreach($myHand as $cardIndex => $stock)
                @if($editMode)
                @if(in_array($stock->id, array_column($selected, 'id')))
                <button type="button" class="card bg-blue-100 -mt-4" disabled>
                    <x-card :card="$stock->smallCard" />
                </button>
                @else
                <button type="button" wire:click="selectToPlace({{ $stock->id }})" class="card">
                    <x-card :card="$stock->smallCard" />
                </button>
                @endif
                @else
                <div wire:sortable.item="{{ $stock->id }}" wire:key="stock-{{ $stock->id }}"
                    class="card group flex items-center {{ $stock->newest ? 'bg-blue-gray-100' : '' }}">
                    <div wire:sortable.handle
                        class="group-hover:bg-red-300 rounded-t w-full h-4 absolute top-0 left-0 right-0">
                    </div>
                    <button type="button" wire:click="discard({{ $stock->id }})">
                        <x-card :card="$stock->smallCard" />
                    </button>
                </div>
                @endif
                @endforeach
            </div>
        </div>
        <div>
            @if($iHavePlayed)
            <button type="button" wire:click="hotCard"
                class="mb-2 block w-full text-center btn btn-xs btn-red-secondary">🔥HOT CARD!</button>
            <button type="button" wire:click="playOff" {{ auth()->id() !== $activePlayerId ? 'disabled' : ''}}
                class="mb-2 block w-full text-center btn btn-xs btn-red-secondary">Play Off Somone Else</button>
            @else
            <button type="button" wire:click="buy" {{ auth()->id() === $activePlayerId ? 'disabled' : ''}}
                class="mb-2 block w-full text-center btn btn-xs btn-blue-gray-secondary">Buy</button>
            <button type="button" wire:click="layDown" {{ auth()->id() !== $activePlayerId ? 'disabled' : ''}}
                class="mb-2 block w-full text-center btn btn-xs btn-blue-gray-secondary">Lay
                Down</button>
            @endif
            <span class="w-full relative z-0 inline-flex shadow-sm">
                <button type="button" wire:click="sort('asc')"
                    class="relative group-btn btn-xs rounded-r-none btn-white {{ $sort == 'asc' ? 'active' : '' }}">
                    2 ➜ A
                </button>
                <button type="button" wire:click="sort('desc')"
                    class="-ml-px relative group-btn btn-xs rounded-none btn-white {{ $sort === 'desc' ? 'active' : '' }}">
                    A ➜ 2
                </button>
                <button type="button" wire:click="toggleGroup"
                    class="-ml-px relative group-btn btn-xs rounded-l-none btn-white {{ $group ? 'active' : '' }}">
                    ♠︎♥︎♣︎♦︎
                </button>
            </span>
        </div>
    </div>
</div>
<x-popup>
    <x-slot name="button">
        <span class="btn-shadow absolute top-0 right-0 mt-2">
            <button class="btn btn-base btn-blue-gray-primary rounded-r-none" @click="open = true">
                <x:heroicon-o-chart-bar class="w-6 h-6" />
                <span class="sr-only">Scores</span>
            </button>
        </span>
    </x-slot>

    <h2 class="tekton text-xl mb-2">Scores</h2>
    <x-tables.scores :players="$players" :scores="$scores" />
</x-popup>