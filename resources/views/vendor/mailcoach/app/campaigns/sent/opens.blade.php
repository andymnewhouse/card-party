@extends('mailcoach::app.campaigns.sent.layouts.show', [
    'campaign' => $campaign,
    'titlePrefix' => 'Opens',
])

@section('breadcrumbs')
    <li>
        <a href="{{ route('mailcoach.campaigns.summary', $campaign) }}">
            <span class="breadcrumb">{{ $campaign->name }}</span>
        </a>
    </li>
    <li><span class="breadcrumb">Opens</span></li>
@endsection

@section('campaign')
    @if($campaign->track_opens)
        @if($campaign->open_count)
            <div class="table-actions">
                <div class="table-filters">
                    <x-search placeholder="Filter opens" />
                </div>
            </div>

            <table class="table table-fixed">
                <thead>
                    <tr>
                        <x-th sort-by="email">Email</x-th>
                        <x-th sort-by="open_count" class="w-32 th-numeric">Opens</x-th>
                        <x-th sort-by="-first_opened_at" sort-default class="w-48 th-numeric hidden | md:table-cell">First opened at</x-th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($campaignOpens as $campaignOpen)
                        <tr>
                            <td class="markup-links">
                                <a class="break-words" href="{{ route('mailcoach.emailLists.subscriber.details', [$campaign->emailList, $campaignOpen->subscriber_id]) }}">
                                    {{ $campaignOpen->subscriber_email }}
                                </a>
                            </td>
                            <td class="td-numeric">{{ $campaignOpen->open_count }}</td>
                            <td class="td-numeric hidden | md:table-cell">{{ $campaignOpen->first_opened_at->toMailcoachFormat() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <x-table-status
                name="open"
                :paginator="$campaignOpens"
                :total-count="$totalCampaignOpensCount"
                :show-all-url="route('mailcoach.campaigns.opens', $campaign)"
            ></x-table-status>
        @else
            <p class="alert alert-info">
                No opens yet. Stay tuned.
            </p>
        @endif
    @else
        <p class="alert alert-info">
            Open tracking was not enabled for this campaign.
        </p>
    @endif
@endsection
