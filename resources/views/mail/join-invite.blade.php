@component('mail::message')
# Hi!

@if($firstName === 'Someone')
You've been invited to join a Card Party!
@else
{{ $firstName }} invited you to join a Card Party!
@endif

@if($message)
They wanted us to pass along this message:

{!! nl2br($message) !!}
@endif


@component('mail::button', ['url' => $url])
Join Now
@endcomponent

Keep Playing,<br>
Andy from {{ config('app.name') }}
@endcomponent