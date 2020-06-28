<div x-data="{show: false}">
    <form wire:submit.prevent="send" class="mt-4 flex">
        <label for="email" class="sr-only">Email</label>
        <div class="flex rounded-md shadow-sm w-96">
            <input id="email" wire:model="email"
                class="form-input flex-1 block w-full px-3 py-2 rounded-none rounded-l-md sm:text-sm sm:leading-5" />
            <span class="btn-shadow">
                <button type="submit" class="btn btn-xs rounded-none btn-red-primary">
                    Send Email
                </button>
            </span>
            <span class="btn-shadow">
                <button type="button" @click="show = true" class="btn btn-xs rounded-l-none btn-red-secondary">
                    <x:heroicon-o-cog class="w-4 h-4" />
                </button>
            </span>
        </div>
    </form>

    <div x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed z-50 bottom-0 inset-x-0 px-4 pb-6 sm:inset-0 sm:p-0 sm:flex sm:items-center sm:justify-center">
        <div class="fixed inset-0 transition-opacity" @click="show = false">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="bg-white rounded-lg px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full sm:p-6"
            role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <div>
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                        Send Email Invites
                    </h3>
                    <div class="mt-2">
                        <div class="sm:col-span-6">
                            <label for="about" class="block text-sm font-medium leading-5 text-gray-700">
                                Message
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <textarea id="about" rows="5" wire:model="message"
                                    class="form-textarea block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"></textarea>
                            </div>
                            <p class="mt-2 text-sm text-gray-500">Add a little message, could include instructions or a
                                video call link.</p>
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="sm:col-span-6">
                            <label for="about" class="block text-sm font-medium leading-5 text-gray-700">
                                Recipients
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <textarea id="about" rows="3" wire:model="recipients"
                                    class="form-textarea block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                </textarea>
                            </div>
                            <p class="mt-2 text-sm text-gray-500">Emails of those folks you want to play with.<br>Emails
                                can be seperated by commas or new lines.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                <span class="btn-block btn-shadow sm:col-start-2">
                    <button type="button" wire:click="send" @click="show = false"
                        class="inline-flex justify-center w-full btn-base btn btn-blue-gray-primary">
                        Send Emails
                    </button>
                </span>
                <span class="mt-3 btn-block btn-shadow sm:mt-0 sm:col-start-1">
                    <button type="button" @click="show = false"
                        class="inline-flex justify-center w-full btn btn-base btn-white">
                        Cancel
                    </button>
                </span>
            </div>
        </div>
    </div>
</div>