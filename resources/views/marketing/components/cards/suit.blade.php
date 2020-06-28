@props(['suit'])

@switch($suit)
@case($suit === 'heart')
<x-cards.heart :attributes="$attributes" />
@break
@case($suit === 'diamond')
<x-cards.diamond :attributes="$attributes" />
@break
@case($suit === 'spade')
<x-cards.spade :attributes="$attributes" />
@break
@case($suit === 'club')
<x-cards.club :attributes="$attributes" />
@break
@endswitch