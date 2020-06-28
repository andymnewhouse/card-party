@props(['value'])

@switch($value)
@case($value === 'two')
<x-cards.two :attributes="$attributes" />
@break
@case($value === 'three')
<x-cards.three :attributes="$attributes" />
@break
@case($value === 'four')
<x-cards.four :attributes="$attributes" />
@break
@case($value === 'five')
<x-cards.five :attributes="$attributes" />
@break
@case($value === 'five')
<x-cards.five :attributes="$attributes" />
@break
@case($value === 'six')
<x-cards.six :attributes="$attributes" />
@break
@case($value === 'seven')
<x-cards.seven :attributes="$attributes" />
@break
@case($value === 'eight')
<x-cards.eight :attributes="$attributes" />
@break
@case($value === 'nine')
<x-cards.nine :attributes="$attributes" />
@break
@case($value === 'ten')
<x-cards.ten :attributes="$attributes" />
@break
@case($value === 'jack')
<x-cards.jack :attributes="$attributes" />
@break
@case($value === 'queen')
<x-cards.queen :attributes="$attributes" />
@break
@case($value === 'king')
<x-cards.king :attributes="$attributes" />
@break
@case($value === 'ace')
<x-cards.ace :attributes="$attributes" />
@break
@case($value === 'joker')
<x-cards.joker :attributes="$attributes" />
@break
@endswitch