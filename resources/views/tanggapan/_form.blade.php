@php $tanggapan = $tanggapan ?? null; @endphp

<div class="grid grid-cols-1 gap-5">
    <div>
        <x-input-label for="pengaduan_id" value="Pengaduan" />
        <select id="pengaduan_id" name="pengaduan_id" required class="mt-1 block w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <option value="">-- Pilih Pengaduan --</option>
            @foreach ($pengaduanList as $p)
                <option value="{{ $p->id }}" {{ old('pengaduan_id', $tanggapan->pengaduan_id ?? ($selectedPengaduan ?? '')) == $p->id ? 'selected' : '' }}>
                    {{ $p->judul }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('pengaduan_id')" />
    </div>

    <div>
        <x-input-label for="isi" value="Isi Tanggapan" />
        <textarea id="isi" name="isi" rows="4" required placeholder="Tulis tanggapan..." class="mt-1 block w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('isi', $tanggapan->isi ?? '') }}</textarea>
        <x-input-error :messages="$errors->get('isi')" />
    </div>
</div>
