@extends('mailcoach::app.campaigns.sent.layouts.show', [
    'campaign' => $campaign,
    'titlePrefix' => 'Outbox',
])

@section('breadcrumbs')
    <li>
        <a href="{{ route('mailcoach.campaigns.summary', $campaign) }}">
            <span class="breadcrumb">{{ $campaign->name }}</span>
        </a>
    </li>
    <li><span class="breadcrumb">Outbox</span></li>
@endsection

@section('campaign')
    @if ($totalFailed > 0)
        <div class="table-actions">
            <x-form-button
            :action="route('mailcoach.campaigns.retry-failed-sends', [$campaign])"
            method="POST"
            data-confirm="true"
            :data-confirm-text="'Are you sure you want to resend ' . $totalFailed . ' mails?'"
            class="mt-4 button"
            >
                <x-icon-label icon="fa-exclamation-triangle" :text="'Try resending ' . $totalFailed . ' failed ' . \Illuminate\Support\Str::plural('email', $totalFailed)" />
            </x-form-button>
    </div>
    @endif

    <div class="table-actions">
        <div class="table-filters">
            <x-filters>
                <x-filter :queryString="$queryString" attribute="type" active-on="">
                    All <span class="counter">{{ Illuminate\Support\Str::shortNumber($totalSends) }}</span>
                </x-filter>
                <x-filter :queryString="$queryString" attribute="type" active-on="pending">
                    Pending <span class="counter">{{ Illuminate\Support\Str::shortNumber($totalPending) }}</span>
                </x-filter>
                <x-filter :queryString="$queryString" attribute="type" active-on="failed">
                    Failed <span class="counter">{{ Illuminate\Support\Str::shortNumber($totalFailed) }}</span>
                </x-filter>
                <x-filter :queryString="$queryString" attribute="type" active-on="sent">
                    Sent <span class="counter">{{ Illuminate\Support\Str::shortNumber($totalSent) }}</span>
                </x-filter>
                <x-filter :queryString="$queryString" attribute="type" active-on="bounced">
                    Bounced <span class="counter">{{ Illuminate\Support\Str::shortNumber($totalBounces) }}</span>
                </x-filter>
                <x-filter :queryString="$queryString" attribute="type" active-on="complained">
                    Complaints <span class="counter">{{ Illuminate\Support\Str::shortNumber($totalComplaints) }}</span>
                </x-filter>
            </x-filters>

            <x-search placeholder="Filter mails…"/>
        </div>
    </div>

    <table class="table table-fixed">
        <thead>
        <tr>
            <x-th sort-by="subscriber_email">Email address</x-th>
            <x-th sort-by="subscriber_email">Problem</x-th>
            <x-th class="w-48 th-numeric hidden | md:table-cell" sort-by="-sent_at" sort-default>Sent at</x-th>
        </tr>
        </thead>
        <tbody>
        @foreach($sends as $send)
            <tr class="markup-links">
                <td><a class="break-words" href="{{ route('mailcoach.emailLists.subscriber.details', [$send->subscriber->emailList, $send->subscriber]) }}">{{ $send->subscriber->email }}</a></td>
                <td>{{ $send->failure_reason }}{{optional($send->latestFeedback())->formatted_type }}</td>
                <td class="td-numeric hidden | md:table-cell">{{ optional($send->sent_at)->toMailcoachFormat() ?? '-' }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <x-table-status name="send" :paginator="$sends" :total-count="$totalSends"
                    :show-all-url="route('mailcoach.campaigns.outbox', $campaign)"></x-table-status>
@endsection
