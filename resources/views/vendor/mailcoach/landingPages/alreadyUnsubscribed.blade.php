@extends('mailcoach::landingPages.layouts.landingPage', ['title' => 'Already unsubscribed'])

@section('content')
<p>
    You were already unsubscribed from the list <strong class="font-semibold">{{ $emailList->name }}</strong>.
</p>
<a href="/" class="btn btn-lg btn-blue-gray-primary">Go Home</a>
@endsection