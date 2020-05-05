@props(['group'])

<div>
    <x-player :user="$group->owner" size="6" class="absolute top-0 right-0 -mt-1 -mr-1" withoutName />
    <div class="flex hand">
        @foreach($group->stock as $cardIndex => $stock)
        <x-card-sm :card="$stock->small_card" :key="$cardIndex" />
        @endforeach
    </div>
</div>