<form class="form-grid" action="{{ route('mailcoach.templates.store') }}" method="POST">
    @csrf

    <x-text-field label="Name" name="name" required />

    <div class="form-buttons">
        <button class="button">
            <x-icon-label icon="fa-clipboard" text="Create template"/>
        </button>
        <button type="button" class="button-cancel" data-modal-dismiss>
            Cancel
        </button>
    </div>
</form>
