<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ isset($title) ? "{$title} | Card Party" : 'Card Party' }}</title>

    <link rel="stylesheet" href="https://use.typekit.net/tzh4hkx.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="h-screen relative bg-white overflow-hidden">
        <div class="max-w-screen-xl mx-auto ">
            <div
                class="relative h-screen z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <svg class="hidden h-screen lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2"
                    fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <polygon points="50,0 100,0 50,100 0,100" />
                </svg>

                <div class="relative pt-6 px-4 sm:px-6 lg:px-8">
                    <nav class="relative flex items-center justify-between sm:h-10 lg:justify-start">
                        <div class="flex items-center flex-grow flex-shrink-0 lg:flex-grow-0">
                            <div class="flex items-center justify-between w-full md:w-auto">
                                <a href="/">
                                    <svg class="w-16 h-16 text-red-500" fill="currentColor" viewBox="0 0 68.45 39.97">
                                        <path
                                            d="M67 10.9L52.63 1.49a3.12 3.12 0 00-2.36-.43 3.06 3.06 0 00-2 1.34l-2.76 4.29L45.35 3a3.12 3.12 0 00-3.25-3L24.91.74a3 3 0 00-2.17 1A3.08 3.08 0 0021.93 4L22 6.06l-2.63-3.5A3.11 3.11 0 0015 1.93L1.25 12.24a3.12 3.12 0 00-.63 4.37l16.55 22.11a3.1 3.1 0 002.06 1.22 3.4 3.4 0 00.45 0 3.13 3.13 0 001.86-.62L28 34.5l12.43-.5 8.1 5.29a3.08 3.08 0 001.7.51 3.57 3.57 0 00.65-.06 3.06 3.06 0 002-1.35l15.06-23.17A3.12 3.12 0 0067 10.9zM20.3 37.68a1 1 0 01-.77.2 1.06 1.06 0 01-.69-.41L2.29 15.36a1 1 0 01-.2-.77 1 1 0 01.4-.68L16.27 3.6a1 1 0 01.62-.21 1.06 1.06 0 01.84.41l4.44 5.94.94 21.84a3.12 3.12 0 001.76 2.68zM31 32.29l-3.69.16h-1a1 1 0 01-1.08-1l-.81-18.8L24.23 9 24 3.9a1 1 0 01.27-.75 1 1 0 01.73-.33l17.19-.74h.05a1 1 0 011 1l.29 6.6-8.74 13.44L33.58 25l-.37.56a3.16 3.16 0 00-.33 2.73 3.11 3.11 0 001.24 1.59h.06L37.43 32zm35.2-18.21L51.11 37.21a1 1 0 01-1.44.3L44 33.78l-3-1.92-5.14-3.35-.6-.4a1 1 0 01-.3-1.44l1.15-1.76 7.6-11.65 1.95-3 4.39-6.72a1 1 0 01.65-.45 1 1 0 01.79.15l14.41 9.4a1 1 0 01.3 1.44zM10.9 20c.36-3 4.27-2.38 4.27-2.38s.33-4 3.33-3.58c5 .6 2 10.37 2 10.37S10.3 25 10.9 20zm-3.11-3S9 13.06 7 12.82c-1.2-.15-1.33 1.43-1.33 1.43S4.1 14 4 15.2C3.71 17.19 7.79 17 7.79 17zM34 10.59s-7.42 5.68-4.05 8.77c1.5 1.38 3.17.25 3.94-.44A5.54 5.54 0 0132.5 22v.7l3.9-.17v-.7a5.6 5.6 0 01-1.62-3c.84.63 2.59 1.6 4 .1 3.06-3.32-4.78-8.34-4.78-8.34zm-4.12-3.15a1.14 1.14 0 01-1.59 0 2.31 2.31 0 00.65 1.2v.28L27.39 9v-.33a2.29 2.29 0 00.54-1.25 1.15 1.15 0 01-1.58.17C25 6.36 28 4.08 28 4.08s3.12 2.01 1.88 3.36zm24.7 17a2.81 2.81 0 01-3.89.66 3 3 0 01-1.33-2 5 5 0 00-.21 2.79l-.37.57-3.26-2.12.38-.58a5.05 5.05 0 002.47-1.31 3 3 0 01-2.37-.37 2.69 2.69 0 112.92-4.49 2.88 2.88 0 01.53.44 2.57 2.57 0 01.35-2 2.9 2.9 0 014.85 3.16 2.52 2.52 0 01-1.6 1.09h-.06.06a3 3 0 01.56.29 2.79 2.79 0 01.97 3.9zM53.29 9.05a1.12 1.12 0 01-1.55.26 1.19 1.19 0 01-.54-.79 2.07 2.07 0 00-.08 1.11l-.12.23L49.67 9l.15-.24a2.06 2.06 0 001-.52 1.25 1.25 0 01-1-.17 1.11 1.11 0 01-.38-1.53A1.12 1.12 0 0151 6.3a1.2 1.2 0 01.21.17 1.08 1.08 0 01.14-.78 1.13 1.13 0 011.56-.27A1.12 1.12 0 0153.32 7a1 1 0 01-.64.44.94.94 0 01.22.12 1.12 1.12 0 01.39 1.49zm-5.53 22.62a1.13 1.13 0 011.55-.27 1.19 1.19 0 01.53.8 2 2 0 00.09-1.11l.15-.23 1.3.84-.15.23a2 2 0 00-1 .53 1.22 1.22 0 01.95.17A1.07 1.07 0 1150 34.42a1.24 1.24 0 01-.22-.18 1 1 0 01-.13.79 1.13 1.13 0 01-1.56.26 1.11 1.11 0 01-.38-1.53 1 1 0 01.64-.43l-.23-.11a1.13 1.13 0 01-.36-1.55z" />
                                    </svg>
                                </a>
                                <div class="-mr-2 flex items-center md:hidden">
                                    <button type="button"
                                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 6h16M4 12h16M4 18h16" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="hidden md:block md:ml-10 md:pr-4">
                            <a href="/about"
                                class=" font-medium text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900 transition duration-150 ease-in-out">About</a>
                            <a href="/blog"
                                class="ml-8 font-medium text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900 transition duration-150 ease-in-out">Blog</a>
                            <a href="/pricing"
                                class="ml-8 font-medium text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900 transition duration-150 ease-in-out">Pricing</a>
                            <a href="/transparency"
                                class="ml-8 font-medium text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900 transition duration-150 ease-in-out">Transparency</a>
                        </div>
                    </nav>
                </div>

                <div class="h-full mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8 flex items-center">
                    <div class="sm:text-center lg:text-left">
                        <div class="text">
                            @yield('content')
                        </div>

                        <div class="pt-8 text-gray-400 text-xs text-center">
                            Powered by
                            <a class="link-dimmed inline-flex items-center" href="https://mailcoach.app">
                                Mailcoach
                                <span class="h-5 ml-1">
                                    @include('mailcoach::app.layouts.partials.logoSvg')
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full"
                src="/assets/card-party-play-with-pug.jpg"
                alt="Card Party on a MacBook on a gray couch with a pug sitting close by" />
            <div class="w-full h-full absolute inset-0"
                style="background: linear-gradient(to bottom right, rgba(241,96,97,.4), rgba(171,59,59,.4))">
            </div>
        </div>
    </div>
</body>

</html>