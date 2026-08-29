@php $pengaduan = $pengaduan ?? null; @endphp

<div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
    <div>
        <x-input-label for="judul" value="Judul" />
        <x-text-input id="judul" name="judul" value="{{ old('judul', $pengaduan->judul ?? '') }}" required autofocus placeholder="Judul pengaduan" />
        <x-input-error :messages="$errors->get('judul')" />
    </div>

    <div>
        <x-input-label for="kategori" value="Kategori" />
        <x-text-input id="kategori" name="kategori" value="{{ old('kategori', $pengaduan->kategori ?? '') }}" required placeholder="Contoh: Fasilitas, Layanan, dll" />
        <x-input-error :messages="$errors->get('kategori')" />
    </div>

    <div>
        <x-input-label for="tanggal" value="Tanggal" />
        <x-text-input id="tanggal" name="tanggal" type="date" value="{{ old('tanggal', $pengaduan ? $pengaduan->tanggal->format('Y-m-d') : now()->format('Y-m-d')) }}" required />
        <x-input-error :messages="$errors->get('tanggal')" />
    </div>

    @if ($pengaduan)
        <div>
            <x-input-label for="status" value="Status" />
            <select id="status" name="status" required class="mt-1 block w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @foreach (['pending', 'proses', 'selesai'] as $s)
                    <option value="{{ $s }}" {{ old('status', $pengaduan->status) === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('status')" />
        </div>
    @endif

    <div class="sm:col-span-2">
        <x-input-label for="foto" value="Foto" />
        <input id="foto" name="foto" type="file" accept="image/*" class="mt-1 block w-full text-sm text-slate-500 file:mr-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:px-4 file:py-2 file:text-sm file:font-medium file:text-indigo-700 hover:file:bg-indigo-100" />
        <x-input-error :messages="$errors->get('foto')" />
        @if ($pengaduan && $pengaduan->foto)
            <div class="mt-2">
                <p class="text-xs text-slate-500 mb-1">Foto saat ini:</p>
                <img src="{{ asset('storage/'.$pengaduan->foto) }}" alt="Foto pengaduan" class="h-24 w-auto rounded-lg border border-slate-200">
            </div>
        @endif
    </div>

    <div class="sm:col-span-2">
        <x-input-label for="deskripsi" value="Deskripsi" />
        <textarea id="deskripsi" name="deskripsi" rows="4" required placeholder="Jelaskan detail pengaduan..." class="mt-1 block w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('deskripsi', $pengaduan->deskripsi ?? '') }}</textarea>
        <x-input-error :messages="$errors->get('deskripsi')" />
    </div>
</div>
