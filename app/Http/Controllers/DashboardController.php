<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Pendaftaran;
use App\Models\RekamMedis;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();

        // Count statistik
        $totalPasien = Pasien::count();
        $antreanHariIni = Pendaftaran::whereDate('tanggal_daftar', $today)->count();
        $menungguPemeriksaan = Pendaftaran::whereDate('tanggal_daftar', $today)->where('status', 'menunggu')->count();
        $menungguObat = Pendaftaran::whereDate('tanggal_daftar', $today)->where('status', 'menunggu_obat')->count();
        $layananSelesai = Pendaftaran::whereDate('tanggal_daftar', $today)->where('status', 'selesai')->count();

        // Antrean Pendaftaran Terkini Hari Ini
        $antreanTerbaru = Pendaftaran::with(['pasien', 'dokter'])
            ->whereDate('tanggal_daftar', $today)
            ->latest()
            ->take(5)
            ->get();

        // Rekam Medis Terkini
        $rekamMedisTerbaru = RekamMedis::with(['pasien', 'dokter'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalPasien',
            'antreanHariIni',
            'menungguPemeriksaan',
            'menungguObat',
            'layananSelesai',
            'antreanTerbaru',
            'rekamMedisTerbaru'
        ));
    }
}