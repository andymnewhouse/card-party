@extends('layouts.app')

@section('content')
<div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
    <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <h1 class="mb-6 text-3xl leading-9 font-extrabold text-gray-900">
            {{ __('Reset Password') }}
        </h1>
        @if (session('status'))
        <x-alert type="success" message="{{ session('status') }}" class="mb-4" />
        @endif

        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            @honeypot

            <input type="hidden" name="token" value="{{ $token }}">

            <div>
                <label for="email" class="form-label">
                    {{ __('E-Mail Address') }}
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                    <input id="email" type="email" class="form-control @error('email') border-red-500 @enderror"
                        name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus />
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
                        {{ __('Reset Password') }}
                    </button>
                </span>
            </div>
        </form>
    </div>
</div>
@endsection