@component('mail::message')
@lang('Hey'),

@lang('You are almost subscribed to the list **:emaillistname**.',['emaillistname'=>$subscriber->emailList->name]).

@lang('Prove it is really you by pressing the button below').

@component('mail::button', ['url' => $confirmationUrl])
    @lang('Confirm subscription')
@endcomponent

@endcomponent
