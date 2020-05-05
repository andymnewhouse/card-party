<tr class="tr-h-double" @if($campaign->isSending()) id="campaign-row-{{ $campaign->id }}" data-poll @endif>
    <td>
        @include('mailcoach::app.campaigns.partials.campaignStatusIcon', ['status' => $campaign->status])
    </td>
    <td class="markup-links">
        @if($campaign->isSent() || $campaign->isSending())
            <a href="{{ route('mailcoach.campaigns.summary', $campaign) }}">
                {{ $campaign->name }}
            </a>
        @elseif($campaign->isScheduled())
            <a href="{{ route('mailcoach.campaigns.delivery', $campaign) }}">
                {{ $campaign->name }}
            </a>
        @else
            <a href="{{ route('mailcoach.campaigns.settings', $campaign) }}">
                {{ $campaign->name }}
            </a>
        @endif
    </td>
    <td class="td-numeric">
        {{ $campaign->sent_to_number_of_subscribers ?: '-' }}
    </td>
    <td class="td-numeric hidden | md:table-cell">
        @if($campaign->open_rate)
            {{ $campaign->unique_open_count }}
            <div class="td-secondary-line">{{ $campaign->open_rate }}%</div>
        @else
            -
        @endif
    </td>
    <td class="td-numeric hidden | md:table-cell">
        @if($campaign->click_rate)
            {{ $campaign->unique_click_count }}
            <div class="td-secondary-line">{{ $campaign->click_rate }}%</div>
        @else
            -
        @endif
    <td class="td-numeric hidden | md:table-cell">
        @if($campaign->isSent())
            {{ optional($campaign->sent_at)->toMailcoachFormat() }}
        @elseif($campaign->isSending())
            {{ optional($campaign->updated_at)->toMailcoachFormat() }}
            <div class="td-secondary-line">
                In progress
            </div>
        @elseif($campaign->isScheduled())
            {{ optional($campaign->scheduled_at)->toMailcoachFormat() }}
            <div class="td-secondary-line">
                Scheduled
            </div>
        @else
        -
        @endif
    </td>

    <td class="td-action">
        <div class="dropdown" data-dropdown>
            <button class="icon-button" data-dropdown-trigger>
                <i class="fas fa-ellipsis-v | dropdown-trigger-rotate"></i>
            </button>
            <ul class="dropdown-list dropdown-list-left | hidden" data-dropdown-list>
                <li>
                    <x-form-button
                        :action="route('mailcoach.campaigns.duplicate', $campaign)"
                    >
                        <x-icon-label icon="fa-random" text="Duplicate" />
                    </x-form-button>
                </li>
                <li>
                    <x-form-button
                        :action="route('mailcoach.campaigns.delete', $campaign)"
                        method="DELETE"
                        data-confirm="true"
                        :data-confirm-text="'Are you sure you want to delete campaign ' . $campaign->name . '?'"
                    >
                        <x-icon-label icon="fa-trash-alt" text="Delete" :caution="true" />
                    </x-form-button>
                </li>
            </ul>
        </div>
    </td>
</tr>
