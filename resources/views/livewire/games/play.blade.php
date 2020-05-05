<div class="game-container h-screen">
    <div class="instructions-area">
        @include('livewire.games.partials.instructionsArea')
    </div>
    <div class="table-area relative bg-green-300 shadow-inner">
        <div class="max-w-7xl mx-auto h-full sm:px-6 lg:px-8">
            @include('livewire.games.partials.table')
            @include('livewire.games.partials.deckArea')
        </div>
        @if($editMode && !$iHavePlayed)
        @include('livewire.games.partials.editModal')
        @endif

        @if($pauseGame)
        @include('livewire.games.partials.pauseModal')
        @endif
    </div>
    <div class="hand-area shadow-lg bg-white relative">
        @include('livewire.games.partials.handArea')
    </div>
</div>