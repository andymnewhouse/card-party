@component('mailcoach::mails.layout.message')
@lang('Good job!')

@lang('Campaign **:campaignname** was sent to **:number_of_subscribers** subscribers (list :emaillistname)',['campaignname'=>$campaign->name,'number_of_subscribers'=>($campaign->sent_to_number_of_subscribers ?? 0 ),'emaillistname'=>$campaign->emailList->name]).

@component('mailcoach::mails.layout.button', ['url' => $summaryUrl])
    @lang('View summary')
@endcomponent

@endcomponent
