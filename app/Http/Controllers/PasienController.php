<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $pasiens = Pasien::when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%{$search}%")
                         ->orWhere('no_rm', 'like', "%{$search}%")
                         ->orWhere('nik', 'like', "%{$search}%");
        })->latest()->paginate(10);

        return view('pasiens.index', compact('pasiens'));
    }

    public function create()
    {
        // Otomatis buat Nomor Rekam Medis (misal: RM-2026-0003)
        $nextId = Pasien::max('id') + 1;
        $noRmAuto = 'RM-' . date('Y') . '-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

        return view('pasiens.create', compact('noRmAuto'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_rm' => 'required|unique:pasiens,no_rm',
            'nik' => 'required|numeric|digits:16|unique:pasiens,nik',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:15',
        ]);

        Pasien::create($request->all());

        return redirect()->route('pasiens.index')->with('success', 'Pasien berhasil didaftarkan!');
    }

    public function edit(Pasien $pasien)
    {
        return view('pasiens.edit', compact('pasien'));
    }

    public function update(Request $request, Pasien $pasien)
    {
        $request->validate([
            'nik' => 'required|numeric|digits:16|unique:pasiens,nik,' . $pasien->id,
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:15',
        ]);

        $pasien->update($request->all());

        return redirect()->route('pasiens.index')->with('success', 'Data pasien berhasil diperbarui!');
    }

    public function destroy(Pasien $pasien)
    {
        $pasien->delete();

        return redirect()->route('pasiens.index')->with('success', 'Data pasien berhasil dihapus!');
    }
}