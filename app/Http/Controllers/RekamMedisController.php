<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    // Menampilkan daftar antrean pemeriksaan untuk dokter dan riwayat rekam medis
    public function index()
    {
        $antreans = Pendaftaran::with(['pasien', 'dokter'])
            ->whereDate('tanggal_daftar', now()->toDateString())
            ->whereIn('status', ['menunggu', 'diperiksa'])
            ->orderBy('id', 'asc')
            ->get();

        $historyMedis = RekamMedis::with(['pasien', 'dokter'])
            ->latest()
            ->get();

        return view('rekam_medis.index', compact('antreans', 'historyMedis'));
    }

    // Form input rekam medis untuk pasien tertentu
    public function create($pendaftaran_id)
    {
        $pendaftaran = Pendaftaran::with(['pasien', 'dokter'])->findOrFail($pendaftaran_id);

        // Ubah status pendaftaran menjadi 'diperiksa'
        $pendaftaran->update(['status' => 'diperiksa']);

        return view('rekam_medis.create', compact('pendaftaran'));
    }

    // Simpan data rekam medis
    public function store(Request $request)
    {
        $request->validate([
            'pendaftaran_id' => 'required|exists:pendaftarans,id',
            'pasien_id'      => 'required|exists:pasiens,id',
            'dokter_id'      => 'required|exists:users,id',
            'keluhan_utama'  => 'required|string',
            'diagnosa'       => 'required|string',
            'tensi_darah'    => 'nullable|string',
            'suhu_tubuh'     => 'nullable|string',
            'tindakan'       => 'nullable|string',
            'resep_obat'     => 'nullable|string',
        ]);

        // Simpan data Rekam Medis
        RekamMedis::create([
            'pendaftaran_id' => $request->pendaftaran_id,
            'pasien_id'      => $request->pasien_id,
            'dokter_id'      => $request->dokter_id,
            'keluhan_utama'  => $request->keluhan_utama,
            'tensi_darah'    => $request->tensi_darah,
            'suhu_tubuh'     => $request->suhu_tubuh,
            'diagnosa'       => $request->diagnosa,
            'tindakan'       => $request->tindakan,
            'resep_obat'     => $request->resep_obat,
        ]);

        // Update status pendaftaran pasien menjadi 'menunggu_obat' agar masuk ke antrean Apotek
        Pendaftaran::where('id', $request->pendaftaran_id)->update(['status' => 'menunggu_obat']);

        return redirect()->route('rekam-medis.index')->with('success', 'Pemeriksaan medis berhasil disimpan dan dirujuk ke Apotek!');
    }
}