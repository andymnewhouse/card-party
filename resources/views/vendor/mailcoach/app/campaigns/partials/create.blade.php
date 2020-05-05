<form class="form-grid" action="{{ route('mailcoach.campaigns.store') }}" method="POST">
    @csrf

    <x-text-field label="Name" name="name" required />

    @if($templateOptions->count() > 1)
        <x-select-field label="Template" :options="$templateOptions" name="template_id" />
    @endif

    <div class="form-buttons">
        <button class="button">
            <x-icon-label icon="fa-envelope-open" text="Create campaign" />
        </button>
        <button type="button" class="button-cancel" data-modal-dismiss>
            Cancel
        </button>
    </div>
</form>
