<div class="game-container h-screen">
    <div class="instructions-area">
        @include('livewire.games.partials.instructionsArea')
    </div>
    <div class="table-area relative bg-green-300 shadow-inner">
        <div class="max-w-7xl mx-auto h-full sm:px-6 lg:px-8">
            @include('livewire.games.partials.table')
            @include('livewire.games.partials.deckArea')
        </div>
        @if($editMode)
        @include('livewire.games.partials.editModal')
        @endif
    </div>
    <div class="hand-area shadow-lg bg-white">
        @include('livewire.games.partials.handArea')
    </div>
</div>