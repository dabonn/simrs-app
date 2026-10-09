<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Pasien;
use App\Models\User;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index()
    {
        // Ambil daftar antrean pendaftaran hari ini
        $pendaftarans = Pendaftaran::with(['pasien', 'dokter'])
            ->whereDate('tanggal_daftar', now()->toDateString())
            ->orderBy('id', 'asc')
            ->get();

        return view('pendaftarans.index', compact('pendaftarans'));
    }

    public function create()
    {
        $pasiens = Pasien::all();
        $dokters = User::where('role', 'dokter')->get();

        return view('pendaftarans.create', compact('pasiens', 'dokters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pasien_id' => 'required|exists:pasiens,id',
            'dokter_id' => 'required|exists:users,id',
            'poli' => 'required|string',
        ]);

        // Hitung nomor antrean otomatis untuk hari ini
        $todayCount = Pendaftaran::whereDate('tanggal_daftar', now()->toDateString())->count();
        $noAntrean = 'A-' . str_pad($todayCount + 1, 3, '0', STR_PAD_LEFT);

        Pendaftaran::create([
            'pasien_id' => $request->pasien_id,
            'dokter_id' => $request->dokter_id,
            'poli' => $request->poli,
            'no_antrean' => $noAntrean,
            'tanggal_daftar' => now()->toDateString(),
            'status' => 'menunggu',
        ]);

        return redirect()->route('pendaftarans.index')->with('success', 'Pasien berhasil didaftarkan ke antrean!');
    }
}