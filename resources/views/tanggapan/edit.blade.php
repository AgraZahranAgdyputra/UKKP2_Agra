<x-layouts.admin :title="'Edit Tanggapan'">
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-slate-800">Edit Tanggapan</h2>
        <p class="mt-1 text-sm text-slate-500">Perbarui data tanggapan.</p>
    </div>

    <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
        <form method="POST" action="{{ route('tanggapan.update', $tanggapan) }}">
            @csrf @method('PUT')
            @include('tanggapan._form', ['tanggapan' => $tanggapan, 'selectedPengaduan' => null])
            <div class="mt-6 flex items-center gap-3">
                <x-button type="submit">Perbarui</x-button>
                <a href="{{ route('tanggapan.index') }}" class="text-sm text-slate-500 hover:text-slate-700">Batal</a>
            </div>
        </form>
    </div>
</x-layouts.admin>
