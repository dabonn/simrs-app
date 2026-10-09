<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Antrean - RS CIPTA MEDIKA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Library untuk auto-download gambar struk -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-sm w-full">
        
        <!-- AREA KARTU STRUK YANG AKAN DI-DOWNLOAD -->
        <div id="strukCard" class="bg-white rounded-2xl shadow-2xl border border-gray-200 overflow-hidden">
            
            <!-- HEADER STRUK -->
            <div class="bg-emerald-600 text-white p-6 text-center">
                <div class="w-12 h-12 bg-white text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-2 text-2xl font-black shadow">
                    ✓
                </div>
                <h1 class="text-xl font-bold tracking-wide">RS CIPTA MEDIKA</h1>
                <p class="text-xs text-emerald-100 mt-0.5">Pendaftaran Berhasil</p>
            </div>

            <!-- ISI STRUK -->
            <div class="p-6">
                <!-- NOMOR ANTREAN UTAMA -->
                <div class="bg-emerald-50 border-2 border-dashed border-emerald-300 rounded-xl p-4 text-center mb-6">
                    <p class="text-xs font-bold text-emerald-700 uppercase tracking-wider">Nomor Antrean Anda</p>
                    <p class="text-5xl font-black text-emerald-700 my-2">
                        {{ sprintf('%03d', $pendaftaran->no_antrean) }}
                    </p>
                    <div class="inline-block bg-emerald-200 text-emerald-800 text-xs font-bold px-3 py-1 rounded-full">
                        Jam Dipanggil: {{ $estimasiJam }} WIB
                    </div>
                </div>

                <!-- DETAIL PASIEN & DOKTER -->
                <div class="space-y-3 text-sm text-gray-700 border-b pb-5">
                    <div class="flex justify-between">
                        <span class="text-gray-400">Poli Tujuan:</span>
                        <span class="font-bold text-gray-900">{{ $pendaftaran->poli }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Dokter Bertugas:</span>
                        <span class="font-bold text-emerald-700 text-right">
                            {{ $pendaftaran->dokter ? $pendaftaran->dokter->name : 'Dokter Jaga Poli' }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Tgl Berobat:</span>
                        <span class="font-semibold text-gray-800">
                            {{ \Carbon\Carbon::parse($pendaftaran->tanggal_daftar)->translatedFormat('d F Y') }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">No. Rekam Medis:</span>
                        <span class="font-mono font-bold text-gray-900">{{ $pendaftaran->pasien->no_rm }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Nama Pasien:</span>
                        <span class="font-bold text-gray-900">{{ $pendaftaran->pasien->nama }}</span>
                    </div>
                </div>

                <!-- PETUNJUK RINGKAS -->
                <div class="mt-4 text-center text-xs text-gray-500 italic">
                    💡 Tunjukkan layar HP atau simpan struk ini saat Anda tiba di rumah sakit.
                </div>
            </div>

        </div>

        <!-- TOMBOL AKSI -->
        <div class="mt-4 space-y-2">
            <!-- TOMBOL UNDUH STRUK -->
            <button onclick="downloadStruk()" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 rounded-xl transition shadow flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                Simpan / Unduh Gambar Struk
            </button>

            <!-- TOMBOL KEMBALI -->
            <a href="{{ route('pendaftaran-online.index') }}" class="block w-full text-center bg-gray-800 hover:bg-gray-900 text-white font-bold py-3 rounded-xl transition shadow">
                Selesai & Kembali
            </a>
        </div>

    </div>

    <script>
        function downloadStruk() {
            const card = document.getElementById('strukCard');
            html2canvas(card, { scale: 2 }).then(canvas => {
                const image = canvas.toDataURL("image/png");
                const link = document.createElement('a');
                link.href = image;
                link.download = "Struk-Antrean-{{ $pendaftaran->pasien->no_rm }}.png";
                link.click();
            });
        }
    </script>

</body>
</html>