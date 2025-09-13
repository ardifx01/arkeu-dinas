<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $laporan = Laporan::with('user')->latest()->get();
        return view('laporan.index', compact('laporan'));
    }

    public function create()
    {
        return view('laporan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'status' => 'sometimes|string|in:pending,proses,selesai,menunggu,ditunda',
            'total_anggaran' => 'required|numeric|min:0',
        ]);

        Laporan::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'user_id' => auth()->id(),
            'status' => $request->status ?? 'pending',
            'total_anggaran' => $request->total_anggaran,
        ]);

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dibuat.');
    }

    public function show(Laporan $laporan)
    {
        return view('laporan.show', compact('laporan'));
    }

    public function edit(Laporan $laporan)
    {
        return view('laporan.edit', compact('laporan'));
    }

        public function update(Request $request, $id)
        {
            $laporan = Laporan::findOrFail($id);

            $laporan->update([
                'judul' => $request->judul,
                'total_anggaran' => $request->total_anggaran,
                'tanggal' => $request->tanggal,
                'status' => $request->status,
                'deskripsi' => $request->deskripsi,
            ]);

            return redirect()->route('laporan.index')->with('success', 'Laporan berhasil diperbarui');
        }



    public function destroy($id)
{
    $laporan = Laporan::findOrFail($id);
    $laporan->delete();

    return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dihapus.');
}

}
