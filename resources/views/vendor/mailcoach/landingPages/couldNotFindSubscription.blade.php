@extends('mailcoach::landingPages.layouts.landingPage', ['title' => 'Could not find subscription'])

@section('content')
<h1>
    We could not find your subscription to this list.
</h1>
<p class="mt-4">
    The link you used seems invalid.
</p>
<a href="/" class="btn btn-lg btn-blue-gray-primary">Go Home</a>
@endsection