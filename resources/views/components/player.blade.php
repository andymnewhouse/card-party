@props(['user', 'size', 'withoutName'])

@isset($withoutName)
<img {{ $attributes->merge(['class' => "inline-block h-{$size} w-{$size} rounded-full text-white shadow-solid bg-indigo-600"])}}
    src="{{ $user->gravatar }}" alt="{{ $user->name }}'s Gravatar" />
@else
<div {{ $attributes->merge(['class' => 'text-center']) }}>
    <img class="mx-auto w-{{ $size }} h-{{ $size }} rounded-full bg-indigo-600 border-2 border-white"
        src="{{ $user->gravatar }}" />
    {{ $user->name }}
</div>
@endif