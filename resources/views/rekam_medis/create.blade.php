<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Form Pemeriksaan Pasien</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-6">
                <!-- Info Pasien -->
                <div class="bg-gray-50 p-4 rounded-md border border-gray-200 grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                    <div>
                        <span class="block text-gray-500">No RM:</span>
                        <strong class="text-blue-600">{{ $pendaftaran->pasien->no_rm }}</strong>
                    </div>
                    <div>
                        <span class="block text-gray-500">Nama Pasien:</span>
                        <strong>{{ $pendaftaran->pasien->nama }}</strong>
                    </div>
                    <div>
                        <span class="block text-gray-500">Poli / Dokter:</span>
                        <strong>{{ $pendaftaran->poli }} ({{ $pendaftaran->dokter->name }})</strong>
                    </div>
                    <div>
                        <span class="block text-gray-500">Jenis Kelamin / Usia:</span>
                        <strong>{{ $pendaftaran->pasien->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</strong>
                    </div>
                </div>

                <!-- Form Pemeriksaan -->
                <form action="{{ route('rekam-medis.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="pendaftaran_id" value="{{ $pendaftaran->id }}">
                    <input type="hidden" name="pasien_id" value="{{ $pendaftaran->pasien_id }}">
                    <input type="hidden" name="dokter_id" value="{{ $pendaftaran->dokter_id }}">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tekanan Darah (mmHg)</label>
                            <input type="text" name="tensi_darah" placeholder="Contoh: 120/80" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Suhu Tubuh (°C)</label>
                            <input type="text" name="suhu_tubuh" placeholder="Contoh: 36.5" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Keluhan Utama (Anamnesa) *</label>
                        <textarea name="keluhan_utama" rows="3" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Isi keluhan pasien..."></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Diagnosa Dokter *</label>
                        <textarea name="diagnosa" rows="3" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Isi hasil diagnosa..."></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tindakan Medis (Opsional)</label>
                        <textarea name="tindakan" rows="2" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Contoh: Pembersihan luka, pembersihan karang gigi, dll."></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Resep Obat (Opsional)</label>
                        <textarea name="resep_obat" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Contoh: Paracetamol 3x1, Amoxicillin 3x1"></textarea>
                    </div>

                    <div class="flex justify-end gap-2 pt-4">
                        <a href="{{ route('rekam-medis.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md">Batal</a>
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md font-semibold">Simpan Rekam Medis</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>