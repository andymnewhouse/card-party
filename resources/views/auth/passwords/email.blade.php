@extends('layouts.app', ['title' => __('Reset Password')])

@section('content')
<div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
    <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <h1 class="mb-6 text-3xl leading-9 font-extrabold text-gray-900">
            {{ __('Reset Password') }}
        </h1>
        @if (session('status'))
        <x-alert type="success" message="{{ session('status') }}" class="mb-4" />
        @endif

        <form action="{{ route('password.email') }}" method="POST">
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
                <span class="text-red-700 mt-1" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-6">
                <span class="block w-full btn-shadow">
                    <button type="submit" class="w-full flex justify-center btn btn-base btn-blue-gray-primary">
                        {{ __('Send Password Reset Link') }}
                    </button>
                </span>
            </div>
        </form>
    </div>
</div>
@endsection