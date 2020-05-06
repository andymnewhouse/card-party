<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? ''}} - {{ config('app.name', 'Laravel') }}</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/img/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('/img/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('/img/favicon/safari-pinned-tab.svg" color="#f16061') }}">
    <link rel="shortcut icon" href="{{ asset('/img/favicon/favicon.ico') }}">
    <meta name="msapplication-TileColor" content="#f16061">
    <meta name="msapplication-config" content="{{ asset('/img/favicon/browserconfig.xml') }}">
    <meta name="theme-color" content="#ffffff">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <!-- Styles -->
    <link rel="stylesheet" href="https://use.typekit.net/tzh4hkx.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles
</head>

<body class="bg-gray-100">
    @include('layouts.partials.nav')

    <livewire:notifications />
    <main class="h-full">
        @yield('content')
    </main>

    @livewireScripts
</body>

</html>