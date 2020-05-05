@extends('mailcoach::app.campaigns.sent.layouts.show', ['campaign' => $campaign])

@section('breadcrumbs')
    <li><span class="breadcrumb">{{ $campaign->name }}</span></li>
@endsection

@section('campaign')
    <div @if(!$campaign->sent_at || $campaign->sent_at->addDay()->isFuture()) id="campaign-summary" data-poll @endif>
        @if((! $campaign->isSent()) || (! $campaign->wasSentToAllSubscribers()))
            @if (! $campaign->sent_to_number_of_subscribers)
                <div class="flex alert alert-info">
                    <div class="mr-2">
                        <i class="fas fa-sync fa-spin text-blue-500"></i>
                    </div>
                    <div>
                        Campaign <a target="_blank"
                                    href="{{ $campaign->webviewUrl() }}">{{ $campaign->name }}</a>
                        is preparing to send to
                        <a href="{{ route('mailcoach.emailLists.subscribers', $campaign->emailList) }}">{{ $campaign->emailList->name }}</a>
                    </div>
                </div>
            @else
                <div class="progress-bar">
                    <div class="progress-bar-value"
                         style="width:{{ ($campaign->sendsCount() / $campaign->sent_to_number_of_subscribers) * 100 }}%"></div>
                </div>
                <div class="mt-4 flex alert alert-info">
                    <div class="mr-2">
                        <i class="fas fa-sync fa-spin text-blue-500"></i>
                    </div>
                    <div>
                        Campaign <a target="_blank"
                                    href="{{ $campaign->webviewUrl() }}">{{ $campaign->name }}</a>
                        is sending to
                        <strong>{{ $campaign->sendsCount() }}</strong>/{{ $campaign->sent_to_number_of_subscribers }} {{ \Illuminate\Support\Str::plural('subscriber', $campaign->sent_to_number_of_subscribers) }}
                        of
                        <a
                                href="{{ route('mailcoach.emailLists.subscribers', $campaign->emailList) }}">{{ $campaign->emailList->name }}</a>
                        @if($campaign->usesSegment())
                            ({{ $campaign->segment_description }})
                        @endif
                    </div>
                </div>
            @endif
        @else
            <div class="grid grid-cols-auto-1fr gap-2 alert alert-success">
                <div>
                    <i class="fas fa-check text-green-500"></i>
                </div>
                <div>
                    Campaign <a target="_blank"
                                href="{{ $campaign->webviewUrl() }}">{{ $campaign->name }}</a>
                    was delivered succesfully to
                    <strong>{{ $campaign->sent_to_number_of_subscribers - ($failedSendsCount ?? 0) }} {{ \Illuminate\Support\Str::plural('subscriber', $campaign->sent_to_number_of_subscribers) }}</strong>
                    of
                    <a
                            href="{{ route('mailcoach.emailLists.subscribers', $campaign->emailList) }}">{{ $campaign->emailList->name }}</a>
                    @if($campaign->usesSegment())
                        ({{ $campaign->segment_description }})
                    @endif
                </div>

                @if($failedSendsCount)
                <div>
                    <i class="fas fa-times text-red-500"></i>
                </div>
                <div>
                    Delivery failed for <strong>{{ $failedSendsCount }}</strong> {{ \Illuminate\Support\Str::plural('subscriber', $failedSendsCount) }}.
                    <a class="underline"
                    href="{{ route('mailcoach.campaigns.outbox', $campaign) . '?filter[type]=failed' }}">Check the outbox</a>.
                </div>
                @endif

                <div class="col-start-2 text-sm text-green-600">{{ $campaign->sent_at->toMailcoachFormat() }}</div>
            </div>


            <h2 class="markup-h2 mt-12">24-hour performance</h2>

            <div class="mt-6">
                @include('mailcoach::app.campaigns.partials.chart')
            </div>
        @endif

        <hr class="border-t-2 border-gray-200 my-8">

        <h2 class="markup-h2">Statistics</h2>

        <div class="mt-6 grid grid-cols-3 gap-6 justify-start items-end max-w-xl">
            @if ($campaign->track_opens)
                <x-statistic :href="route('mailcoach.campaigns.opens', $campaign)" class="col-start-1"
                             numClass="text-4xl font-semibold" :stat="$campaign->unique_open_count" label="Unique Opens"/>
                <x-statistic :stat="$campaign->open_count" label="Opens"/>
                <x-statistic :stat="$campaign->open_rate" label="Open Rate" suffix="%"/>
            @else
                <div class="col-start-1 col-span-3">
                    <div class="text-4xl font-semibold">–</div>
                    <div class="text-sm">Opens not tracked</div>
                </div>
            @endif

            @if($campaign->track_clicks)
                <x-statistic :href="route('mailcoach.campaigns.clicks', $campaign)" class="col-start-1"
                             numClass="text-4xl font-semibold" :stat="$campaign->unique_click_count" label="Unique Clicks"/>
                <x-statistic :stat="$campaign->click_count" label="Clicks"/>
                <x-statistic :stat="$campaign->click_rate" label="Click Rate" suffix="%"/>
            @else
                <div class="col-start-1 col-span-3">
                    <div class="text-4xl font-semibold">–</div>
                    <div class="text-sm">Clicks not tracked</div>
                </div>
            @endif

            <x-statistic :href="route('mailcoach.campaigns.unsubscribes', $campaign)" numClass="text-4xl font-semibold"
                         :stat="$campaign->unsubscribe_count" label="Unsubscribes"/>
            <x-statistic :stat="$campaign->unsubscribe_rate" label="Unsubscribe Rate" suffix="%"/>

            <x-statistic :href="route('mailcoach.campaigns.outbox', $campaign) . '?filter[type]=bounced'"
                         class="col-start-1" numClass="text-4xl font-semibold" :stat="$campaign->bounce_count"
                         label="Bounces"/>
            <x-statistic :stat="$campaign->bounce_rate" label="Bounce Rate" suffix="%"/>

        </div>
    </div>
@endsection
