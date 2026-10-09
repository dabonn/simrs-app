<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pemeriksaan Dokter & Rekam Medis</h2>
    </x-slot>

    <div class="py-12 space-y-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tabel Antrean Pasien -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Antrean Pasien Hari Ini (Belum Diperiksa)</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Antrean</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">No RM</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Pasien</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Poli</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dokter</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($antreans as $antrean)
                                <tr>
                                    <td class="px-4 py-3 text-sm font-bold text-blue-600">{{ $antrean->no_antrean }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $antrean->pasien->no_rm }}</td>
                                    <td class="px-4 py-3 text-sm font-semibold text-gray-900">{{ $antrean->pasien->nama }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $antrean->poli }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $antrean->dokter->name }}</td>
                                    <td class="px-4 py-3 text-sm text-center">
                                        <a href="{{ route('rekam-medis.create', $antrean->id) }}" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs font-semibold">Periksa Pasien</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-4 text-center text-sm text-gray-500">Tidak ada antrean pasien menunggu saat ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Riwayat Rekam Medis -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Riwayat Rekam Medis Terbaru</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">No RM</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pasien</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Keluhan</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Diagnosa</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Resep</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($historyMedis as $rm)
                                <tr>
                                    <td class="px-4 py-3 text-sm text-gray-500">{{ $rm->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="px-4 py-3 text-sm font-semibold text-gray-700">{{ $rm->pasien->no_rm }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-900">{{ $rm->pasien->nama }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $rm->keluhan_utama }}</td>
                                    <td class="px-4 py-3 text-sm font-medium text-blue-700">{{ $rm->diagnosa }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $rm->resep_obat ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-4 text-center text-sm text-gray-500">Belum ada riwayat rekam medis.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>