<form class="form-grid" action="{{ route('mailcoach.emailLists.subscriber.store', $emailList) }}" method="POST">
    @csrf
    <x-text-field label="Email" name="email" type="email" required />
    <x-text-field label="First name" name="first_name" />
    <x-text-field label="Last name" name="last_name" />

    <div class="form-buttons">
        <button class="button">
            <x-icon-label icon="fa-user" text="Add subscriber" />
        </button>
        <button type="button" class="button-cancel" data-modal-dismiss>
            Cancel
        </button>
    </div>
</form>
