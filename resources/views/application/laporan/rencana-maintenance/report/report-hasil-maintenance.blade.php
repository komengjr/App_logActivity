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
    @if ($cabang->kd_entitas_cabang == 'PTP')

    @else

    @endif
    <div class="text-end form-code">SDM.XX-FRM-PP.10/04</div>

    <div class="title-box">
        CHECKLIST PEMELIHARAAN SOFTWARE & PERALATAN IT PENDUKUNG BISONE<br>
        LABORATORIUM KLINIK
        @if ($cabang->kd_entitas_cabang == 'PTP')
            PRAMITA
        @else
            SIMA
        @endif
        <br>
        CABANG: {{ $cabang->nama_cabang }}
    </div>

    <table class="meta-table">
        <tr>
            <td style="width: 50%;">LOKASI / CABANG : <strong>{{ $cabang->m_rencana_log_loc }}</strong></td>
            <td class="text-end" style="width: 50%;">NAMA KOMPUTER : <strong>{{ $cabang->m_rencana_detail_nama_brg }}</strong></td>
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
            @foreach ($log as $logs)
            @if ($logs->m_rencana_log_detail_cat == "Hardware")
            <tr>
                <td class="indent-item">I. {{ $logs->m_rencana_log_detail_sub }}</td>
                <td>{{ $logs->m_rencana_log_detail_desc }}</td>
            </tr>
            @endif
            @endforeach


            <tr class="category-row">
                <td colspan="2">SOFTWARE</td>
            </tr>
            @foreach ($log as $logs)
            @if ($logs->m_rencana_log_detail_cat == "Software")
            <tr>
                <td class="indent-item">I. {{ $logs->m_rencana_log_detail_sub }}</td>
                <td>{{ $logs->m_rencana_log_detail_desc }}</td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>

    <p style="margin-bottom: 25px;">Status Akhir Konfirmasi Manager: <strong>-</strong></p>

    <table class="signature-table text-center">
        <tr>
            <td>
                <div style="color: #444;">Pelaksana Maintenance,</div>
                <div class="signature-space" style="line-height: 75px; font-weight: bold; color: #1e40af; font-size: 10px;">
                    [ VERIFIED BY IT SYSTEM ]
                </div>
                <div>
                    <span class="line-nama">{{ $cabang->name }}</span>
                </div>
                <div style="color: #555; font-size: 10px;">Staff IT Support</div>
            </td>

            <td>
                <div style="color: #444;">{{ $cabang->city }}, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
                <div style="color: #444; margin-top: 2px;">Bagian,</div>

                <div class="signature-space">
                    <img src="{{ $cabang->m_rencana_detail_sign }}" class="signature-image" alt="Tanda Tangan Atasan">
                </div>

                <div>
                    <span class="line-nama">{{ $cabang->m_rencana_detail_verif }}</span>
                </div>
                <div style="color: #555; font-size: 10px;">-</div>
            </td>
        </tr>
    </table>

</body>

</html>
