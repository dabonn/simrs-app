<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftarkan Pasien ke Poli</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('pendaftarans.store') }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Pilih Pasien</label>
                        <select name="pasien_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">-- Pilih Pasien --</option>
                            @foreach($pasiens as $pasien)
                                <option value="{{ $pasien->id }}">{{ $pasien->no_rm }} - {{ $pasien->nama }} (NIK: {{ $pasien->nik }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Poli Tujuan</label>
                            <select name="poli" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="Poli Umum">Poli Umum</option>
                                <option value="Poli Gigi">Poli Gigi</option>
                                <option value="Poli Penyakit Dalam">Poli Penyakit Dalam</option>
                                <option value="Poli Anak">Poli Anak</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Pilih Dokter</label>
                            <select name="dokter_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">-- Pilih Dokter --</option>
                                @foreach($dokters as $dokter)
                                    <option value="{{ $dokter->id }}">{{ $dokter->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 pt-4">
                        <a href="{{ route('pendaftarans.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md">Batal</a>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md font-semibold">Daftarkan Antrean</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>