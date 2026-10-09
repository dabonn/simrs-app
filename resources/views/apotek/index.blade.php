<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Layanan Apotek & Pengambilan Obat</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Daftar Resep Obat Pasien (Hari Ini)</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">No RM</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Pasien</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dokter Penanggung Jawab</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Resep Obat</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($reseps as $resep)
                                <tr>
                                    <td class="px-4 py-3 text-sm font-semibold text-gray-700">{{ $resep->pasien->no_rm }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-900 font-bold">{{ $resep->pasien->nama }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $resep->dokter->name }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-800 whitespace-pre-line">{{ $resep->resep_obat ?? 'Tidak ada resep' }}</td>
                                    <td class="px-4 py-3 text-sm text-center">
                                        @if($resep->pendaftaran->status == 'menunggu_obat')
                                            <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded uppercase">Menunggu Obat</span>
                                        @else
                                            <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded uppercase">Selesai</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-sm text-center space-x-2">
                                        <a href="{{ route('apotek.cetak', $resep->id) }}" target="_blank" class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-1 rounded text-xs font-semibold">Cetak Resep</a>

                                        @if($resep->pendaftaran->status == 'menunggu_obat')
                                            <form action="{{ route('apotek.serahkan', $resep->pendaftaran_id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" onclick="return confirm('Apakah obat sudah siap dan diserahkan ke pasien?')" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs font-semibold">Serahkan Obat</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-4 text-center text-sm text-gray-500">Belum ada resep obat untuk hari ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>