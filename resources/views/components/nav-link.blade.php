@props(['href', 'active' => false])

<a
    href="{{ $href }}"
    {{ $attributes->merge([
        'class' => 'flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition ' .
            ($active
                ? 'bg-indigo-500/10 text-white bg-indigo-600'
                : 'text-slate-300 hover:bg-slate-800 hover:text-white')
    ]) }}
>
    @isset($icon)
        {{ $icon }}
    @endisset
    <span>{{ $slot }}</span>
</a>
