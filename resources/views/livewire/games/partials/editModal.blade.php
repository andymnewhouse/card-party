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
                @foreach($goals as $index => $goal)
                <div class="flex-1 mx-4 rounded bg-gray-100 h-48 shadow-inner p-4" wire:click="place({{ $index }})"
                    :key="$index">
                    <p class="text-gray-500 text-xs italic mb-2"> {{ $goal['label' ]}}</p>
                    <div class="flex hand">
                        @foreach($goal['cards'] as $cardIndex => $stock)
                        <x-card class="card" :card="$stock['small_card']" :key="$cardIndex" disabled />
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="mt-5 sm:mt-6 grid grid-cols-2 gap-6">
            <span class="w-full rounded-md shadow-sm">
                <button type="button" wire:click="cancel"
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