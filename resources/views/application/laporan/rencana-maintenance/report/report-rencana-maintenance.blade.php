<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Pemeliharaan </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;

        }

        .table-container {
            background-color: #ffffff;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }

        .form-code {
            font-size: 11px;
            text-align: right;
        }

        .main-header {
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
            line-height: 1.2;
            font-size: 14px;
        }

        table th,
        table td {
            text-align: center;
            vertical-align: middle;
            border: 1px solid #000000 !important;
            /* padding: 4px !important; */
        }

        .bg-orange {
            background-color: #fbc490 !important;
        }

        .bg-item-header {
            background-color: #f1f3f5 !important;
            font-weight: bold;
        }

        .legend-box {
            width: 40px;
            height: 20px;
            display: inline-block;
            border: 1px solid #000;
            vertical-align: middle;
        }

        .signature-section {
            margin-top: 40px;
            font-size: 12px;
        }

        .signature-role {
            margin-top: 60px;
            text-decoration: underline;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="form-code">SDM-03-FRM-PP10/03</div>

    <div class="main-header text-uppercase">
        JADWAL PEMELIHARAAN SOFTWARE & PERALATAN IT PENDUKUNG LIS<br>
        LABORATORIUM KLINIK PRAMITA<br>
        TAHUN {{ $tahun }}
    </div>


    <table class="table table-bordered" style="width: 100%;">
        <thead class="table-light">
            <tr>
                <th>NO.</th>
                <th>CABANG</th>
                <th>PELAKSANA</th>
                @foreach ($bulan as $bulans)
                <th>{{ $bulans->m_rencana_detail_bulan }}</th>
                @endforeach
            </tr>

        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>CABANG</td>
                <td>{{ $bio->nama_lengkap }}</td>
                @foreach ($bulan as $bulans)
                @php
                $brg = DB::table('m_rencana_detail')
                ->where('m_rencana_data_code',$bulans->m_rencana_data_code)
                ->where('m_rencana_detail_bulan',$bulans->m_rencana_detail_bulan)
                ->get();
                @endphp
                <td style="text-align: left;vertical-align: top; font-size: 7px;">

                    @foreach ($brg as $brgs)
                    <li style="margin-left: 10px;">{{ $brgs->m_rencana_detail_nama_brg }}</li>
                    @endforeach

                </td>
                @endforeach
            </tr>

        </tbody>
    </table>



    <div class="row signature-section">
        <div class="col-md-5 align-self-start">
            <div class="d-flex align-items-center gap-2">
                <div class="legend-box bg-orange"></div>
                <div>: diisi tanggal pelaksanaan pemeliharaan peralatan</div>
            </div>
        </div>
    </div>
    <table style="width: 100%;">
        <tbody>

            <tr>
                <td>
                    <div class="col-md-3 text-center offset-md-1">
                        <div>Yang melaporkan,</div>
                        <div class="signature-role">{{ $bio->nama_lengkap }}</div>
                        <div>IT</div>
                    </div>
                </td>
                <td>

                    <div class="col-md-3 text-center">
                        <div>Mengetahui,</div>
                        <div class="signature-role">Dhani Nugraha</div>
                        <div>Kepala Cabang</div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
