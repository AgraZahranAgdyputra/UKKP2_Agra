<x-layouts.admin :title="'Kategori'">

    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-semibold text-slate-800">Data Kategori</h2>
            <p class="mt-1 text-sm text-slate-500">Kelola kategori pengaduan.</p>
        </div>
        @if(\App\Models\RolePermission::allowed(auth()->user()->role, 'kategori', 'can_create'))
        <a href="{{ route('kategori.create') }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm hover:bg-indigo-500">
            + Tambah Kategori
        </a>
        @endif
    </div>

    <div class="rounded-xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-200 p-4">
            <form method="GET" class="flex gap-2">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari kategori..." class="w-full max-w-xs rounded-lg border-slate-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:w-72">
                <button class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-50">Cari</button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                    <tr>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Deskripsi</th>
                        <th class="px-4 py-3">Dibuat</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($kategori as $item)
                        <tr class="hover:bg-slate-50">
                            <td class="px-4 py-3 font-medium text-slate-700">{{ $item->nama }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $item->deskripsi ?? '—' }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $item->created_at->format('d M Y') }}</td>
                            <td class="px-4 py-3">
                                <div class="flex justify-end gap-2">
                                    @if(\App\Models\RolePermission::allowed(auth()->user()->role, 'kategori', 'can_edit'))
                                    <a href="{{ route('kategori.edit', $item) }}" class="rounded-lg border border-slate-300 px-3 py-1.5 text-xs font-medium text-slate-600 hover:bg-slate-100">Edit</a>
                                    @endif
                                    @if(\App\Models\RolePermission::allowed(auth()->user()->role, 'kategori', 'can_delete'))
                                    <form method="POST" action="{{ route('kategori.destroy', $item) }}" onsubmit="return confirm('Hapus kategori ini?');">
                                        @csrf @method('DELETE')
                                        <button class="rounded-lg border border-rose-200 px-3 py-1.5 text-xs font-medium text-rose-600 hover:bg-rose-50">Hapus</button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-8 text-center text-slate-400">Belum ada data kategori.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($kategori->hasPages())
            <div class="border-t border-slate-200 px-4 py-3">{{ $kategori->links() }}</div>
        @endif
    </div>

</x-layouts.admin>
