<x-layouts.admin :title="'Hak Akses'">

    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-slate-800">Kelola Hak Akses</h2>
        <p class="mt-1 text-sm text-slate-500">Atur hak akses setiap role terhadap fitur-fitur sistem.</p>
    </div>

    <div class="rounded-xl border border-slate-200 bg-white shadow-sm">
        <form method="POST" action="{{ route('permissions.update') }}">
            @csrf @method('PUT')

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                        <tr>
                            <th class="px-4 py-3">Role</th>
                            <th class="px-4 py-3">Fitur</th>
                            <th class="px-4 py-3 text-center">Lihat</th>
                            <th class="px-4 py-3 text-center">Tambah</th>
                            <th class="px-4 py-3 text-center">Edit</th>
                            <th class="px-4 py-3 text-center">Hapus</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($roles as $role)
                            @foreach ($features as $i => $feature)
                                @php
                                    $perm = ($permissions[$role] ?? collect())->firstWhere('feature', $feature);
                                @endphp
                                <tr class="hover:bg-slate-50">
                                    @if ($i === 0)
                                        <td class="px-4 py-3 font-semibold text-slate-700" rowspan="{{ count($features) }}">
                                            <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-medium {{ $role === 'admin' ? 'bg-indigo-100 text-indigo-700' : ($role === 'staff' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600') }}">
                                                {{ ucfirst($role) }}
                                            </span>
                                        </td>
                                    @endif
                                    <td class="px-4 py-3 text-slate-600">{{ ucfirst($feature) }}</td>
                                    @foreach (['can_view', 'can_create', 'can_edit', 'can_delete'] as $ability)
                                        <td class="px-4 py-3 text-center">
                                            <input
                                                type="checkbox"
                                                name="perm[{{ $role }}][{{ $feature }}][{{ $ability }}]"
                                                value="1"
                                                {{ ($perm && $perm->$ability) ? 'checked' : '' }}
                                                class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500"
                                            >
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="border-t border-slate-200 px-4 py-4">
                <x-button type="submit">Simpan Perubahan</x-button>
            </div>
        </form>
    </div>

</x-layouts.admin>
