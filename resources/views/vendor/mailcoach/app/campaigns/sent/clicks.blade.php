@extends('mailcoach::app.campaigns.sent.layouts.show', [
    'campaign' => $campaign,
    'titlePrefix' => 'Clicks',
])

@section('breadcrumbs')
    <li>
        <a href="{{ route('mailcoach.campaigns.summary', $campaign) }}">
            <span class="breadcrumb">{{ $campaign->name }}</span>
        </a>
    </li>
    <li><span class="breadcrumb">Clicks</span></li>
@endsection

@section('campaign')
    @if($campaign->track_clicks)
        @if($campaign->click_count)
            <div class="table-actions">
                <div class="table-filters">
                    <x-search placeholder="Filter clicks…" />
                </div>
            </div>

            <table class="table table-fixed">
                <thead>
                    <tr>
                        <x-th sort-by="link">Link</x-th>
                        <x-th sort-by="-unique_click_count" class="w-32 th-numeric hidden | md:table-cell">Unique clicks</x-th>
                        <x-th sort-by="-click_count" class="w-32 th-numeric">Clicks</x-th>
                    <tr>
                </thead>
                <tbody>
                    @foreach($links as $link)
                    <tr>
                        <td class="markup-links"><a class="break-words" href="{{ $link->url }}">{{ $link->url }}</a></td>
                        <td class="td-numeric hidden | md:table-cell">{{ $link->unique_click_count }}</td>
                        <td class="td-numeric">{{ $link->click_count }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <x-table-status
                name="link"
                :paginator="$links"
                :total-count="$totalLinksCount"
                :show-all-url="route('mailcoach.campaigns.clicks', $campaign)"
            ></x-table-status>
        @else
            <p class="alert alert-info">
                No clicks yet. Stay tuned.
            </p>
        @endif
    @else
        <p class="alert alert-info">
            Click tracking was not enabled for this campaign.
        </p>
    @endif
@endsection
