<x-layouts.admin :title="'Tanggapan'">

    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-semibold text-slate-800">Data Tanggapan</h2>
            <p class="mt-1 text-sm text-slate-500">Kelola tanggapan terhadap pengaduan.</p>
        </div>
        @if(\App\Models\RolePermission::allowed(auth()->user()->role, 'tanggapan', 'can_create'))
        <a href="{{ route('tanggapan.create') }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm hover:bg-indigo-500">
            + Buat Tanggapan
        </a>
        @endif
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
                        <th class="px-4 py-3">Pengaduan</th>
                        <th class="px-4 py-3">Penanggap</th>
                        <th class="px-4 py-3">Isi Tanggapan</th>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($tanggapan as $item)
                        <tr class="hover:bg-slate-50">
                            <td class="px-4 py-3 font-medium text-slate-700">{{ $item->pengaduan->judul ?? '-' }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $item->user->name ?? '-' }}</td>
                            <td class="px-4 py-3 text-slate-600 max-w-xs truncate">{{ Str::limit($item->isi, 60) }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $item->created_at->format('d M Y H:i') }}</td>
                            <td class="px-4 py-3">
                                <div class="flex justify-end gap-2">
                                    @if(\App\Models\RolePermission::allowed(auth()->user()->role, 'tanggapan', 'can_edit'))
                                    <a href="{{ route('tanggapan.edit', $item) }}" class="rounded-lg border border-slate-300 px-3 py-1.5 text-xs font-medium text-slate-600 hover:bg-slate-100">Edit</a>
                                    @endif
                                    @if(\App\Models\RolePermission::allowed(auth()->user()->role, 'tanggapan', 'can_delete'))
                                    <form method="POST" action="{{ route('tanggapan.destroy', $item) }}" onsubmit="return confirm('Hapus tanggapan ini?');">
                                        @csrf @method('DELETE')
                                        <button class="rounded-lg border border-rose-200 px-3 py-1.5 text-xs font-medium text-rose-600 hover:bg-rose-50">Hapus</button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-slate-400">Belum ada data tanggapan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($tanggapan->hasPages())
            <div class="border-t border-slate-200 px-4 py-3">{{ $tanggapan->links() }}</div>
        @endif
    </div>

</x-layouts.admin>
