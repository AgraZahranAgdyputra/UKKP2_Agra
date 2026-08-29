@props(['type' => 'button'])

<button
    type="{{ $type }}"
    {{ $attributes->merge([
        'class' => 'inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2.5
            text-sm font-medium text-white shadow-sm transition hover:bg-indigo-500
            focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2'
    ]) }}
>
    {{ $slot }}
</button>
