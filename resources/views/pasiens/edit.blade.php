<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Data Pasien: {{ $pasien->nama }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('pasiens.update', $pasien->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nomor RM</label>
                            <input type="text" value="{{ $pasien->no_rm }}" disabled class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm font-bold text-gray-600">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">NIK (16 Digit)</label>
                            <input type="text" name="nik" value="{{ old('nik', $pasien->nik) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap Pasien</label>
                        <input type="text" name="nama" value="{{ old('nama', $pasien->nama) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="L" {{ $pasien->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki (L)</option>
                                <option value="P" {{ $pasien->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan (P)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $pasien->tanggal_lahir) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nomor HP / WA</label>
                            <input type="text" name="no_hp" value="{{ old('no_hp', $pasien->no_hp) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                        <textarea name="alamat" rows="3" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('alamat', $pasien->alamat) }}</textarea>
                    </div>

                    <div class="flex justify-end gap-2 pt-4">
                        <a href="{{ route('pasiens.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md">Batal</a>
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md font-semibold">Perbarui Data Pasien</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>