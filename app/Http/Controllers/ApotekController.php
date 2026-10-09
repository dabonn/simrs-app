<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class ApotekController extends Controller
{
    // Menampilkan daftar resep obat hari ini
    public function index()
    {
        $reseps = RekamMedis::with(['pasien', 'dokter', 'pendaftaran'])
            ->whereHas('pendaftaran', function ($query) {
                $query->whereDate('tanggal_daftar', now()->toDateString());
            })
            ->latest()
            ->get();

        return view('apotek.index', compact('reseps'));
    }

    // Konfirmasi penyerahan obat ke pasien
    public function serahkanObat($pendaftaran_id)
    {
        $pendaftaran = Pendaftaran::findOrFail($pendaftaran_id);
        $pendaftaran->update(['status' => 'selesai']);

        return redirect()->route('apotek.index')->with('success', 'Obat berhasil diserahkan ke pasien!');
    }

    // Cetak Struk / Nota Resep
    public function cetak($id)
    {
        $rekamMedis = RekamMedis::with(['pasien', 'dokter', 'pendaftaran'])->findOrFail($id);

        return view('apotek.cetak', compact('rekamMedis'));
    }
}