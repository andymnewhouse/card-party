@component('mail::message')
@lang('Hi'),

@lang('You are now subscribed to list :emaillistname',['emaillistname'=>$subscriber->emailList->name]).

@lang('Happy to have you')!

@slot('subcopy')
	@lang('If you accidentally subscribed to this list, click here to <a href=":unsubscribelink">unsubscribe</a>',['unsubscribelink'=>$subscriber->unsubscribeUrl()])
@endslot

@endcomponent
