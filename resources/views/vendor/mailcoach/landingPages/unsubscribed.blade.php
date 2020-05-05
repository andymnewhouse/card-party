@extends('mailcoach::landingPages.layouts.landingPage', ['title' => 'Unsubscribed'])

@section('content')
    <p>
        Sorry to see you go.
    </p>
    <p class="mt-4">
        You have been unsubscribed from list <strong class="font-semibold">{{ $subscriber->emailList->name }}</strong>.
    </p>
@endsection
