@extends('mailcoach::landingPages.layouts.landingPage', ['title' => 'Already unsubscribed'])

@section('content')
    <p>
        You were already unsubscribed from the list <strong class="font-semibold">{{ $emailList->name }}</strong>.
    </p>
@endsection
