<div class="table pt-8">
    <div class="grid grid-cols-4 gap-6">
        @foreach($table as $group)
        @if($hotCardEditMode)
        <button
            class="shadow-inner p-2 rounded bg-green-400 relative hover:bg-blue-gray-500 focus:outline-none focus:shadow-outline-gray transition duration-150 ease-in-out"
            wire:click="move('discard', 'table', 'discard', {{ $group->id }})">
            <x-card-group :group="$group" />
        </button>
        @elseif($editMode && $iHavePlayed)
        <button
            class="shadow-inner p-2 rounded bg-green-400 relative hover:bg-blue-gray-500 focus:outline-none focus:shadow-outline-gray transition duration-150 ease-in-out"
            wire:click="move('hand', 'table', 'selected', {{ $group->id }})">
            <x-card-group :group="$group" />
        </button>
        @else
        <div class="shadow-inner p-2 rounded bg-green-400 relative">
            <x-card-group :group="$group" />
        </div>
        @endif
        @endforeach
    </div>
</div>