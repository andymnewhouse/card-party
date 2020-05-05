@extends('mailcoach::landingPages.layouts.landingPage', ['title' => 'Unsubscribed'])

@section('content')
<h1>
    Sorry to see you go.
</h1>
<p class="mt-4">
    You have been unsubscribed from list <strong class="font-semibold">{{ $subscriber->emailList->name }}</strong>.
</p>
<a href="/" class="btn btn-lg btn-blue-gray-primary">Go Home</a>
@endsection