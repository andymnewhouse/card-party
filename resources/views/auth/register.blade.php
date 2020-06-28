@extends('layouts.app', ['title' => 'Create an Account'])

@section('content')

<div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
    <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <form action="{{ route('register') }}" method="POST">
            @csrf
            @honeypot

            <div>
                <label for="name" class="form-label">
                    {{ __('Name') }}
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                    <input id="name" type="text" name="name" value="{{ old('name') }}" autocomplete="name" autofocus
                        class="form-control @error('name') border-red-500 @enderror" />
                </div>

                @error('name')
                <span class="text-red-700 mt-1" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-6">
                <label for="email" class="form-label">
                    {{ __('E-Mail Address') }}
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                        class="form-control @error('email') border-red-500 @enderror" />
                </div>

                @error('email')
                <span class="text-red-700 mt-1" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-6">
                <label for="password" class="form-label">
                    {{ __('Password') }}
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                        class="form-control @error('password') border-red-500 @enderror" />
                </div>

                @error('password')
                <span class="text-red-700 mt-1" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-6">
                <label for="password-confirm" class="form-label">
                    {{ __('Confirm Password') }}
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                        required autocomplete="new-password" />
                </div>
            </div>

            <div class="mt-6">
                <span class="block w-full btn-shadow">
                    <button type="submit" class="w-full flex justify-center btn btn-base btn-blue-gray-primary">
                        Register
                    </button>
                </span>
            </div>
        </form>
    </div>
</div>
@endsection