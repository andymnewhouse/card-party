@component('mail::message')
@lang('Hi'),

@lang('Here\'s what\'s been happening last week at your list **:emaillistname** since :startdate',['emaillistname'=>$emailList->name,'startdate'=>$summaryStartDateTime->toMailcoachFormat()]).

@component('mail::panel')
- @lang('New subscriptions'): <strong>{{ $summary['total_number_of_subscribers_gained'] }}</strong>
- @lang('Unsubscribes'): <strong>{{ $summary['total_number_of_unsubscribes_gained'] }}</strong>
- @lang('Total number of subscribers'): <strong>{{ $summary['total_number_of_subscribers'] }}</strong>
@endcomponent

@component('mail::button', ['url' => $emailListUrl])
    @lang('View list')
@endcomponent

@endcomponent
