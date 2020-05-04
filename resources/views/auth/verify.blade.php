@extends('layouts.app', ['title' => __('Verify Your Email Address')])

@section('content')
<div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
    <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <h1 class="mb-6 text-3xl leading-9 font-extrabold text-gray-900">
            {{ __('Verify Your Email Address') }}
        </h1>
        @if (session('resent'))
        <x-alert type="success" message="{{ __('A fresh verification link has been sent to your email address.') }}"
            class="mb-4" />
        @endif

        <div class="text">
            <p>{{ __('Before proceeding, please check your email for a verification link.') }}</p>
            <p>{{ __('If you did not receive the email') }}:</p>
        </div>

        <form method="POST" action="{{ route('verification.resend') }}">
            @csrf
            @honeypot

            <button type="submit" class="btn btn-base btn-blue-gray-primary">{{ __('Request Another Email') }}</button>
        </form>
    </div>
</div>
@endsection