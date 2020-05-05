<form class="form-grid" action="{{ route('mailcoach.emailLists.store') }}" method="POST">
    @csrf

    <x-text-field label="Name" name="name" required />
    <x-text-field label="From email" name="default_from_email" type="email" required />
    <x-text-field label="From name" name="default_from_name" />

    <div class="form-buttons">
        <button class="button">
            <x-icon-label icon="fa-address-book" text="Create list" />
        </button>
        <button type="button" class="button-cancel" data-modal-dismiss>
            Cancel
        </button>
    </div>
</form>
