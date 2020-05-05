<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="referrer" content="always">

        <title>{{ isset($title) ? "{$title} | Mailcoach" : 'Mailcoach' }}</title>

        <link rel="stylesheet" href="{{ asset('vendor/mailcoach/app.css') }}?t={{ app(\Spatie\Mailcoach\Support\Version::class)->getHashedFullVersion() }}">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.0/css/all.css">
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

        <meta name="turbolinks-cache-control" content="no-preview">

        <script type="text/javascript" src="{{ asset('vendor/mailcoach/app.js') }}?t={{ app(\Spatie\Mailcoach\Support\Version::class)->getHashedFullVersion() }}" defer></script>

        @include('mailcoach::app.layouts.partials.endHead')
        @stack('endHead')
    </head>
    <body class="bg-blue-100">
        <script>/**/</script><!-- Empty script to prevent FOUC in Firefox -->

        @include('mailcoach::app.layouts.partials.startBody')

        @include('mailcoach::app.layouts.partials.background')

        @include('mailcoach::app.layouts.partials.flash')

        <div class="layout">
            <header class="layout-header text-white">
                <a href="{{ route('mailcoach.home') }}" class="hidden h-8 opacity-50 mr-1 | hover:opacity-75 | lg:block">
                    @include('mailcoach::app.layouts.partials.logoSvg')
                </a>

                <div>
                    @yield('header')
                </div>

            </header>

            <nav class="layout-header-right">
                @include('mailcoach::app.layouts.partials.headerRight')
            </nav>

            <nav class="layout-nav text-white">
                @include('mailcoach::app.layouts.partials.navigation')
            </nav>

            <main class="layout-main">
                @yield('content')
            </main>

            <footer class="layout-footer">
                @include('mailcoach::app.layouts.partials.footer')
            </footer>
        </div>

        <x-modal title="Confirm" name="confirm">
            <span data-confirm-modal-text>Are you sure?</span>

            <div class="form-buttons">
                <button type="button" class="button" data-modal-confirm>
                    Confirm
                </button>
                <button type="button" class="button-cancel" data-modal-dismiss>
                    Cancel
                </button>
            </div>
        </x-modal>

        <x-modal title="Confirm navigation" name="dirty-warning">
            There are unsaved changes. Are you sure you want to continue?

            <div class="form-buttons">
                <button type="button" class="button" data-modal-confirm>
                    Continue
                </button>
                <button type="button" class="button-cancel" data-modal-dismiss>
                    Cancel
                </button>
            </div>
        </x-modal>

        @stack('modals')
    </body>
</html>
