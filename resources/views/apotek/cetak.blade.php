<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Resep Obat - {{ $rekamMedis->pasien->nama }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; margin: 20px; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 10px; margin-bottom: 15px; }
        .header h2 { margin: 0; }
        .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table td { padding: 4px 0; }
        .box { border: 1px solid #ccc; padding: 10px; margin-top: 10px; border-radius: 4px; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="no-print" style="margin-bottom: 15px;">
        <button onclick="window.print()" style="padding: 8px 16px; cursor: pointer;">Cetak Resep</button>
    </div>

    <div class="header">
        <h2>KLINIK / RUMAH SAKIT SEHAT</h2>
        <p>Jl. Raya Utama No. 123, Jakarta | Telp: (021) 555-1234</p>
    </div>

    <h3>LEMBAR RESEP OBAT</h3>

    <table class="table">
        <tr>
            <td width="20%"><strong>No. RM</strong></td>
            <td width="30%">: {{ $rekamMedis->pasien->no_rm }}</td>
            <td width="20%"><strong>Tanggal</strong></td>
            <td width="30%">: {{ $rekamMedis->created_at->format('d/m/Y H:i') }}</td>
        </tr>
        <tr>
            <td><strong>Nama Pasien</strong></td>
            <td>: {{ $rekamMedis->pasien->nama }}</td>
            <td><strong>Dokter</strong></td>
            <td>: {{ $rekamMedis->dokter->name }}</td>
        </tr>
    </table>

    <div class="box">
        <strong>R / Resep Obat:</strong>
        <p style="white-space: pre-line; font-size: 14px; font-weight: bold; margin-top: 5px;">
            {{ $rekamMedis->resep_obat ?? 'Tidak ada resep obat.' }}
        </p>
    </div>

    <div style="margin-top: 30px; text-align: right;">
        <p>Petugas Apotek / Farmasi</p>
        <br><br>
        <p>( _______________________ )</p>
    </div>
</body>
</html>