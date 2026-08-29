@props(['messages'])

@if ($messages)
    <p {{ $attributes->merge(['class' => 'mt-1 text-sm text-rose-600']) }}>
        {{ (is_array($messages) ? $messages[0] : $messages) }}
    </p>
@endif
