@component('mail::message')
# Hi!

You've been invited to join a Card Party!

@component('mail::button', ['url' => $url])
Join Now
@endcomponent

Keep Playing,<br>
Andy from {{ config('app.name') }}
@endcomponent