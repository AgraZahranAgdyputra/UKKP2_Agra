@php $kategori = $kategori ?? null; @endphp

<div class="grid grid-cols-1 gap-5">
    <div>
        <x-input-label for="nama" value="Nama Kategori" />
        <x-text-input id="nama" name="nama" value="{{ old('nama', $kategori->nama ?? '') }}" required autofocus placeholder="Contoh: Fasilitas" />
        <x-input-error :messages="$errors->get('nama')" />
    </div>

    <div>
        <x-input-label for="deskripsi" value="Deskripsi (opsional)" />
        <textarea id="deskripsi" name="deskripsi" rows="3" placeholder="Deskripsi singkat kategori..." class="mt-1 block w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('deskripsi', $kategori->deskripsi ?? '') }}</textarea>
        <x-input-error :messages="$errors->get('deskripsi')" />
    </div>
</div>
