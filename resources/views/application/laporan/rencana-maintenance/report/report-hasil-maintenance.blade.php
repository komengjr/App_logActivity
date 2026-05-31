<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Cetak Checklist Pemeliharaan IT</title>
    <style>
        /* Pengaturan Standar Halaman Cetak DomPDF */
        @page {
            margin: 30px 40px;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
            color: #000;
            line-height: 1.4;
        }

        .text-end {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .fw-bold {
            font-weight: bold;
        }

        /* Kode Form Pojok Kanan Atas */
        .form-code {
            font-size: 10px;
            color: #444;
            margin-bottom: 3px;
        }

        /* Kotak Kops Judul Utama */
        .title-box {
            border: 2px solid #000;
            padding: 10px;
            text-align: center;
            font-weight: bold;
            font-size: 13px;
            margin-bottom: 15px;
        }

        /* Informasi Metadata Atas */
        .meta-table {
            width: 100%;
            margin-bottom: 12px;
            font-size: 11px;
        }

        .meta-table td {
            padding: 2px 0;
        }

        /* Struktur Utama Tabel Grid Laporan */
        .main-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }

        .main-table th,
        .main-table td {
            border: 1px solid #000;
            padding: 6px 8px;
            vertical-align: middle;
        }

        .main-table th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 11px;
        }

        .category-row {
            background-color: #e5e5e5;
            font-weight: bold;
        }

        .indent-item {
            padding-left: 20px;
        }

        /* Layout Kolom Tanda Tangan Menggunakan Tabel Standar (Bukan Flexbox) */
        .signature-table {
            width: 100%;
            margin-top: 15px;
        }

        .signature-table td {
            vertical-align: top;
            width: 50%;
        }

        .signature-space {
            height: 75px;
            margin: 5px 0;
        }

        .signature-image {
            height: 65px;
            /* Menyesuaikan ukuran ttd digital di kertas */
            max-width: 180px;
            display: block;
            margin: 0 auto;
        }

        .line-nama {
            border-top: 1px solid #000;
            display: inline-block;
            min-width: 160px;
            font-weight: bold;
            margin-top: 2px;
            padding-top: 2px;
        }
    </style>
</head>

<body>

    <div class="text-end form-code">123.10/04</div>

    <div class="title-box">
        CHECKLIST PEMELIHARAAN SOFTWARE & PERALATAN IT PENDUKUNG BISONE<br>
        LABORATORIUM KLINIK PRAMITA<br>
        CABANG: MATRAMAN
    </div>

    <table class="meta-table">
        <tr>
            <td style="width: 50%;">LOKASI / CABANG : <strong>MATRAMAN</strong></td>
            <td class="text-end" style="width: 50%;">NAMA KOMPUTER : <strong>123</strong></td>
        </tr>
    </table>

    <table class="main-table">
        <thead>
            <tr>
                <th style="width: 45%; text-align: left;">Maintenance Item</th>
                <th style="width: 55%; text-align: left;">Catatan Hasil Tindakan</th>
            </tr>
        </thead>
        <tbody>
            <tr class="category-row">
                <td colspan="2">HARDWARE</td>
            </tr>
            <tr>
                <td class="indent-item">I. CPU (Fan, Processor, Power Supply, Ruang CPU)</td>
                <td>Selesai dibersihkan dari debu, thermal pasta diganti baru, putaran kipas lancar.</td>
            </tr>
            <tr>
                <td class="indent-item">II. KABEL (Kabel LAN, Kabel Power)</td>
                <td>Kondisi fisik kokoh, penguncian RJ45 normal, koneksi stabil.</td>
            </tr>
            <tr>
                <td class="indent-item">III. MONITOR (Fungsi dasar & kecerahan)</td>
                <td>Layar jernih, pengaturan tingkat kecerahan dikalibrasi ulang agar nyaman di mata.</td>
            </tr>
            <tr>
                <td class="indent-item">IV. KEYBOARD & MOUSE (Label & Fungsi)</td>
                <td>Semua tombol keyboard berfungsi empuk dan mouse optik merespons cepat.</td>
            </tr>

            <tr class="category-row">
                <td colspan="2">SOFTWARE</td>
            </tr>
            <tr>
                <td class="indent-item">I. OPERATING SYSTEM (Windows/Linux)</td>
                <td>OS Windows 11 Pro ter-aktivasi resmi, pengecekan registry aman.</td>
            </tr>
            <tr>
                <td class="indent-item">II. SOFTWARE (Office, Adobe Reader, Apps Internal)</td>
                <td>Microsoft Office & Aplikasi internal Bisone diperbarui ke versi stabil teranyar.</td>
            </tr>
            <tr>
                <td class="indent-item">III. VIRUS DAN SEJENISNYA (Update Data Antivirus)</td>
                <td>Proses Full Scan tuntas, database definisi virus terbaru berhasil diunduh.</td>
            </tr>
        </tbody>
    </table>

    <p style="margin-bottom: 25px;">Status Akhir Konfirmasi Manager: <strong>123123</strong></p>

    <table class="signature-table text-center">
        <tr>
            <td>
                <div style="color: #444;">Pelaksana Maintenance,</div>
                <div class="signature-space" style="line-height: 75px; font-weight: bold; color: #1e40af; font-size: 10px;">
                    [ VERIFIED BY IT SYSTEM ]
                </div>
                <div>
                    <span class="line-nama">123</span>
                </div>
                <div style="color: #555; font-size: 10px;">Staff IT Support</div>
            </td>

            <td>
                <div style="color: #444;">Jakarta, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
                <div style="color: #444; margin-top: 2px;">Mengetahui,</div>

                <div class="signature-space">
                    <img src="123" class="signature-image" alt="Tanda Tangan Atasan">
                </div>

                <div>
                    <span class="line-nama">123</span>
                </div>
                <div style="color: #555; font-size: 10px;">123</div>
            </td>
        </tr>
    </table>

</body>

</html>
