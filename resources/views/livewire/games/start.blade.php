<div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
    <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <form action="{{ route('games.store') }}" method="POST">
            @csrf
            <div>
                <label for="game" class="form-label">
                    Game
                </label>

                <div class="mt-1 rounded-md shadow-sm">
                    <select id="game" name="game" wire:model="game"
                        class="block form-select w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                        required>
                        @foreach($gameTypes as $type)
                        <option value="{{ $type->id }}">{{ $type->label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mt-6">
                <label for="players" class="form-label">
                    Number of Players
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                    <input id="num_players" type="number" required wire:model="num_players" name="num_players" min="3"
                        max="8" class="form-control" />
                </div>
            </div>

            @foreach(range(1,$num_players) as $index => $player)
            <div class="mt-6" :key="$loop->index">
                <label for="players" class="form-label">
                    Player {{ $player}}
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                    <select id="player{{ $player }}" name="players[]"
                        class="block form-select w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                        <option value="{{ auth()->id() }}">{{ auth()->user()->name }} (Me)</option>
                        @foreach($friends as $friend)
                        <option value="{{ $friend->id }}">{{ $friend->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @endforeach

            <div class="mt-6">
                <span class="block w-full rounded-md shadow-sm">
                    <button type="submit"
                        class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                        Start Game
                    </button>
                </span>
            </div>
        </form>
    </div>
</div>