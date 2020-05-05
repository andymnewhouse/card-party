@extends('mailcoach::landingPages.layouts.landingPage', ['title' => 'Subscribed'])

@section('content')
<h1>
    Happy to have you!
</h1>
<p>
    @isset($subscriber)
    You are now subscribed to the list <strong class="font-semibold">{{ $subscriber->emailList->name }}</strong>.
    @else
    You are now subscribed to the list <strong class="font-semibold">our dummy mailing list</strong>.
    @endif
</p>
<a href="/" class="btn btn-lg btn-blue-gray-primary">Go Home</a>
@endsection