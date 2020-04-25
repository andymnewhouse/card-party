@extends('layouts.app', ['title' => 'Create an Account'])

@section('content')

<div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
    <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div>
                <label for="name" class="form-label">
                    {{ __('Name') }}
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                    <input id="name" type="text" name="name" value="{{ old('name') }}" autocomplete="name" autofocus
                        class="form-control @error('name') border-red-500 @enderror" />
                </div>

                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
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
                <span class="block w-full rounded-md shadow-sm">
                    <button type="submit"
                        class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                        Register
                    </button>
                </span>
            </div>
        </form>
    </div>
</div>
@endsection