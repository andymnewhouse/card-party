<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 mb-24">
    <div class="shadow overflow-hidden sm:rounded-md">
        <div class="px-4 py-5 bg-white sm:p-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Profile</h3>
            <p class="mt-1 text-sm leading-5 text-gray-600">
                Your name will be displayed when you play games, and your email is used to allow your friends to find
                you.
            </p>

            <div class="mt-6 grid grid-cols-6">
                <div class="col-span-6 sm:col-span-4">
                    <label for="name" class="form-label">
                        {{ __('Name') }}
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input id="name" type="text" name="name" wire:model="name" autocomplete="name" autofocus
                            class="form-control @error('name') border-red-500 @enderror" />
                    </div>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mt-6 col-span-6 sm:col-span-4">
                    <label for="email" class="form-label">
                        {{ __('E-Mail Address') }}
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input id="email" type="email" name="email" wire:model="email" required autocomplete="email"
                            class="form-control @error('email') border-red-500 @enderror" />
                    </div>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mt-6 col-span-6 sm:col-span-4">
                    <label class="form-label">
                        Photo
                    </label>
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
    </div>

    <div class="mt-10 shadow overflow-hidden sm:rounded-md">
        <div class="px-4 py-5 bg-white sm:p-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Update Password</h3>

            <div class="mt-6 grid grid-cols-6">
                <div class="col-span-6 sm:col-span-4">
                    <label for="password" class="form-label">
                        {{ __('Password') }}
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input id="password" type="password" name="password" wire:model="password" required
                            autocomplete="new-password"
                            class="form-control @error('password') border-red-500 @enderror" />
                    </div>
                </div>

                <div class="col-span-6 sm:col-span-4 mt-6">
                    <label for="password-confirm" class="form-label">
                        {{ __('Confirm Password') }}
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            wire:model="password_confirmation" required autocomplete="new-password" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-10 shadow overflow-hidden sm:rounded-md">
        <div class="px-4 py-5 bg-white sm:p-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Notifications</h3>

            <fieldset class="mt-6">
                <legend class="text-base leading-6 font-medium text-gray-900">By Email</legend>
                <div class="mt-4">
                    <div class="flex items-start">
                        <div class="absolute flex items-center h-5">
                            <input id="invites" type="checkbox"
                                class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" />
                        </div>
                        <div class="pl-7 text-sm leading-5">
                            <label for="invites" class="font-medium text-gray-700">Invites</label>
                            <p class="text-gray-500">Get notified when someone invites you to a game.</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-start">
                            <div class="absolute flex items-center h-5">
                                <input id="friend-request" type="checkbox"
                                    class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" />
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
                                <input id="newsletter" type="checkbox"
                                    class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" />
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
    </div>

    <div class="mt-10 shadow overflow-hidden sm:rounded-md">
        <div class="px-4 py-5 bg-white sm:p-6">
            <h3 class="text-lg font-medium leading-6 text-red-800">Danger Area</h3>

            <button type="button" wire:click="delete" class="mt-6 btn btn-lg btn-red-primary">
                Deactivate Account and Delete All Data
            </button>
        </div>
    </div>
</div>