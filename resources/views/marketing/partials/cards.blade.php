@foreach($cards as $card)
<x-card :card="$card" :key="$loop->index" class="card" />
@endforeach