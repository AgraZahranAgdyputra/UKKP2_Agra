<x-layouts.admin :title="'Detail Pengaduan'">

    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-semibold text-slate-800">Detail Pengaduan</h2>
            <p class="mt-1 text-sm text-slate-500">Informasi lengkap pengaduan.</p>
        </div>
        <a href="{{ route('pengaduan.index') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-50">← Kembali</a>
    </div>

    <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
        <dl class="grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-2">
            <div>
                <dt class="text-xs font-medium uppercase tracking-wide text-slate-500">Judul</dt>
                <dd class="mt-1 text-sm text-slate-800">{{ $pengaduan->judul }}</dd>
            </div>
            <div>
                <dt class="text-xs font-medium uppercase tracking-wide text-slate-500">Pelapor</dt>
                <dd class="mt-1 text-sm text-slate-800">{{ $pengaduan->user->name ?? '-' }}</dd>
            </div>
            <div>
                <dt class="text-xs font-medium uppercase tracking-wide text-slate-500">Kategori</dt>
                <dd class="mt-1 text-sm text-slate-800">{{ $pengaduan->kategori }}</dd>
            </div>
            <div>
                <dt class="text-xs font-medium uppercase tracking-wide text-slate-500">Tanggal</dt>
                <dd class="mt-1 text-sm text-slate-800">{{ $pengaduan->tanggal->format('d M Y') }}</dd>
            </div>
            <div>
                <dt class="text-xs font-medium uppercase tracking-wide text-slate-500">Status</dt>
                <dd class="mt-1">
                    <span class="inline-flex rounded-full px-2 py-0.5 text-xs font-medium {{ $pengaduan->status === 'selesai' ? 'bg-emerald-100 text-emerald-700' : ($pengaduan->status === 'proses' ? 'bg-blue-100 text-blue-700' : 'bg-slate-100 text-slate-600') }}">
                        {{ ucfirst($pengaduan->status) }}
                    </span>
                </dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-xs font-medium uppercase tracking-wide text-slate-500">Deskripsi</dt>
                <dd class="mt-1 whitespace-pre-line text-sm text-slate-800">{{ $pengaduan->deskripsi }}</dd>
            </div>
            @if ($pengaduan->foto)
                <div class="sm:col-span-2">
                    <dt class="text-xs font-medium uppercase tracking-wide text-slate-500">Foto</dt>
                    <dd class="mt-2">
                        <img src="{{ asset('storage/'.$pengaduan->foto) }}" alt="Foto pengaduan" class="max-h-80 w-auto rounded-lg border border-slate-200">
                    </dd>
                </div>
            @endif
        </dl>
    </div>

</x-layouts.admin>
