<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Times New Roman', Times, serif, Arial, sans-serif;
            color: #000;
            background-color: #fff;
        }

        .table-container {
            background-color: #ffffff;
            padding: 10px;
            max-width: 100%;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #444444 !important;
            text-align: center;
            vertical-align: middle;
            padding: 3px 4px;
            font-size: 10px;
        }

        .bg-yellow {
            background-color: #ffff00 !important;
        }

        .bg-blue {
            background-color: #1900ff !important;
        }

        .bg-green {
            background-color: #00ff88 !important;
            color: #ffffff !important;
        }

        .text-header {
            font-weight: bold;
            text-align: center;
            margin-bottom: 15px;
            line-height: 1.2;
        }

        .text-header h5 {
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 4px;
        }

        .doc-number {
            text-align: right;
            font-size: 10px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .signature-section {
            margin-top: 25px;
            font-size: 11px;
        }

        .signature-title {
            margin-bottom: 50px;
        }

        .signature-name {
            text-decoration: underline;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="table-container mx-auto">

        <div class="doc-number">SDM-33-FRM-PP10/03</div>

        <div class="text-header text-uppercase">
            <h5>JADWAL PEMELIHARAAN SOFTWARE & PERALATAN IT PENDUKUNG LIS</h5>
            <h5>LABORATORIUM KLINIK PRAMITA</h5>
            <h5>TAHUN {{ $tahun }}</h5>
        </div>

        <!-- SEMESTER 1: JAN - JUN -->
        <div class="table-responsive mb-3">
            <table class="table table-bordered table-sm m-0" style="width: 100%;">
                <thead class="table-light">
                    <tr>
                        <th rowspan="2" style="width: 35px;">NO.</th>
                        <th rowspan="2" style="width: 160px;">CABANG</th>
                        <th rowspan="2" style="width: 100px;">PELAKSANA</th>
                        @foreach(['JAN', 'FEB', 'MAR', 'APR', 'MEI', 'JUN'] as $bln)
                        <th colspan="4">{{ $bln }} {{ $tahun }}</th>
                        @endforeach
                    </tr>
                    <tr>
                        @for($i = 0; $i < 6; $i++)
                            <td>I</td>
                            <td>II</td>
                            <td>III</td>
                            <td>IV</td>
                            @endfor
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach($dataSemester1 as $row)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <!-- Menggunakan nama_cabang dari join tbl_cabang -->
                        <td class="text-start">{{ $row->nama_cabang ?? '-' }}</td>
                        <td class="text-start">
                            @php
                            $namauser = DB::table('tbl_biodata')->where('id_user',$row->m_rencana_data_user)->first();
                            @endphp
                            @if ($namauser)
                            {{ $namauser->nama_lengkap }}
                            @endif
                        </td>
                        @php
                        $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'];
                        $weeks = ['1', '2', '3', '4'];
                        @endphp
                        @foreach($months as $m)
                        @foreach($weeks as $w)
                        @php
                        $detail = $row->details->where('m_rencana_detail_bulan', $m)
                        ->where('m_rencana_detail_minggu', $w)
                        ->first();

                        $bgClass = 'bg-yellow';
                        if($detail) {
                        if($detail->m_rencana_detail_status == 0) {
                        $bgClass = 'bg-green';
                        } elseif($detail->m_rencana_detail_status == 1) {
                        $bgClass = 'bg-blue';
                        }
                        }
                        @endphp
                        <td class="{{ $bgClass }}">
                            {{ $detail ? ($detail->m_rencana_detail_verif ?? '') : '' }}
                        </td>
                        @endforeach
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- SEMESTER 2: JUL - DES -->
        <div class="table-responsive mb-3">
            <table class="table table-bordered table-sm m-0" style="width: 100%;">
                <thead class="table-light">
                    <tr>
                        <th rowspan="2" style="width: 35px;">NO.</th>
                        <th rowspan="2" style="width: 160px;">CABANG</th>
                        <th rowspan="2" style="width: 100px;">PELAKSANA</th>
                        @foreach(['JUL', 'AGT', 'SEP', 'OKT', 'NOV', 'DES'] as $bln)
                        <th colspan="4">{{ $bln }} {{ $tahun }}</th>
                        @endforeach
                    </tr>
                    <tr>
                        @for($i = 0; $i < 6; $i++)
                            <td>I</td>
                            <td>II</td>
                            <td>III</td>
                            <td>IV</td>
                            @endfor
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach($dataSemester2 as $row)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <!-- Menggunakan nama_cabang dari join tbl_cabang -->
                        <td class="text-start">{{ $row->nama_cabang ?? '-' }}</td>
                        <td class="text-start">
                            @if ($namauser)
                            {{ $namauser->nama_lengkap }}
                            @endif
                        </td>
                        @php
                        $months = ['JUL', 'AGT', 'SEP', 'OKT', 'NOV', 'DES'];
                        $weeks = ['1', '2', '3', '4'];
                        @endphp
                        @foreach($months as $m)
                        @foreach($weeks as $w)
                        @php
                        $detail = $row->details->where('m_rencana_detail_bulan', $m)
                        ->where('m_rencana_detail_minggu', $w)
                        ->first();

                        if($detail) {
                        if($detail->m_rencana_detail_status == 0) {
                        $bgClass = 'bg-green';
                        } elseif($detail->m_rencana_detail_status == 1) {
                        $bgClass = 'bg-blue';
                        }
                        }
                        @endphp
                        <td class="{{ $bgClass }}">
                            {{ $detail ? ($detail->m_rencana_detail_verif ?? '') : '' }}
                        </td>
                        @endforeach
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- SIGNATURE SECTION -->
        <div class="signature-section row text-center">
            <table style="width: 100%;">
                <tr>
                    <td>
                        <div class="col-4 offset-2">
                            <div class="signature-title">Yang melaporkan</div>
                            @if(isset($pelaksanaSign) && $pelaksanaSign)
                            <div style="height: 40px;"><img src="{{ $pelaksanaSign }}" style="max-height: 35px;" alt="Sign"></div>
                            @else
                            <div style="height: 40px;"></div>
                            @endif
                            <div class="signature-name">
                                @if ($namauser)
                                {{ $namauser->nama_lengkap }}
                                @endif
                            </div>
                            <div>IT</div>
                        </div>
                    </td>
                    <td>
                        <div class="col-4 offset-2">
                            <div class="signature-title">Mengetahui, {{ date('d-m-Y') }}</div>
                            <div style="height: 40px;"></div>
                            <div class="signature-name"></div>
                            <div>Kepala Cabang</div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
