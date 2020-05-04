@extends('layouts.app', ['title' => 'Login'])

@section('content')
<div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
    <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            @honeypot

            <div>
                <label for="email" class="form-label">
                    {{ __('E-Mail Address') }}
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                        class="form-control @error('email') border-red-500 @enderror" />
                </div>

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mt-6">
                <label for="password" class="form-label">
                    {{ __('Password') }}
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="form-control @error('password') border-red-500 @enderror" />
                </div>

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mt-6 flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" {{ old('remember') ? 'checked' : '' }}
                        class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" />
                    <label for="remember_me" class="ml-2 block text-sm leading-5 text-gray-900">
                        {{ __('Remember Me') }}
                    </label>
                </div>

                <div class="text-sm leading-5">
                    <a href="{{ route('password.request') }}"
                        class="font-medium text-red-600 hover:text-red-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                        {{ __('Forgot Your Password?') }}
                    </a>
                </div>
            </div>

            <div class="mt-6">
                <span class="block w-full btn-shadow">
                    <button type="submit" class="w-full flex justify-center btn btn-base btn-blue-gray-primary">
                        Login
                    </button>
                </span>
            </div>
        </form>
    </div>
</div>
@endsection