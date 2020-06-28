@props(['user', 'size', 'withoutName'])

@isset($withoutName)
<img {{ $attributes->merge(['class' => "inline-block h-{$size} w-{$size} rounded-full text-white shadow-solid bg-blue-gray-600"])}}
    src="{{ $user->gravatar }}" alt="{{ $user->name }}'s Gravatar" />
@elseif(isset($user->cardsInHand))
<div {{ $attributes->merge(['class' => 'flex items-center justify-center']) }}>
    <img class="w-{{ $size }} h-{{ $size }} rounded-full bg-blue-gray-600 border-2 border-white"
        src="{{ $user->gravatar }}" />
    <div class="ml-4">
        <p class="acumin">{{ $user->firstName }}</p>
        <p class="acumin text-gray-700 text-sm">({{ $user->cardsInHand }} cards)</p>
    </div>
</div>
@else
<div {{ $attributes->merge(['class' => 'text-center']) }}>
    <img class="mx-auto w-{{ $size }} h-{{ $size }} rounded-full bg-blue-gray-600 border-2 border-white"
        src="{{ $user->gravatar }}" />
    {{ $user->firstName }}
</div>
@endif