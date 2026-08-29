<x-layouts.admin :title="'Buat Tanggapan'">
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-slate-800">Buat Tanggapan</h2>
        <p class="mt-1 text-sm text-slate-500">Berikan tanggapan terhadap pengaduan.</p>
    </div>

    <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
        <form method="POST" action="{{ route('tanggapan.store') }}">
            @csrf
            @include('tanggapan._form')
            <div class="mt-6 flex items-center gap-3">
                <x-button type="submit">Simpan</x-button>
                <a href="{{ route('tanggapan.index') }}" class="text-sm text-slate-500 hover:text-slate-700">Batal</a>
            </div>
        </form>
    </div>
</x-layouts.admin>
