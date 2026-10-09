<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Online Pasien - SIMRS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen py-10 px-4">

    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-md overflow-hidden p-6 md:p-8">
        
        <div class="text-center mb-8 border-b pb-4">
            <h1 class="text-2xl font-bold text-gray-800 uppercase tracking-wide">Pendaftaran Online Pasien</h1>
            <p class="text-gray-500 text-sm mt-1">Silakan pilih menu pendaftaran atau cek status antrean Anda</p>
        </div>

        <!-- Navigation Tab Selection -->
        <div class="flex border-b mb-6 text-xs md:text-sm">
            <button type="button" id="btn-lama" onclick="switchTab('lama')" class="w-1/3 py-2.5 text-center font-bold border-b-2 border-blue-600 text-blue-600 focus:outline-none">
                Pasien Lama
            </button>
            <button type="button" id="btn-baru" onclick="switchTab('baru')" class="w-1/3 py-2.5 text-center font-bold text-gray-500 hover:text-blue-600 focus:outline-none">
                Pasien Baru
            </button>
            <button type="button" id="btn-cek" onclick="switchTab('cek')" class="w-1/3 py-2.5 text-center font-bold text-gray-500 hover:text-blue-600 focus:outline-none">
                Cek Status Antrean
            </button>
        </div>

        <!-- FORM UTAMA PENDAFTARAN -->
        <form action="{{ route('pendaftaran-online.store') }}" method="POST" id="form-pendaftaran">
            @csrf

            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 text-sm rounded">
                    {{ session('error') }}
                </div>
            @endif

            <input type="hidden" name="is_pasien_baru" id="is_pasien_baru" value="0">
            <input type="hidden" name="pasien_id" id="pasien_id" value="">

            <!-- SECTION PASIEN LAMA -->
            <div id="section-pasien-lama" class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Cari NIK / Nomor Rekam Medis (RM)</label>
                <div class="flex gap-2">
                    <input type="text" id="keyword" maxlength="16" oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Masukkan 16 Digit NIK / No. RM...">
                    <button type="button" onclick="cariPasien()" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2.5 rounded-lg transition">
                        Cari
                    </button>
                </div>
                <div id="pesan-error" class="text-red-500 text-xs mt-2 hidden"></div>

                <!-- Box Data Pasien Ditemukan & Riwayat -->
                <div id="info-pasien-box" class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-lg hidden">
                    <p class="text-xs font-bold text-blue-600 uppercase tracking-wider">Data Pasien Ditemukan:</p>
                    <p id="nama-pasien" class="text-lg font-bold text-gray-800 mt-1"></p>
                    <p id="detail-pasien" class="text-sm text-gray-600 mb-3"></p>

                    <div class="border-t border-blue-200 pt-3">
                        <p class="text-xs font-bold text-gray-700 mb-2">Riwayat Berobat Terakhir:</p>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-xs text-gray-600 bg-white rounded border">
                                <thead class="bg-gray-100 text-gray-700 uppercase">
                                    <tr>
                                        <th class="p-2 border">Tanggal</th>
                                        <th class="p-2 border">Poli</th>
                                        <th class="p-2 border">Dokter</th>
                                        <th class="p-2 border">Status</th>
                                    </tr>
                                </thead>
                                <tbody id="tabel-riwayat-body"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION PASIEN BARU -->
            <div id="section-pasien-baru" class="space-y-4 mb-6 hidden">
                <div>
                    <label class="block text-gray-700 font-bold mb-1">Nama Lengkap *</label>
                    <input type="text" name="nama" class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Sesuai KTP">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 font-bold mb-1">NIK (KTP) *</label>
                        <input type="text" name="nik" maxlength="16" oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Maksimal 16 digit angka">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-1">Jenis Kelamin *</label>
                        <select name="jenis_kelamin" class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <option value="">-- Pilih --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 font-bold mb-1">Tanggal Lahir *</label>
                        <input type="date" name="tanggal_lahir" class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-1">No. WhatsApp / HP *</label>
                        <input type="text" name="no_hp" maxlength="13" oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Maksimal 13 digit angka">
                    </div>
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-1">Alamat Lengkap *</label>
                    <textarea name="alamat" rows="2" class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Alamat domisili"></textarea>
                </div>
            </div>

            <!-- SELEKSI POLI & ESTIMASI (UNTUK PROSES PENDAFTARAN) -->
            <div id="section-pendaftaran-detail">
                <hr class="my-6 border-gray-200">
                <div class="space-y-4 mb-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-1">Pilih Poli Tujuan *</label>
                        <select id="poli-select" name="poli" class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                            <option value="">-- Pilih Poli --</option>
                            <option value="Poli Umum">Poli Umum</option>
                            <option value="Poli Gigi">Poli Gigi</option>
                            <option value="Poli Penyakit Dalam">Poli Penyakit Dalam</option>
                            <option value="Poli Anak">Poli Anak</option>
                        </select>
                    </div>

                    <div id="info-antrean-box" class="p-4 bg-green-50 border border-green-300 rounded-lg hidden">
                        <p class="text-xs font-bold text-green-700 uppercase tracking-wider">Informasi Panggilan Pelayanan:</p>
                        <p id="teks-antrean" class="text-base font-bold text-gray-800 mt-1"></p>
                        <p class="text-xs text-gray-500 mt-1">*Dokter bertugas akan ditentukan secara otomatis oleh sistem saat giliran Anda dipanggil.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 font-bold mb-1">Tanggal Berobat *</label>
                            <input type="date" id="tanggal-daftar" name="tanggal_daftar" value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}" class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-1">Keluhan Utama (Opsional)</label>
                            <input type="text" name="keluhan" class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Contoh: Demam, Batuk, dll.">
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg shadow-lg hover:shadow-xl transition duration-200">
                    Proses Pendaftaran
                </button>
            </div>
        </form>

        <!-- SECTION CEK STATUS PENDAFTARAN / ANTREAN -->
        <div id="section-cek-pendaftaran" class="hidden">
            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Cari berdasarkan Kode Booking / No. RM / NIK Pasien</label>
                <div class="flex gap-2">
                    <input type="text" id="keyword-cek" class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Masukkan Kode Booking / No. RM / NIK...">
                    <button type="button" onclick="cekStatusAntrean()" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2.5 rounded-lg transition whitespace-nowrap">
                        Cek Status
                    </button>
                </div>
                <div id="pesan-error-cek" class="text-red-500 text-xs mt-2 hidden"></div>
            </div>

            <!-- Hasil Pencarian Status Pendaftaran -->
            <div id="hasil-status-box" class="p-5 bg-gray-50 border border-gray-200 rounded-xl hidden">
                <div class="text-center border-b pb-4 mb-4">
                    <span id="badge-status" class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-yellow-100 text-yellow-800">
                        Menunggu
                    </span>
                    <p class="text-2xl font-bold text-gray-800 mt-2" id="res-no-antrean">-</p>
                    <p class="text-xs text-gray-500" id="res-kode-booking">-</p>
                </div>

                <div class="space-y-2 text-sm text-gray-700">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Nama Pasien:</span>
                        <span class="font-bold text-gray-800" id="res-nama-pasien">-</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Poli Tujuan:</span>
                        <span class="font-bold text-gray-800" id="res-poli">-</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Tanggal Berobat:</span>
                        <span class="font-bold text-gray-800" id="res-tanggal">-</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Dokter Melayani:</span>
                        <span class="font-bold text-gray-800" id="res-dokter">-</span>
                    </div>
                </div>

                <div class="mt-5 pt-4 border-t flex gap-2">
                    <button type="button" onclick="window.print()" class="w-full bg-gray-800 hover:bg-gray-900 text-white text-sm font-semibold py-2 rounded-lg transition text-center">
                        Cetak Bukti Pendaftaran
                    </button>
                </div>
            </div>
        </div>

    </div>

    <!-- JAVASCRIPT LOGIC -->
    <script>
        function switchTab(type) {
            let isBaruInput = document.getElementById('is_pasien_baru');
            let secLama = document.getElementById('section-pasien-lama');
            let secBaru = document.getElementById('section-pasien-baru');
            let secDetailForm = document.getElementById('section-pendaftaran-detail');
            let secCek = document.getElementById('section-cek-pendaftaran');
            
            let btnLama = document.getElementById('btn-lama');
            let btnBaru = document.getElementById('btn-baru');
            let btnCek = document.getElementById('btn-cek');

            document.getElementById('pasien_id').value = "";
            document.getElementById('info-pasien-box').classList.add('hidden');
            document.getElementById('pesan-error').classList.add('hidden');
            document.getElementById('pesan-error-cek').classList.add('hidden');
            document.getElementById('hasil-status-box').classList.add('hidden');

            const activeClass = "w-1/3 py-2.5 text-center font-bold border-b-2 border-blue-600 text-blue-600 focus:outline-none";
            const inactiveClass = "w-1/3 py-2.5 text-center font-bold text-gray-500 hover:text-blue-600 focus:outline-none";

            if (type === 'baru') {
                isBaruInput.value = "1";
                secLama.classList.add('hidden');
                secBaru.classList.remove('hidden');
                secDetailForm.classList.remove('hidden');
                secCek.classList.add('hidden');

                btnBaru.className = activeClass;
                btnLama.className = inactiveClass;
                btnCek.className = inactiveClass;
            } else if (type === 'cek') {
                secLama.classList.add('hidden');
                secBaru.classList.add('hidden');
                secDetailForm.classList.add('hidden');
                secCek.classList.remove('hidden');

                btnCek.className = activeClass;
                btnLama.className = inactiveClass;
                btnBaru.className = inactiveClass;
            } else {
                isBaruInput.value = "0";
                secLama.classList.remove('hidden');
                secBaru.classList.add('hidden');
                secDetailForm.classList.remove('hidden');
                secCek.classList.add('hidden');

                btnLama.className = activeClass;
                btnBaru.className = inactiveClass;
                btnCek.className = inactiveClass;
            }
        }

        function cariPasien() {
            let keyword = document.getElementById('keyword').value;
            let errorEl = document.getElementById('pesan-error');
            let infoBox = document.getElementById('info-pasien-box');
            let pasienIdInput = document.getElementById('pasien_id');
            let tabelBody = document.getElementById('tabel-riwayat-body');

            errorEl.classList.add('hidden');
            infoBox.classList.add('hidden');
            pasienIdInput.value = "";
            tabelBody.innerHTML = "";

            if (!keyword) {
                errorEl.innerHTML = "Masukkan NIK atau No. RM terlebih dahulu.";
                errorEl.classList.remove('hidden');
                return;
            }

            fetch("{{ route('pendaftaran-online.check') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ keyword: keyword })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    pasienIdInput.value = data.pasien.id;
                    document.getElementById('nama-pasien').innerText = data.pasien.nama + " (" + data.pasien.no_rm + ")";
                    document.getElementById('detail-pasien').innerText = "NIK: " + data.pasien.nik + " | Tgl Lahir: " + data.pasien.tanggal_lahir;
                    
                    if (!data.riwayat || data.riwayat.length === 0) {
                        tabelBody.innerHTML = `<tr><td colspan="4" class="p-2 text-center text-gray-400">Belum ada riwayat berobat.</td></tr>`;
                    } else {
                        data.riwayat.forEach(item => {
                            let dokterNama = item.dokter ? item.dokter.name : '-';
                            let row = `
                                <tr>
                                    <td class="p-2 border">${item.tanggal_daftar}</td>
                                    <td class="p-2 border">${item.poli}</td>
                                    <td class="p-2 border">${dokterNama}</td>
                                    <td class="p-2 border uppercase text-xs font-bold ${item.status === 'selesai' ? 'text-green-600' : 'text-yellow-600'}">${item.status}</td>
                                </tr>
                            `;
                            tabelBody.innerHTML += row;
                        });
                    }

                    infoBox.classList.remove('hidden');
                } else {
                    errorEl.innerHTML = `Data tidak ditemukan! NIK ini belum terdaftar. <br><button type="button" onclick="switchTab('baru')" class="mt-1 underline text-blue-600 font-bold hover:text-blue-800">Klik di sini untuk mendaftar sebagai Pasien Baru</button>`;
                    errorEl.classList.remove('hidden');
                }
            })
            .catch(err => {
                errorEl.innerText = "Terjadi kesalahan sistem saat mencari data pasien.";
                errorEl.classList.remove('hidden');
            });
        }

        function cekStatusAntrean() {
            let keyword = document.getElementById('keyword-cek').value.trim();
            let errorEl = document.getElementById('pesan-error-cek');
            let statusBox = document.getElementById('hasil-status-box');

            errorEl.classList.add('hidden');
            statusBox.classList.add('hidden');

            if (!keyword) {
                errorEl.innerText = "Masukkan Kode Booking, No. RM, atau NIK terlebih dahulu.";
                errorEl.classList.remove('hidden');
                return;
            }

            fetch('/pendaftaran-online/status/' + encodeURIComponent(keyword))
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('res-no-antrean').innerText = "No. Antrean: " + data.data.nomor_antrean;
                        document.getElementById('res-kode-booking').innerText = "Kode Booking: " + data.data.kode_booking;
                        document.getElementById('res-nama-pasien').innerText = data.data.nama_pasien;
                        document.getElementById('res-poli').innerText = data.data.poli;
                        document.getElementById('res-tanggal').innerText = data.data.tanggal_daftar;
                        document.getElementById('res-dokter').innerText = data.data.nama_dokter || 'Akan ditentukan saat panggilan';

                        let badge = document.getElementById('badge-status');
                        badge.innerText = data.data.status;

                        if (data.data.status === 'selesai') {
                            badge.className = "px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-green-100 text-green-800";
                        } else if (data.data.status === 'batal') {
                            badge.className = "px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-red-100 text-red-800";
                        } else {
                            badge.className = "px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-yellow-100 text-yellow-800";
                        }

                        statusBox.classList.remove('hidden');
                    } else {
                        errorEl.innerText = data.message || "Data pendaftaran tidak ditemukan.";
                        errorEl.classList.remove('hidden');
                    }
                })
                .catch(err => {
                    errorEl.innerText = "Terjadi kesalahan sistem saat mengambil data status.";
                    errorEl.classList.remove('hidden');
                });
        }

        document.addEventListener("DOMContentLoaded", function () {
            const poliSelect = document.getElementById('poli-select');
            const tanggalInput = document.getElementById('tanggal-daftar');
            const antreanBox = document.getElementById('info-antrean-box');
            const teksAntrean = document.getElementById('teks-antrean');

            function checkEstimasi() {
                let poliVal = poliSelect.value;
                let tanggalVal = tanggalInput.value;

                if (!poliVal) {
                    antreanBox.classList.add('hidden');
                    return;
                }

                fetch('/get-dokter/' + encodeURIComponent(poliVal) + '?tanggal=' + tanggalVal)
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            teksAntrean.innerText = data.message;
                            antreanBox.classList.remove('hidden');
                        }
                    });
            }

            poliSelect.addEventListener('change', checkEstimasi);
            tanggalInput.addEventListener('change', checkEstimasi);
        });
    </script>
</body>
</html>