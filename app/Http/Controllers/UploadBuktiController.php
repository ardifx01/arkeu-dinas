<?php

namespace App\Http\Controllers;

use App\Models\UploadBukti;
use App\Models\Laporan;
use Illuminate\Http\Request;

class UploadBuktiController extends Controller
{
    public function index()
    {
        $bukti = UploadBukti::with('laporan')->latest()->get();
        return view('bukti.index', compact('bukti'));
    }

    public function create()
    {
        $laporan = Laporan::all();
        return view('bukti.create', compact('laporan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'laporan_id' => 'required|exists:laporan,id',
            'file' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $path = $request->file('file')->store('bukti', 'public');

        UploadBukti::create([
            'laporan_id' => $request->laporan_id,
            'file_path' => $path,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('bukti.index')->with('success', 'Bukti berhasil diupload.');
    }

    public function show(UploadBukti $bukti)
    {
        return view('bukti.show', compact('bukti'));
    }

    public function destroy(UploadBukti $bukti)
    {
        $bukti->delete();
        return redirect()->route('bukti.index')->with('success', 'Bukti berhasil dihapus.');
    }
}
