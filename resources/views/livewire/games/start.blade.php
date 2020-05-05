<div x-data="{ open: false }" class="relative flex-shrink-0">
    <div>
        <span class="btn-shadow">
            <button @click="open = true" class="btn btn-base btn-red-primary">
                Start a New Game
            </button>
        </span>
    </div>
    <!--
              Profile dropdown panel, show/hide based on dropdown state.

              Entering: "transition ease-out duration-100"
                From: "transform opacity-0 scale-95"
                To: "transform opacity-100 scale-100"
              Leaving: "transition ease-in duration-75"
                From: "transform opacity-100 scale-100"
                To: "transform opacity-0 scale-95"
            -->
    <div x-show="open" @click.away="open = false"
        class="origin-top-right absolute z-10 right-0 mt-2 w-80 rounded-md shadow-lg">
        <form wire:submit.prevent="create" class="p-2 rounded-md bg-gray-100 shadow-xs flex">
            <label for="game" class="sr-only">
                Game
            </label>
            <select id="game" name="game" wire:model="game"
                class="block form-select w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" required>
                @foreach($gameTypes as $type)
                <option value="{{ $type->id }}">{{ $type->label }}</option>
                @endforeach
            </select>
            <span class="ml-4 btn-shadow">
                <button type="submit" class="btn btn-base btn-blue-gray-primary">
                    Go
                </button>
            </span>
        </form>
    </div>
</div>