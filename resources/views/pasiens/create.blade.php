<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pendaftaran Pasien Baru</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('pasiens.store') }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nomor Rekam Medis (Auto)</label>
                            <input type="text" name="no_rm" value="{{ $noRmAuto }}" readonly class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm font-bold text-blue-600">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">NIK (16 Digit)</label>
                            <input type="text" name="nik" value="{{ old('nik') }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('nik') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap Pasien</label>
                        <input type="text" name="nama" value="{{ old('nama') }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="L">Laki-laki (L)</option>
                                <option value="P">Perempuan (P)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nomor HP / WA</label>
                            <input type="text" name="no_hp" value="{{ old('no_hp') }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                        <textarea name="alamat" rows="3" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('alamat') }}</textarea>
                    </div>

                    <div class="flex justify-end gap-2 pt-4">
                        <a href="{{ route('pasiens.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md">Batal</a>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md font-semibold">Simpan Data Pasien</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>