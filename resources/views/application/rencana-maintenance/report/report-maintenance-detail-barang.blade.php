<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Pemeliharaan Berkala 6 Bulan Sekali</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #000;
            margin: 20px;
            background-color: #fff;
        }

        .container {
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Header Styling */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .header-table td {
            border: none;
            padding: 5px;
            vertical-align: top;
        }

        .logo-box {
            background-color: #d91d24;
            color: #fff;
            padding: 10px 15px;
            font-weight: bold;
            font-style: italic;
            display: inline-block;
            font-size: 16px;
            border-radius: 2px;
        }

        .logo-subtext {
            font-size: 8px;
            display: block;
            font-style: italic;
            font-weight: normal;
            margin-top: 2px;
        }

        .title-area {
            text-align: center;
            font-weight: bold;
            font-size: 13px;
            line-height: 1.4;
        }

        .doc-number {
            text-align: right;
            font-size: 11px;
        }

        /* Main Schedule Table Styling */
        .schedule-table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            margin-bottom: 15px;
        }

        .schedule-table th,
        .schedule-table td {
            border: 1.5px solid #000;
            padding: 6px 2px;
            font-size: 10px;
        }

        .schedule-table th {
            font-weight: bold;
            background-color: #f5f5f5;
        }

        .text-left {
            text-align: left;
            padding-left: 5px !important;
        }

        .bg-filled {
            background-color: #f3cc9c;
            /* Warna krem penanda jadwal */
        }

        /* Lebar Kolom Utama */
        .col-no {
            width: 3%;
        }

        .col-cabang {
            width: 8%;
        }

        .col-barang {
            width: 15%;
        }

        /* Legend Styling */
        .legend-area {
            margin-top: 15px;
            font-size: 11px;
            display: flex;
            align-items: center;
        }

        .legend-box {
            width: 25px;
            height: 15px;
            border: 1.5px solid #000;
            background-color: #f3cc9c;
            margin-right: 8px;
            display: inline-block;
        }

        /* Signature Area */
        .signature-container {
            margin-top: 40px;
            width: 100%;
            display: flex;
            justify-content: space-around;
            text-align: center;
            font-size: 11px;
        }

        .sig-box {
            width: 30%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 90px;
        }

        .sig-name {
            font-weight: bold;
            text-decoration: underline;
        }

        .sig-title {
            margin-top: 2px;
        }

        .line-underline {
            border-bottom: 1px solid #000;
            width: 150px;
            margin: 0 auto;
        }
    </style>
</head>

<body>

    <div class="container">

        <!-- HEADER SECTION -->
        <table class="header-table">
            <tr>
                <td style="width: 20%;">
                    <div class="logo-box">
                        PRAMITA Lab
                        <!-- <span class="logo-subtext">Mengutamakan Kualitas Diagnosis & Pelayanan</span> -->
                    </div>
                </td>
                <td class="title-area" style="width: 60%;">
                    JADWAL PEMELIHARAAN SOFTWARE & PERALATAN IT PENDUKUNG LIS<br>
                    LABORATORIUM KLINIK PRAMITA<br>
                    CABANG : COBA<br>
                    TAHUN XXXX
                </td>
                <td class="doc-number" style="width: 20%;">
                    SDM.XX-FRM-PP-10/02
                </td>
            </tr>
        </table>

        <!-- MAIN SCHEDULE TABLE -->
        <table class="schedule-table">
            <thead>
                <tr>
                    <th rowspan="2" class="col-no">NO.</th>
                    <th rowspan="2" class="col-cabang">CABANG</th>
                    <th rowspan="2" class="col-barang">NAMA / DETAIL BARANG</th>
                    <th colspan="4">JAN</th>
                    <th colspan="4">FEB</th>
                    <th colspan="4">MAR</th>
                    <th colspan="4">APR</th>
                    <th colspan="4">MEI</th>
                    <th colspan="4">JUN</th>
                    <th colspan="4">JUL</th>
                    <th colspan="4">AGT</th>
                    <th colspan="4">SEP</th>
                    <th colspan="4">OKT</th>
                    <th colspan="4">NOV</th>
                    <th colspan="4">DES</th>
                </tr>
                <tr>
                    <!-- 12 Bulan x 4 Minggu -->
                    <th>I</th>
                    <th>II</th>
                    <th>III</th>
                    <th>IV</th>
                    <th>I</th>
                    <th>II</th>
                    <th>III</th>
                    <th>IV</th>
                    <th>I</th>
                    <th>II</th>
                    <th>III</th>
                    <th>IV</th>
                    <th>I</th>
                    <th>II</th>
                    <th>III</th>
                    <th>IV</th>
                    <th>I</th>
                    <th>II</th>
                    <th>III</th>
                    <th>IV</th>
                    <th>I</th>
                    <th>II</th>
                    <th>III</th>
                    <th>IV</th>
                    <th>I</th>
                    <th>II</th>
                    <th>III</th>
                    <th>IV</th>
                    <th>I</th>
                    <th>II</th>
                    <th>III</th>
                    <th>IV</th>
                    <th>I</th>
                    <th>II</th>
                    <th>III</th>
                    <th>IV</th>
                    <th>I</th>
                    <th>II</th>
                    <th>III</th>
                    <th>IV</th>
                    <th>I</th>
                    <th>II</th>
                    <th>III</th>
                    <th>IV</th>
                    <th>I</th>
                    <th>II</th>
                    <th>III</th>
                    <th>IV</th>
                </tr>
            </thead>
            <tbody>

                <!-- BARANG 1 (Jadwal: JAN & JUL) -->
                <tr>
                    <td rowspan="4">1</td>
                    <td rowspan="4">Pontianak</td>
                    <td class="text-left">Komputer Server LIS</td>
                    <!-- JAN -->
                    <td></td>
                    <td></td>
                    <td class="bg-filled"></td>
                    <td></td>
                    <!-- FEB -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!-- MAR -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!-- APR -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!-- MEI -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!-- JUN -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!-- JUL -->
                    <td></td>
                    <td></td>
                    <td class="bg-filled"></td>
                    <td></td>
                    <!-- AGT -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!-- SEP -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!-- OKT -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!-- NOV -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!-- DES -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <!-- BARANG 2 (Jadwal: FEB & AGT) -->
                <tr>
                    <td class="text-left">PC Client Lab & Monitor</td>
                    <!-- JAN -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!-- FEB -->
                    <td></td>
                    <td class="bg-filled"></td>
                    <td></td>
                    <td></td>
                    <!-- MAR -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!-- APR -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!-- MEI -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!-- JUN -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!-- JUL -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!-- AGT -->
                    <td></td>
                    <td class="bg-filled"></td>
                    <td></td>
                    <td></td>
                    <!-- SEP -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!-- OKT -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!-- NOV -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!-- DES -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <!-- BARANG 3 (Jadwal: MAR & SEP) -->
                <tr>
                    <td class="text-left">Printer Label Barcode</td>
                    <!-- JAN -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!-- FEB -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!-- MAR -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="bg-filled"></td>
                    <!-- APR -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!-- MEI -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!-- JUN -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!-- JUL -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!-- AGT -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!-- SEP -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="bg-filled"></td>
                    <!-- OKT -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!-- NOV -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!-- DES -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <!-- BARANG 4 (Jadwal: APR & OKT) -->
                <tr>
                    <td class="text-left">Perangkat Jaringan (Switch/Router)</td>
                    <!-- JAN -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!-- FEB -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!-- MAR -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!-- APR -->
                    <td class="bg-filled"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!-- MEI -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!-- JUN -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!-- JUL -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!-- AGT -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!-- SEP -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!-- OKT -->
                    <td class="bg-filled"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!-- NOV -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!-- DES -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

            </tbody>
        </table>

        <!-- LEGEND SECTION -->
        <!-- <div class="legend-area">
            <div class="legend-box"></div>
            <span>: diisi tanggal pelaksanaan pemeliharaan peralatan</span>
        </div> -->

        <!-- SIGNATURE SECTION -->
        <div class="signature-container">
            <div class="sig-box">
                <div>Yang melaporkan</div>
                <div>
                    <div class="sig-name">Agus Prasetyo Raharjo</div>
                    <div class="sig-title">IT</div>
                </div>
            </div>
            <div class="sig-box">
                <div>Mengetahui,</div>
                <div>
                    <div class="line-underline"></div>
                    <div class="sig-title">Spv SDM & Umum</div>
                </div>
            </div>
        </div>

    </div>

</body>

</html>
