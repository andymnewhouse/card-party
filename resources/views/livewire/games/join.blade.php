<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h1 class="tekton text-2xl leading-6 font-medium text-red-500">
                Let's Get Everyone Together
            </h1>
            <div class="mt-2 max-w-xl text-sm leading-5 text-gray-500">
                <p>
                    You'll see them pop up below when they are connected.
                </p>
            </div>
            <div class="mt-5 grid grid-cols-1 md:grid-cols-2">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex">
                        <div class="flex-shrink-0 bg-blue-gray-700 rounded-md flex items-center justify-center w-8 h-8">
                            <span class="text-xl text-white">1</span>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <h2 class="tekton text-lg leading-6 text-gray-900">Send Folks a Link</h2>
                            <p>Copy the link and send to your friends and family to get started!</p>
                        </div>
                    </div>
                    <div class="mt-4 flex">
                        <label for="link" class="sr-only">Link</label>
                        <div class="flex rounded-md shadow-sm w-96" x-data="{ open: false }">
                            <input id="link" value="{{ $game->joinLink }}" x-ref="clipboardCode"
                                class="form-input flex-1 block w-full px-3 py-2 rounded-none rounded-l-md sm:text-sm sm:leading-5" />
                            <span class="inline-flex rounded-md shadow-sm">
                                <button type="button"
                                    @click="$refs.clipboardCode.select(); document.execCommand('copy')"
                                    class="btn btn-xs rounded-l-none btn-red-primary">
                                    Copy Link
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-200 md:border-0 md:border-l px-4 py-5 sm:p-6">
                    <div class="flex">
                        <div class="flex-shrink-0 bg-blue-gray-700 rounded-md flex items-center justify-center w-8 h-8">
                            <span class="text-xl text-white">2</span>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <h2 class="tekton text-lg leading-6 text-gray-900">Send Folks an Email</h2>
                            <p>Enter their emails below and send them an invite link.</p>
                        </div>
                    </div>
                    <livewire:invites.email :game="$game" />
                </div>
            </div>
        </div>
    </div>

    <div class="w-full h-64 mt-8 grid grid-cols-4 gap-6">
        @foreach($players as $user)
        <x-player :user="$user" size="24" />
        @endforeach
    </div>

    @if(auth()->id() === $game->owner_id)
    <div class="text-center">
        <span class="btn-shadow">
            <button wire:click="start" class="btn btn-red-primary btn-xl"
                {{ $players->count() < $game->game_type->min_players ? 'disabled' : '' }}>
                All Set, Let's Start
            </button>
        </span>
    </div>
    @endif

</div>