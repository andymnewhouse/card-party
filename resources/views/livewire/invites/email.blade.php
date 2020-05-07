<form wire:submit.prevent="send" class="mt-4 flex">
    <label for="email" class="sr-only">Email</label>
    <div class="flex rounded-md shadow-sm w-96">
        <input id="email" wire:model="email"
            class="form-input flex-1 block w-full px-3 py-2 rounded-none rounded-l-md sm:text-sm sm:leading-5" />
        <span class="inline-flex rounded-md shadow-sm">
            <button type="submit" class="btn btn-xs rounded-l-none btn-red-primary">
                Send Email
            </button>
        </span>
    </div>
</form>