<div>
    <x-player :user="$owner" size="6" class="absolute top-0 right-0 -mt-1 -mr-1" withoutName />
    <div class="flex hand">
        @foreach($cards as $cardIndex => $card)
        <x-card-sm :card="$card->small_card" :key="$cardIndex" />
        @endforeach
    </div>
</div>