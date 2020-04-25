<div class="rounded shadow p-4 bg-gray-100">
    <h2 class="uppercase text-gray-800 text-sm mb-2">{{ $player['name'] }} <span
            class="text-gray-600">({{ count($hand) }})</span></h2>

    <div class="grid grid-cols-8 gap-4">
        <div class="col-span-7 flex">
            @foreach($hand as $card)
            @if($loop->index > 0)
            <x-card class="inline-block w-24 -ml-8" wire:click="discard" :card="$card" :key="$loop->index" />
            @else
            <x-card class="inline-block w-24" wire:click="discard" :card="$card" :key="$loop->index" />
            @endif
            @endforeach
        </div>
        <div>
            <button type="button" wire:click="sort('asc')"
                class="mb-2 inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs leading-4 font-medium rounded text-indigo-700 bg-indigo-100 hover:bg-indigo-50 focus:outline-none focus:border-indigo-300 focus:shadow-outline-indigo active:bg-indigo-200 transition ease-in-out duration-150">2
                -> A</button>
            <button type="button" wire:click="sort('desc')"
                class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs leading-4 font-medium rounded text-indigo-700 bg-indigo-100 hover:bg-indigo-50 focus:outline-none focus:border-indigo-300 focus:shadow-outline-indigo active:bg-indigo-200 transition ease-in-out duration-150">A
                -> 2</button>
        </div>
    </div>
</div>