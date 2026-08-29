<x-layouts.admin :title="'Edit Pengaduan'">

    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-slate-800">Edit Pengaduan</h2>
        <p class="mt-1 text-sm text-slate-500">Perbarui data pengaduan.</p>
    </div>

    <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
        <form method="POST" action="{{ route('pengaduan.update', $pengaduan) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            @include('pengaduan._form', ['pengaduan' => $pengaduan])

            <div class="mt-6 flex items-center gap-3">
                <x-button type="submit">Perbarui</x-button>
                <a href="{{ route('pengaduan.index') }}" class="text-sm text-slate-500 hover:text-slate-700">Batal</a>
            </div>
        </form>
    </div>

</x-layouts.admin>
