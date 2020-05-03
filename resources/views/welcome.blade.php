@extends('layouts.marketing')

@section('content')
<div class="relative min-h-screen bg-white overflow-hidden">
    <div class="max-w-screen-xl mx-auto ">
        <div class="relative z-10 bg-white lg:max-w-2xl lg:w-full min-h-screen">
            <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2"
                fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
                <polygon points="50,0 100,0 50,100 0,100" />
            </svg>

            <div class="h-screen mx-auto max-w-screen-xl flex items-center justify-center">
                <div class="sm:text-center lg:text-left">
                    <div
                        class="text-sm font-semibold uppercase tracking-wide text-gray-500 sm:text-base lg:text-sm xl:text-base mb-2">
                        Introducing
                    </div>
                    <h2
                        class="text-5xl tracking-tight leading-10 font-extrabold text-gray-900 sm:text-5xl sm:leading-none md:text-6xl">
                        🃏🎉<span class="sr-only">Card Party</span>
                    </h2>
                    <p
                        class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                        Play Progressive Rummy with your friends and family, no matter where they are in the world!
                    </p>
                    {{-- <div class="mt-5 sm:max-w-lg sm:mx-auto sm:text-center lg:text-left lg:mx-0">
                        <p class="text-base font-medium text-gray-900">
                            Sign up to get notified when it’s ready.
                        </p>
                        <form action="#" method="POST" class="mt-3 sm:flex">
                            <input aria-label="Email"
                                class="appearance-none block w-full px-3 py-3 border border-gray-300 text-base leading-6 rounded-md placeholder-gray-500 shadow-sm focus:outline-none focus:placeholder-gray-400 focus:shadow-outline focus:border-blue-300 transition duration-150 ease-in-out sm:flex-1"
                                placeholder="Enter your email" />
                            <button type="submit"
                                class="mt-3 w-full px-6 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-gray-800 shadow-sm hover:bg-gray-700 focus:outline-none focus:shadow-outline active:bg-gray-900 transition duration-150 ease-in-out sm:mt-0 sm:ml-3 sm:flex-shrink-0 sm:inline-flex sm:items-center sm:w-auto">
                                Notify me
                            </button>
                        </form>
                        <p class="mt-3 text-sm leading-5 text-gray-500">
                            We care about the protection of your data. Read our
                            <a href="#" class="font-medium text-gray-900 underline">Privacy Policy</a>.
                        </p>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2 bg-green-300">
        <div class="w-full grid grid-cols-6 gap-2" style="transform: rotate(5deg) translateY(-100px);">
            @foreach($cards as $card)
            <x-card :card="$card" :key="$loop->index" class="card" />
            @endforeach
        </div>
    </div>
</div>
@endsection