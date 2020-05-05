@extends('mailcoach::app.layouts.app', [
    'title' => (isset($titlePrefix) ?  $titlePrefix . ' | ' : '') . $campaign->name
])

@section('header')
    <nav>
        <ul class="breadcrumbs">
            <li>
                <a href={{ route('mailcoach.campaigns') }}>
                    <span class="breadcrumb">Campaigns</span>
                </a>
            </li>
            @yield('breadcrumbs')
        </ul>
    </nav>
@endsection

@section('content')
    <nav class="tabs">
        <ul>
            <x-navigation-item :href="route('mailcoach.campaigns.summary', $campaign)">
                <x-icon-label icon="fa-chart-area" text="Summary" />
            </x-navigation-item>
            <x-navigation-item :href="route('mailcoach.campaigns.opens', $campaign)">
                <x-icon-label icon="fa-envelope-open-text" text="Opens" />
            </x-navigation-item>
            <x-navigation-item :href="route('mailcoach.campaigns.clicks', $campaign)">
                <x-icon-label icon="fa-hand-pointer" text="Clicks" />
            </x-navigation-item>
            <x-navigation-item :href="route('mailcoach.campaigns.unsubscribes', $campaign)">
                <x-icon-label icon="fa-user-slash" text="Unsubscribes" />
            </x-navigation-item>
            <x-navigation-item :href="route('mailcoach.campaigns.outbox', $campaign)">
                <x-icon-label icon="fa-inbox" text="Outbox" />
            </x-navigation-item>
        </ul>
    </nav>

    <section class="card ">
        @yield('campaign')
    </section>
@endsection
