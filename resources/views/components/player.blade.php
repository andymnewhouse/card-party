@props(['user', 'size'])

<div {{ $attributes->merge(['class' => 'text-center']) }}>
    <img class="mx-auto w-{{ $size }} h-{{ $size }} rounded-full bg-indigo-600 border-2 border-white"
        src="{{ $user->gravatar }}" />
    {{ $user->name }}
</div>