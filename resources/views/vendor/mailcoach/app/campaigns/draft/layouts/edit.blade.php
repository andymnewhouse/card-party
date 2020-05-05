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
            <x-navigation-item :href="route('mailcoach.campaigns.settings', $campaign)" data-dirty-warn>
                <x-icon-label icon="fa-cog" text="Settings" />
            </x-navigation-item>
            <x-navigation-item :href="route('mailcoach.campaigns.content', $campaign)" data-dirty-warn>
                <x-icon-label icon="fa-code" text="Content" />
            </x-navigation-item>
            <x-navigation-item :href="route('mailcoach.campaigns.delivery', $campaign)" data-dirty-warn>
                <x-icon-label icon="fa-paper-plane" text="Delivery" />
            </x-navigation-item>
        </ul>
    </nav>
    <section class="card ">

        @yield('campaign')
    </section>
@endsection
