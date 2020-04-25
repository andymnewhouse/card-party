@extends('layouts.app', ['title' => 'Login'])

@section('content')

<div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
    <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div>
                <label for="email" class="form-label">
                    {{ __('E-Mail Address') }}
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                        class="form-control @error('email') border-red-500 @enderror" />
                </div>
            </div>

            <div class="mt-6">
                <label for="password" class="form-label">
                    {{ __('Password') }}
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                        class="form-control @error('password') border-red-500 @enderror" />
                </div>
            </div>

            <div class="mt-6 flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" />
                    <label for="remember_me" class="ml-2 block text-sm leading-5 text-gray-900">
                        Remember me
                    </label>
                </div>

                <div class="text-sm leading-5">
                    <a href="#"
                        class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                        Forgot your password?
                    </a>
                </div>
            </div>

            <div class="mt-6">
                <span class="block w-full rounded-md shadow-sm">
                    <button type="submit"
                        class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                        Login
                    </button>
                </span>
            </div>
        </form>
    </div>
</div>
@endsection