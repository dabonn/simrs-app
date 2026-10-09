<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Pasien SIMRS</h2>
            <a href="{{ route('pasiens.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-semibold">+ Tambah Pasien Baru</a>
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
                <!-- Form Pencarian -->
                <form method="GET" action="{{ route('pasiens.index') }}" class="mb-4 flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama / No RM / NIK..." class="border-gray-300 rounded-md shadow-sm w-full md:w-1/3">
                    <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-md">Cari</button>
                </form>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">No RM</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">NIK</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Pasien</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">L/P</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tgl Lahir</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">No HP</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($pasiens as $pasien)
                                <tr>
                                    <td class="px-4 py-3 text-sm font-bold text-blue-600">{{ $pasien->no_rm }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $pasien->nik }}</td>
                                    <td class="px-4 py-3 text-sm font-semibold text-gray-900">{{ $pasien->nama }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $pasien->jenis_kelamin }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $pasien->tanggal_lahir }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $pasien->no_hp }}</td>
                                    <td class="px-4 py-3 text-sm text-center">
                                        <a href="{{ route('pasiens.edit', $pasien->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2 font-medium">Edit</a>
                                        <form action="{{ route('pasiens.destroy', $pasien->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus data pasien ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 font-medium">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-4 text-center text-sm text-gray-500">Data pasien tidak ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $pasiens->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>