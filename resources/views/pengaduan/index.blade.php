<x-layouts.admin :title="'Pengaduan'">

    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-semibold text-slate-800">Data Pengaduan</h2>
            <p class="mt-1 text-sm text-slate-500">Kelola pengaduan yang masuk.</p>
        </div>
        <a href="{{ route('pengaduan.create') }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm hover:bg-indigo-500">
            + Buat Pengaduan
        </a>
    </div>

    <div class="rounded-xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-200 p-4">
            <form method="GET" class="flex gap-2">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul pengaduan..." class="w-full max-w-xs rounded-lg border-slate-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:w-72">
                <button class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-50">Cari</button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                    <tr>
                        <th class="px-4 py-3">Foto</th>
                        <th class="px-4 py-3">Judul</th>
                        <th class="px-4 py-3">Pelapor</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($pengaduan as $item)
                        <tr class="hover:bg-slate-50">
                            <td class="px-4 py-3">
                                @if ($item->foto)
                                    <img src="{{ asset('storage/'.$item->foto) }}" alt="" class="h-10 w-10 rounded-lg object-cover border border-slate-200">
                                @else
                                    <span class="text-xs text-slate-400">—</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 font-medium text-slate-700">{{ $item->judul }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $item->user->name ?? '-' }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $item->kategori }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $item->tanggal->format('d M Y') }}</td>
                            <td class="px-4 py-3">
                                <span class="inline-flex rounded-full px-2 py-0.5 text-xs font-medium {{ $item->status === 'selesai' ? 'bg-emerald-100 text-emerald-700' : ($item->status === 'proses' ? 'bg-blue-100 text-blue-700' : 'bg-slate-100 text-slate-600') }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('pengaduan.show', $item) }}" class="rounded-lg border border-slate-300 px-3 py-1.5 text-xs font-medium text-slate-600 hover:bg-slate-100">Lihat</a>
                                    <a href="{{ route('pengaduan.edit', $item) }}" class="rounded-lg border border-slate-300 px-3 py-1.5 text-xs font-medium text-slate-600 hover:bg-slate-100">Edit</a>
                                    <form method="POST" action="{{ route('pengaduan.destroy', $item) }}" onsubmit="return confirm('Hapus pengaduan ini?');">
                                        @csrf @method('DELETE')
                                        <button class="rounded-lg border border-rose-200 px-3 py-1.5 text-xs font-medium text-rose-600 hover:bg-rose-50">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-slate-400">Belum ada data pengaduan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($pengaduan->hasPages())
            <div class="border-t border-slate-200 px-4 py-3">{{ $pengaduan->links() }}</div>
        @endif
    </div>

</x-layouts.admin>
