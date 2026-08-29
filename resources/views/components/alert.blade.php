@props(['type' => 'success', 'message' => null])

@if ($message)
    <div
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 4000)"
        class="mb-4 flex items-center justify-between rounded-lg border px-4 py-3 text-sm
            {{ $type === 'success'
                ? 'border-emerald-200 bg-emerald-50 text-emerald-700'
                : 'border-rose-200 bg-rose-50 text-rose-700' }}"
    >
        <span>{{ $message }}</span>
        <button @click="show = false" class="ml-4 text-current opacity-60 hover:opacity-100">&times;</button>
    </div>
@endif
