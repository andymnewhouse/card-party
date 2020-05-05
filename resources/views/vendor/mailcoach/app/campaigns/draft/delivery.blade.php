@extends('mailcoach::app.campaigns.draft.layouts.edit', [
    'campaign' => $campaign,
    'titlePrefix' => 'Delivery',
])

@section('breadcrumbs')
    <li>
        <a href="{{ route('mailcoach.campaigns.settings', $campaign) }}">
            <span class="breadcrumb">{{ $campaign->name }}</span>
        </a>
    </li>
    <li><span class="breadcrumb">Delivery</span></li>
@endsection

@section('campaign')
    <form
        action="{{ route('mailcoach.campaigns.sendTestEmail', $campaign) }}"
        method="POST"
        data-dirty-check
    >
        @csrf

        <div class="flex items-end">
            <div class="flex-grow max-w-xl">
                <x-text-field
                    label="Test your email first"
                    placeholder="Email(s) comma separated"
                    name="emails"
                    :required="true"
                    type="text"
                    :value="cache()->get('mailcoach-test-email-addresses')"
                />
            </div>

            <button type="submit" class="ml-2 button">
                <x-icon-label icon="fa-paper-plane" text="Send test"/>
            </button>
        </div>

        @error('emails')
        <p class="form-error">{{ $message }}</p>
        @enderror
    </form>

    <div class="mt-12">
        @if($campaign->isReady())
            <h1 class="markup-h1">
                @if($campaign->scheduled_at)
                    Scheduled for delivery at {{ $campaign->scheduled_at->toMailcoachFormat() }}
                @else
                    {{ Illuminate\Support\Arr::random([
                        'My time to shine!',
                        'No more time to waste…',
                        'Last part: deliver the thing!',
                        'Ready to handle the compliments?',
                        "Let's make some impact!",
                        "Allright, let's do this!",
                        'Everyone is sooo ready for this!',
                        'Inboxes will be surprised…',
                    ]) }}
                @endif
            </h1>
            @if (! $campaign->htmlContainsUnsubscribeUrlPlaceHolder())
                <p class="mt-4 alert alert-warning">
                    Campaign <strong>{{ $campaign->name }}</strong> can be sent, but you might want to check your content.
                </p>
            @else
                <p class="mt-4 alert alert-success">
                    Campaign <strong>{{ $campaign->name }}</strong> is ready to be sent.
                </p>
            @endif
        @else
            <h1 class="markup-h1">Almost there…</h1>
            <p class="mt-4 alert alert-error">You need to check some settings before you can deliver this
                campaign.</p>
        @endif

        <dl
            class="mt-8 dl"
        >
            @if ($campaign->emailList)
                <dt>
                    <i class="fas fa-check text-green-500 mr-2"></i>
                    From:
                </dt>

                <dd>
                    {{ $campaign->emailList->default_from_email }} {{ $campaign->emailList->default_from_name ? "({$campaign->emailList->default_from_name})" : '' }}
                </dd>
            @endif

            <dt>
                @if($campaign->segmentSubscriberCount())
                    <i class="fas fa-check text-green-500 mr-2"></i>
                @else
                    <i class="fas fa-times text-red-500 mr-2"></i>
                @endif
                To:
            </dt>

            @if($campaign->emailListSubscriberCount())
                <dd>
                    {{ $campaign->emailList->name }}
                    @if($campaign->usesSegment())
                        ({{ $campaign->getSegment()->description() }})
                    @endif
                    <span class="counter text-xs">
                        {{ $campaign->segmentSubscriberCount() }}
                        <span class="ml-1 font-normal">
                            {{ Illuminate\Support\Str::plural('subscriber', $campaign->segmentSubscriberCount()) }}
                        </span>
                    </span>
                </dd>
            @else
                <dd>
                    @if($campaign->emailList)
                        Selected list has no subscribers
                    @else
                        No list selected
                    @endif
                </dd>
            @endif

            <dt>
                @if($campaign->subject)
                    <i class="fas fa-check text-green-500 mr-2"></i>
                @else
                    <i class="fas fa-times text-red-500 mr-2"></i>
                @endif
                Subject:
            </dt>

            @if($campaign->subject)
                <dd>{{ $campaign->subject }}</dd>
            @else
                <dd>
                    Subject is empty
                </dd>
            @endif


            <dd class="col-start-2 pb-4 mb-2 border-b-2 border-gray-100">
                <a href="{{ route('mailcoach.campaigns.settings', $campaign) }}"
                   class="link-icon">
                    <x-icon-label icon="fa-pencil-alt" text="Edit"/>
                </a>
            </dd>

            <dt>
                @if($campaign->html && $campaign->hasValidHtml())
                    @if (! $campaign->htmlContainsUnsubscribeUrlPlaceHolder())
                        <i class="fas fa-exclamation-triangle text-orange-500 mr-2"></i>
                    @else
                        <i class="fas fa-check text-green-500 mr-2"></i>
                    @endif
                @else
                    <i class="fas fa-times text-red-500 mr-2"></i>
                @endif
                Content:
            </dt>


            @if($campaign->html && $campaign->hasValidHtml())
                <dd>
                    @if (! $campaign->htmlContainsUnsubscribeUrlPlaceHolder())
                        <p class="markup-code">
                            Without a way to unsubscribe, there's a high chance that your subscribers will complain.
                            Consider adding the <code>::unsubscribeUrl::</code> placeholder.
                        </p>
                    @else
                        <p class="markup-code">
                            Content seems fine.
                        </p>
                    @endif
                </dd>

            @else
                <dd>
                    @if(empty($campaign->html))
                        Content is missing
                    @else
                        HTML is invalid
                    @endif
                </dd>
            @endif

            <dd class="col-start-2 pb-4 mb-2 border-b-2 border-gray-100 buttons gap-4">
                <a href="{{ route('mailcoach.campaigns.content', $campaign) }}"
                   class="link-icon">
                    <x-icon-label icon="fa-pencil-alt" text="Edit"/>
                </a>

                @if($campaign->html && $campaign->hasValidHtml())
                    <button type="button" class="link-icon" data-modal-trigger="preview">
                        <x-icon-label icon="fa-eye" text="Preview"/>
                    </button>
                    <x-modal title="Preview" name="preview" large>
                        <iframe class="absolute" width="100%" height="100%"
                                src="data:text/html;base64,{{ base64_encode($campaign->html) }}"></iframe>
                    </x-modal>
                @endif
            </dd>

            @if ($campaign->isReady())
                <dt>
                    @if($campaign->scheduled_at)
                        <i class="fas fa-clock text-orange-500 mr-2"></i>
                    @else
                        <i class="fas fa-clock mr-2"></i>
                    @endif
                    Timing
                </dt>

                <dd>
                    @if($campaign->scheduled_at)
                        <form method="POST" action="{{ route('mailcoach.campaigns.unschedule', $campaign) }}">
                            @csrf
                            <p class="mb-3">
                                This campaign is scheduled to be sent at
                                <strong>{{ $campaign->scheduled_at->toMailcoachFormat() }}</strong>.
                            </p>
                            <button type="submit" class="link-icon">
                                <x-icon-label icon="fa-ban" text="Unschedule"/>
                            </button>
                        </form>
                    @else
                        <div class="">
                            <div class="radio-group">
                                <x-radio-field
                                    name="schedule"
                                    option-value="now"
                                    :value="$campaign->scheduled_at ? 'future' : 'now'"
                                    label="Send immediately"
                                    dataConditional="schedule"
                                />
                                <x-radio-field
                                    name="schedule"
                                    option-value="future"
                                    :value="($campaign->scheduled_at || $errors->first('scheduled_at')) ? 'future' : 'now'"
                                    label="Schedule for delivery in the future"
                                    dataConditional="schedule"
                                />
                            </div>

                            <form
                                method="POST"
                                action="{{ route('mailcoach.campaigns.schedule', $campaign) }}"
                                data-conditional-schedule="future"
                            >
                                @csrf
                                <div class="mt-6 flex items-end">
                                    <x-date-time-field :name="'scheduled_at'" :value="$campaign->scheduled_at" required />

                                    <button type="submit" class="ml-6 button bg-orange-500 hover:bg-orange-600 focus:bg-orange-600">
                                        <x-icon-label icon="fa-clock" text="Schedule delivery"/>
                                    </button>
                                </div>
                                <p class="mt-2 text-xs text-gray-300">
                                    All times in {{ config('app.timezone') }}.
                                </p>
                            </form>
                        </div>
                    @endif

                    <div
                        class="mt-6 buttons | {{ ($campaign->scheduled_at || $errors->first('scheduled_at')) ? 'hidden' : '' }}"
                        data-conditional-schedule="now"
                    >
                        <button class="button" data-modal-trigger="send-campaign">
                            <x-icon-label icon="fa-paper-plane" text="Send now"/>
                        </button>
                    </div>
                    <x-modal name="send-campaign">
                        <div class="flex place-center">
                            <div class="horses-wrap">
                                <div class="horses">
                                    <div class="horses-back"><img src="{{ asset('vendor/mailcoach/images/horses-back.png') }}"></div>
                                    <div class="horse-01"><img src="{{ asset('vendor/mailcoach/images/horse-01.png') }}"></div>
                                    <div class="horse-02"><img src="{{ asset('vendor/mailcoach/images/horse-02.png') }}"></div>
                                </div>
                                <div class="horse-button">
                                    <x-form-button
                                        :action="route('mailcoach.campaigns.send', $campaign)"
                                        class="button bg-red-500 shadow-2xl text-lg h-12"
                                    >
                                        <x-icon-label icon="fa-paper-plane"
                                                      :text="'Send ' .  number_format($campaign->segmentSubscriberCount()) . ' ' . Illuminate\Support\Str::plural('email', $campaign->segmentSubscriberCount())"/>
                                    </x-form-button>
                                </div>
                            </div>
                        </div>
                    </x-modal>
                </dd>
            @endif
        </dl>
    </div>

@endsection
