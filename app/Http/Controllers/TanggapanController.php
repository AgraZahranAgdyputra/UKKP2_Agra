<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TanggapanController extends Controller
{
    public function index(Request $request): View
    {
        $tanggapan = Tanggapan::query()
            ->with(['pengaduan:id,judul', 'user:id,name'])
            ->when($request->filled('q'), fn ($q) => $q->whereHas('pengaduan', fn ($p) => $p->where('judul', 'like', '%'.$request->q.'%')))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('tanggapan.index', compact('tanggapan'));
    }

    public function create(Request $request): View
    {
        $pengaduanList = Pengaduan::select('id', 'judul')->latest()->get();
        $selectedPengaduan = $request->query('pengaduan_id');

        return view('tanggapan.create', compact('pengaduanList', 'selectedPengaduan'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'pengaduan_id' => ['required', 'exists:pengaduan,id'],
            'isi' => ['required', 'string'],
        ]);

        $validated['user_id'] = auth()->id();

        Tanggapan::create($validated);

        return redirect()->route('tanggapan.index')->with('success', 'Tanggapan berhasil ditambahkan.');
    }

    public function edit(Tanggapan $tanggapan): View
    {
        $pengaduanList = Pengaduan::select('id', 'judul')->latest()->get();

        return view('tanggapan.edit', compact('tanggapan', 'pengaduanList'));
    }

    public function update(Request $request, Tanggapan $tanggapan): RedirectResponse
    {
        $validated = $request->validate([
            'pengaduan_id' => ['required', 'exists:pengaduan,id'],
            'isi' => ['required', 'string'],
        ]);

        $tanggapan->update($validated);

        return redirect()->route('tanggapan.index')->with('success', 'Tanggapan berhasil diperbarui.');
    }

    public function destroy(Tanggapan $tanggapan): RedirectResponse
    {
        $tanggapan->delete();

        return redirect()->route('tanggapan.index')->with('success', 'Tanggapan berhasil dihapus.');
    }
}
