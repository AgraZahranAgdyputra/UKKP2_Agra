<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PengaduanController extends Controller
{
    public function index(Request $request): View
    {
        $pengaduan = Pengaduan::query()
            ->with('user:id,name')
            ->when($request->filled('q'), fn ($q) => $q->where('judul', 'like', '%'.$request->q.'%'))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('pengaduan.index', compact('pengaduan'));
    }

    public function create(): View
    {
        return view('pengaduan.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'judul'     => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'kategori'  => ['required', 'string', 'max:255'],
            'tanggal'   => ['required', 'date'],
            'foto'      => ['nullable', 'image', 'max:2048'],
        ]);

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'pending';

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('pengaduan', 'public');
        }

        Pengaduan::create($validated);

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dibuat.');
    }

    public function show(Pengaduan $pengaduan): View
    {
        $pengaduan->load('user:id,name');

        return view('pengaduan.show', compact('pengaduan'));
    }

    public function edit(Pengaduan $pengaduan): View
    {
        return view('pengaduan.edit', compact('pengaduan'));
    }

    public function update(Request $request, Pengaduan $pengaduan): RedirectResponse
    {
        $validated = $request->validate([
            'judul'     => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'kategori'  => ['required', 'string', 'max:255'],
            'tanggal'   => ['required', 'date'],
            'status'    => ['required', 'in:pending,proses,selesai'],
            'foto'      => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('foto')) {
            if ($pengaduan->foto) {
                Storage::disk('public')->delete($pengaduan->foto);
            }
            $validated['foto'] = $request->file('foto')->store('pengaduan', 'public');
        }

        $pengaduan->update($validated);

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil diperbarui.');
    }

    public function destroy(Pengaduan $pengaduan): RedirectResponse
    {
        if ($pengaduan->foto) {
            Storage::disk('public')->delete($pengaduan->foto);
        }

        $pengaduan->delete();

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dihapus.');
    }
}
