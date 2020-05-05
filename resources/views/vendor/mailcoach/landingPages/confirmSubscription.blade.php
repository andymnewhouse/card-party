@extends('mailcoach::landingPages.layouts.landingPage', ['title' => 'Confirm subscription'])

@section('content')
<h1>
    Hey, is that really you?
</h1>
<p>
    We've sent you an email to confirm your subscription.
</p>
<a href="{{ url()->previous() }}" class="btn btn-lg btn-blue-gray-primary">Go Back</a>
@endsection