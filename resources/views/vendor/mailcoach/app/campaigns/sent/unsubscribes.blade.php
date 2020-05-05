@extends('mailcoach::app.campaigns.sent.layouts.show', [
    'campaign' => $campaign,
    'titlePrefix' => 'Unsubscribes',
])

@section('breadcrumbs')
    <li>
        <a href="{{ route('mailcoach.campaigns.summary', $campaign) }}">
            <span class="breadcrumb">{{ $campaign->name }}</span>
        </a>
    </li>
    <li><span class="breadcrumb">Unsubscribes</span></li>
@endsection

@section('campaign')
    @if($unsubscribes->count())
    <div class="table-actions">
        <div class="table-filters">
            <x-search placeholder="Filter unsubscribes" />
        </div>
    </div>

    <table class="table table-fixed">
        <thead>
        <tr>
            <th>Email</th>
            <th class="w-48 th-numeric hidden | md:table-cell">Date</th>
        </tr>
        </thead>
        <tbody>
        @foreach($unsubscribes as $unsubscribe)
            <tr>
                <td class="markup-links">
                    <a class="break-words" href="{{ route('mailcoach.emailLists.subscriber.details', [$unsubscribe->subscriber->emailList, $unsubscribe->subscriber]) }}">
                        {{ $unsubscribe->subscriber->email }}
                    </a>
                    <div class="td-secondary-line">
                        {{ $unsubscribe->subscriber->first_name }} {{ $unsubscribe->subscriber->last_name }}
                    </div>
                </td>
                <td class="td-numeric hidden | md:table-cell">{{ $unsubscribe->created_at->toMailcoachFormat() }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <x-table-status
        name="unsubscribe"
        :paginator="$unsubscribes"
        :total-count="$totalUnsubscribes"
        :show-all-url="route('mailcoach.campaigns.unsubscribes', $campaign)"
    ></x-table-status>

    @else
        <p class="alert alert-success">
            <i class="fas fa-sun text-orange-500 mr-2"></i>
            No unsubscribes have been received yet.
        </p>
    @endif
@endsection
