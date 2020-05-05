@component('mail::message')
@lang('Hi'),

@lang('Campaign **:campaignname** was sent to **:number_of_subscribers** subscribers (list :emaillistname) on :sentat',['campaignname'=>$campaign->name,'number_of_subscribers'=>($campaign->sent_to_number_of_subscribers ?? 0 ),'emaillistname'=>$campaign->emailList->name,'sentat'=>$campaign->sent_at->toMailcoachFormat()]).


<table class="stats">
<tr>
@if ($campaign->track_opens)
<td>
@include('mailcoach::mails.partials.statistic', [
'href' => route('mailcoach.campaigns.opens', $campaign),
'stat' => $campaign->open_count,
'label' => __('Opens'),
])
</td>
<td>
@include('mailcoach::mails.partials.statistic', [
'stat' => $campaign->unique_open_count,
'label' => __('Unique Opens'),
])
</td>
<td>
@include('mailcoach::mails.partials.statistic', [
'stat' => $campaign->open_rate,
'suffix' => '%',
'label' => __('Open Rate'),
])
</td>
@else
<td colspan=3>
<div class="text-4xl font-semibold">–</div>
<div class="text-sm">@lang('Opens not tracked')</div>
</td>
@endif
</tr>

<tr>
@if($campaign->track_clicks)
<td>
@include('mailcoach::mails.partials.statistic', [
'href' => route('mailcoach.campaigns.clicks', $campaign),
'stat' => $campaign->click_count,
'label' => __('Clicks'),
])
</td>
<td>
@include('mailcoach::mails.partials.statistic', [
'stat' => $campaign->unique_click_count,
'label' => __('Unique Clicks'),
])
</td>
<td>
@include('mailcoach::mails.partials.statistic', [
'stat' => $campaign->click_rate,
'suffix' => '%',
'label' => __('Clicks Rate'),
])
</td>
@else
<td colspan=3>
<div class="text-4xl font-semibold">–</div>
<div class="text-sm">@lang('Clicks not tracked')</div>
</td>
@endif
</tr>

<tr>
<td>
@include('mailcoach::mails.partials.statistic', [
'href' => route('mailcoach.campaigns.unsubscribes', $campaign),
'stat' => $campaign->unsubscribe_count,
'label' => __('Unsubscribes'),
])
</td>
<td>
@include('mailcoach::mails.partials.statistic', [
'stat' => $campaign->unsubscribe_rate,
'label' => __('Unsubscribe Rate'),
'suffix' => '%'
])
</td>
<td></td>
</tr>

<tr>
<td>
@include('mailcoach::mails.partials.statistic', [
'href' => route('mailcoach.campaigns.outbox', $campaign),
'stat' => $campaign->bounce_count,
'label' => 'Bounces',
])
</td>
<td>
@include('mailcoach::mails.partials.statistic', [
'stat' => $campaign->bounce_rate,
'label' => 'Bounce Rate',
'suffix' => '%'
])
</td>
<td></td>
</tr>
</table>

@component('mail::button', ['url' => $summaryUrl])
	@lang('View summary')
@endcomponent

@endcomponent
