<div class="fixed z-100 top-0 right-0 pt-6 pr-6 pointer-events-none">
    @foreach($notifications as $notification)
    <x-notification :notification="$notification" :key="$loop->index" />
    @endforeach
</div>