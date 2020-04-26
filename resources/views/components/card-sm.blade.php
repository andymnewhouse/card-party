@props(['card'])

<div {{ $attributes->merge(['class' => 'sm-card']) }}>
    @if($card['value'] === 'joker' && $card['suit'] === 'heart')
    <x-cards.value :value="$card['value']" class="w-4 h-4 text-red-600 mb-1" />
    @elseif($card['value'] === 'joker' && $card['suit'] === 'spade')
    <x-cards.value :value="$card['value']" class="w-4 h-4 text-gray-800 mb-1" />
    @elseif($card['suit'] === 'diamond' || $card['suit'] === 'heart')
    <x-cards.value :value="$card['value']" class="w-4 h-4 text-red-600 mb-1" />
    <x-cards.suit :suit="$card['suit']" class="w-4 h-4 text-red-600" />
    @else
    <x-cards.value :value="$card['value']" class="w-4 h-4 text-gray-800 mb-1" />
    <x-cards.suit :suit="$card['suit']" class="w-4 h-4 text-gray-800" />
    @endif
</div>