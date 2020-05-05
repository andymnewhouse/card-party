@extends('mailcoach::app.layouts.app', [
    'title' => (isset($titlePrefix) ?  $titlePrefix . ' | ' : '') . $emailList->name
])



@section('header')
    <nav>
        <ul class="breadcrumbs">
            <li>
                <a href="{{ route('mailcoach.emailLists') }}">
                    <span class="breadcrumb">Lists</span>
                </a>
            </li>
            @yield('breadcrumbs')
        </ul>
    </nav>
@endsection

@section('content')
    <nav class="tabs">
        <ul>
            <x-navigation-item :href="route('mailcoach.emailLists.subscribers', $emailList)">
                <x-icon-label icon="fa-users" text="Subscribers" :count="$emailList->subscribers()->count() ?? 0" />
            </x-navigation-item>
            <x-navigation-item :href="route('mailcoach.emailLists.tags', $emailList)">
                <x-icon-label icon="fa-tag" text="Tags" />
            </x-navigation-item>
            <x-navigation-item :href="route('mailcoach.emailLists.segments', $emailList)">
                <x-icon-label icon="fa-chart-pie" text="Segments" />
            </x-navigation-item>
            <x-navigation-item :href="route('mailcoach.emailLists.settings', $emailList)">
                <x-icon-label icon="fa-cog" text="Settings" />
            </x-navigation-item>
            @include('mailcoach::app.emailLists.layouts.partials.afterLastTab')
        </ul>
    </nav>

    <section class="card ">
        @yield('emailList')
    </section>
@endsection
