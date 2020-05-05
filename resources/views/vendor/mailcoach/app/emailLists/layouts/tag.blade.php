@extends('mailcoach::app.layouts.app', [
    'title' => (isset($titlePrefix) ?  $titlePrefix . ' | ' : '') . $tag->name
])

@section('header')
<nav>
    <ul class="breadcrumbs">
        <li>
            <a href="{{ route('mailcoach.emailLists') }}">
                <span class="breadcrumb">Lists</span>
            </a>
        </li>
        <li><a href="{{ route('mailcoach.emailLists.subscribers', $tag->emailList) }}"><span class="breadcrumb">{{ $tag->emailList->name }}</span></a></li>
        <li><a href="{{ route('mailcoach.emailLists.segments', $tag->emailList) }}"><span class="breadcrumb">Tags</span></a></li>
        @yield('breadcrumbs')
    </ul>
</nav>
@endsection

@section('content')
<nav class="tabs">
    <ul>
        <x-navigation-item :href="route('mailcoach.emailLists.tag.edit', [$tag->emailList, $tag])">
            <x-icon-label icon="fa-tag" text="Tag details" />
        </x-navigation-item>
    </ul>
</nav>

<section class="card">
    @yield('tag')
</section>
@endsection
