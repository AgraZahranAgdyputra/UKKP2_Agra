<x-layouts.admin :title="'Edit User'">

    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-slate-800">Edit User</h2>
        <p class="mt-1 text-sm text-slate-500">Perbarui data User <strong>{{ $user->name }}</strong>.</p>
    </div>

    <div class="max-w-2xl rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
        <form method="POST" action="{{ route('users.update', $user) }}" class="space-y-6">
            @csrf
            @method('PUT')

            @include('users._form')

            <div class="flex justify-end gap-3 border-t border-slate-100 pt-5">
                <a
                    href="{{ route('users.index') }}"
                    class="rounded-lg border border-slate-300 px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-50"
                >
                    Batal
                </a>
                <x-button type="submit">Perbarui User</x-button>
            </div>
        </form>
    </div>

</x-layouts.admin>
