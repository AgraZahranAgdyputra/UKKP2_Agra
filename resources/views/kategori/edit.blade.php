<x-layouts.admin :title="'Edit Kategori'">
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-slate-800">Edit Kategori</h2>
        <p class="mt-1 text-sm text-slate-500">Perbarui data kategori.</p>
    </div>

    <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
        <form method="POST" action="{{ route('kategori.update', $kategori) }}">
            @csrf @method('PUT')
            @include('kategori._form', ['kategori' => $kategori])
            <div class="mt-6 flex items-center gap-3">
                <x-button type="submit">Perbarui</x-button>
                <a href="{{ route('kategori.index') }}" class="text-sm text-slate-500 hover:text-slate-700">Batal</a>
            </div>
        </form>
    </div>
</x-layouts.admin>
