<x-layouts.admin :title="'Dashboard'">

    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-slate-800">Selamat datang, {{ auth()->user()->name }} </h2>
        <p class="mt-1 text-sm text-slate-500">Ringkasan singkat data sistem Anda.</p>
    </div>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Total User</p>
                    <p class="mt-1 text-2xl font-semibold text-slate-800">{{ $stats['total_users'] }}</p>
                </div>
                
            </div>
        </div>

    </div>

</x-layouts.admin>
