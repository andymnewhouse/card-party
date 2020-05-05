<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 mb-24">
    <form wire:submit.prevent="updateProfile" class="shadow overflow-hidden sm:rounded-md">
        <div class="px-4 py-5 bg-white sm:p-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Profile</h3>
            <p class="mt-1 text-sm leading-5 text-gray-600">
                Your name will be displayed when you play games, and your email is used to allow your friends to find
                you.
            </p>

            <div class="mt-6 grid grid-cols-6">
                <div class="col-span-6 sm:col-span-4">
                    <label for="name" class="form-label">{{ __('Name') }}</label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input id="name" type="text" name="name" wire:model="name" autocomplete="name" autofocus
                            class="form-control @error('name') border-red-500 @enderror" />
                    </div>

                    @error('name')
                    <span class="text-red-700 mt-1" role="alert">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-6 col-span-6 sm:col-span-4">
                    <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input id="email" type="email" name="email" wire:model="email" required autocomplete="email"
                            class="form-control @error('email') border-red-500 @enderror" />
                    </div>

                    @error('email')
                    <span class="text-red-700 mt-1" role="alert">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-6 col-span-6 sm:col-span-4">
                    <label class="form-label">Photo</label>
                    <div class="mt-2 flex items-center">
                        <span class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                            <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </span>
                        <span class="ml-5 rounded-md shadow-sm">
                            <button type="button"
                                class="py-2 px-3 border border-gray-300 rounded-md text-sm leading-4 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                                Change
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
            <span class="btn-shadow">
                <button type="submit" class="btn btn-base btn-blue-gray-primary">
                    Save
                </button>
            </span>
        </div>
    </form>

    <form wire:submit.prevent="updatePassword" class="mt-10 shadow overflow-hidden sm:rounded-md">
        <div class="px-4 py-5 bg-white sm:p-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Update Password</h3>

            <div class="mt-6 grid grid-cols-6">
                <div class="col-span-6 sm:col-span-4">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input id="password" type="password" name="password" wire:model="password" required
                            autocomplete="new-password"
                            class="form-control @error('password') border-red-500 @enderror" />
                    </div>

                    @error('password')
                    <span class="text-red-700 mt-1" role="alert">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-6 sm:col-span-4 mt-6">
                    <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            wire:model="password_confirmation" required autocomplete="new-password" />
                    </div>
                </div>
            </div>
        </div>
        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
            <span class="btn-shadow">
                <button type="submit" class="btn btn-base btn-blue-gray-primary">
                    Save
                </button>
            </span>
        </div>
    </form>

    <form wire:submit.prevent="updateNotifications" class="mt-10 shadow overflow-hidden sm:rounded-md">
        <div class="px-4 py-5 bg-white sm:p-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Notifications</h3>

            <fieldset class="mt-6">
                <legend class="text-base leading-6 font-medium text-gray-900">By Email</legend>
                <div class="mt-4">
                    <div class="flex items-start">
                        <div class="absolute flex items-center h-5">
                            <input id="invites" type="checkbox" wire:model="allowInvites"
                                class="form-checkbox h-4 w-4 text-blue-gray-600 transition duration-150 ease-in-out" />
                        </div>
                        <div class="pl-7 text-sm leading-5">
                            <label for="invites" class="font-medium text-gray-700">Invites</label>
                            <p class="text-gray-500">Get notified when someone invites you to a game.</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-start">
                            <div class="absolute flex items-center h-5">
                                <input id="friend-request" type="checkbox" wire:model="allowRequests"
                                    class="form-checkbox h-4 w-4 text-blue-gray-600 transition duration-150 ease-in-out" />
                            </div>
                            <div class="pl-7 text-sm leading-5">
                                <label for="friend-request" class="font-medium text-gray-700">Friend Request</label>
                                <p class="text-gray-500">Get notified when someone adds you as a friend.</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-start">
                            <div class="absolute flex items-center h-5">
                                <input id="newsletter" type="checkbox" wire:model="subscribed"
                                    class="form-checkbox h-4 w-4 text-blue-gray-600 transition duration-150 ease-in-out" />
                            </div>
                            <div class="pl-7 text-sm leading-5">
                                <label for="newsletter" class="font-medium text-gray-700">News</label>
                                <p class="text-gray-500">Get newsletters with news, new features, and more.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
            <span class="btn-shadow">
                <button type="submit" class="btn btn-base btn-blue-gray-primary">
                    Save
                </button>
            </span>
        </div>
    </form>

    <div class="mt-10 shadow overflow-hidden sm:rounded-md">
        <div class="px-4 py-5 bg-white sm:p-6">
            <h3 class="text-lg font-medium leading-6 text-red-800">Danger Area</h3>

            <x-popup>
                <x-slot name="button">
                    <button type="button" class="mt-6 btn btn-lg btn-red-primary" @click="open = true">
                        Deactivate Account and Delete All Data
                    </button>
                </x-slot>

                <div class="sm:flex sm:items-start">
                    <div
                        class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-red-600" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Deactivate account
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm leading-5 text-gray-500">
                                Are you sure you want to deactivate your account? All of your data will be
                                permanantly removed
                                from our servers forever. This action cannot be undone.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <button type="button" wire:click="deleteAccount"
                            class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Deactivate
                        </button>
                    </span>
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                        <button type="button" @click="open = false"
                            class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Cancel
                        </button>
                    </span>
                </div>
            </x-popup>
        </div>
    </div>
</div>