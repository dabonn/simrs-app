<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Antrean Pendaftaran Poli (Hari Ini)</h2>
            <a href="{{ route('pendaftarans.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-semibold">+ Daftarkan Antrean Poli</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">No Antrean</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">No RM</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Pasien</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Poli Tujuan</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dokter</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($pendaftarans as $pendaftaran)
                                <tr>
                                    <td class="px-4 py-3 text-sm font-bold text-blue-600">{{ $pendaftaran->no_antrean }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $pendaftaran->pasien->no_rm }}</td>
                                    <td class="px-4 py-3 text-sm font-semibold text-gray-900">{{ $pendaftaran->pasien->nama }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $pendaftaran->poli }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $pendaftaran->dokter->name }}</td>
                                    <td class="px-4 py-3 text-sm text-center">
                                        <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded uppercase">
                                            {{ $pendaftaran->status }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-4 text-center text-sm text-gray-500">Belum ada antrean pendaftaran hari ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>