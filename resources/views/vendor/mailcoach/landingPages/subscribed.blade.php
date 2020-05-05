@extends('mailcoach::landingPages.layouts.landingPage', ['title' => 'Subscribed'])

@section('content')
    <p>
        Happy to have you!
    </p>
    <p class="mt-4">
        @isset($subscriber)
        You are now subscribed to the list <strong class="font-semibold">{{ $subscriber->emailList->name }}</strong>.
        @else
            You are now subscribed to the list <strong class="font-semibold">our dummy mailing list</strong>.
        @endif
    </p>
@endsection

