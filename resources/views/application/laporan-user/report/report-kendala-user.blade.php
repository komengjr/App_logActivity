<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Document Report Purchase Request</title>
    <link rel="stylesheet" href="style.css" media="all" />
</head>
<style>
    @font-face {
        font-family: 'Calibri';
        font-style: normal;
        font-weight: 400;
        src: url(https://fonts.gstatic.com/l/font?kit=J7afnpV-BGlaFfdAhLEY6w&skey=a1029226f80653a8&v=v15) format('woff2');
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
    }

    * {
        font-family: 'Roboto', sans-serif !important;
    }

    .clearfix:after {
        content: "";
        display: table;
        clear: both;
    }

    a {
        color: #0087C3;
        text-decoration: none;
    }

    body {
        position: relative;
        width: 100%;
        height: 100%;
        margin: 0 auto;
        color: #555555;
        background: #FFFFFF;
        font-family: Arial, sans-serif;
        font-size: 14px;
        font-family: SourceSansPro;
    }

    header {
        padding: 10px 0;
        margin-bottom: 20px;
        border-bottom: 1px solid #0b0909;
    }

    #logo {
        float: left;
        margin-top: 8px;
    }

    #logo img {
        height: 70px;
    }

    #company {
        float: right;
        text-align: right;
        color: #0b0909;
    }

    #details {
        padding: 10px;
        border: 1px solid #0b0909;
        border-style: solid solid dashed double;
        margin-bottom: 10px;
    }

    #client {
        padding-left: 6px;
        border-left: 6px solid #db3311;
        float: left;
        font-size: 1.0em;
    }

    #client .to {
        color: #777777;
    }

    h2.name {
        font-size: 1.4em;
        font-weight: normal;
        margin: 0;
    }

    #invoice {
        padding-top: 0;
        float: right;
        text-align: right;
    }

    #invoice span {
        font-size: 1.2rem;
    }

    #invoice h1 {
        color: #db3311;
        font-size: 2.4em;
        /* line-height: 1em; */
        font-weight: normal;
        margin: 0 0 10px 0;
    }

    #invoice .date {
        font-size: 0.5em;
        color: #777777;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        /* margin-bottom: 20px; */
    }

    table th,
    table td {
        padding: 5px;
        /* background: #EEEEEE; */
        text-align: center;
        /* border-bottom: 1px solid #000000; */
    }

    table th {
        white-space: nowrap;
        font-weight: normal;
        background: #01929fff;
        color: white;
    }

    table td {
        text-align: left;
    }

    table td h3 {
        color: #db3311;
        font-size: 1.2em;
        font-weight: normal;
        margin: 0 0 0.2em 0;
    }

    table .no {
        color: #FFFFFF;
        font-size: 1.6em;
        text-align: center;
        background: #db3311;
    }

    table .desc {
        text-align: left;
    }

    table .unit {
        background: #DDDDDD;
    }

    table .qty {
        text-align: center;
    }

    table .total {
        background: #eaebe3;
        color: #ff0404;
    }

    table td.unit,
    table td.qty,
    table td.total {
        font-size: 1.2em;
    }

    table tfoot td {
        /* padding: 10px 20px; */
        background: #FFFFFF;
        /* border-bottom: none; */
        font-size: 0.7em;
        white-space: nowrap;
        /* border-top: 1px solid #AAAAAA; */
    }

    table tfoot tr:last-child td {
        color: #db3311;
        font-size: 0.9em;
        border-top: 1px solid #db3311;
    }

    #thanks {
        font-size: 2em;
        margin-bottom: 50px;
    }

    #notices {
        position: absolute;
        bottom: 0;
        padding-left: 6px;
        border-left: 6px solid #db3311;
    }

    #notices .notice {
        font-size: 0.7em;
    }

    footer {
        color: #777777;
        width: 100%;
        height: 30px;
        position: absolute;
        bottom: 0;
        border-top: 1px solid #AAAAAA;
        padding: 8px 0;
        text-align: center;
    }

    .signature-table {
        width: 100%;
        margin-top: 15px;
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
@php
$bio = DB::table('tbl_biodata')->where('id_user',Auth::user()->id_user)->first();
@endphp

<body>
    <header class="clearfix">
        <div id="logo">
            <img src="data:image/png;base64, {{ $image }}">
        </div>
        <div id="company">
            <div style="margin-top: -20px; font-size: 9px;;">SDM.XX-FRM-PP.10</div><br>
            <h2 class="name">LAPORAN KENDALA USER</h2>
            <div>-</div>
            <div>-</div>
        </div>
        </div>
    </header>
    <main>
        <div id="details" class="clearfix">
            <div id="client">
                <table style="margin: 0px; padding: 0px; font-size: 0.7em;">
                    <tr>
                        <td>Nama Pegawai</td>
                        <td>:</td>
                        <td>{{$bio->nama_lengkap}}</td>
                    </tr>
                    <tr>
                        <td>NIP</td>
                        <td>:</td>
                        <td><strong style="color: red;">{{$bio->nip}}</strong></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>


                        </td>
                    </tr>

                </table>
            </div>
            <div id="invoice">
                <span style="font-size: 1em;color: #1ac300ff;"><strong>Laporan Perbaikan Software dan Hardware</strong></span>
                {{-- <div class="date" style="color: red; font-size: 12px;">Print By : {{ Auth::user()->fullname }}
            </div> --}}
            <div class="date" style="color: #0087C3">{{ date('d-m-Y H-i-s') }}</div><br>

        </div>
        </div>

        <!-- Hasil -->
        <h5><span class="badge badge-dark">Date Range : {{$start}} Sampai {{$end}}</span></h5>

        @foreach ($datahandle as $datahandle)
        @php
        $data = DB::table('tbl_laporan_user')
        ->where('kd_cabang', $datahandle->kd_cabang)
        ->whereBetween('tgl_laporan', [$start, $end])
        ->get();
        @endphp
        <h5>{{ $datahandle->nama_cabang }}</h5>
        <table style="font-size: 8px; margin: 0px; padding: 0px; width: 100%; font-size: 11px; font-family: Calibri (Body);"
            border="1">
            <thead style="font-weight: bold;">
                <tr>
                    <td class="text-center">No</td>
                    <td class="text-center">Tiket Laporan</td>
                    <td class="text-center">Nama Pelapor</td>
                    <td class="text-center">Kategori Laporan</td>
                    <td class="text-center">Deskripsi Masalah</td>
                    <td class="text-center">Tanggal Laporan</td>
                    <td class="text-center">Terima Laporan</td>
                    <td class="text-center">Tindakan Perbaikan</td>
                    <td class="text-center">Selesai Laporan</td>
                    <td class="text-center">Di Bawah 5 Menit</td>
                    <td class="text-center">Status Laporan</td>
                </tr>
            </thead>
            <tbody>
                @php
                $no = 1;
                @endphp
                @foreach ($data as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item->tiket_laporan }}</td>
                    <td>{{ $item->nama_user }}</td>
                    <td>
                        @if ($item->kategori_laporan == 'ER-001')
                        Software
                        @else
                        Hardware
                        @endif
                    </td>
                    <td>
                        @php
                        echo $item->deskripsi_laporan;
                        @endphp
                    </td>
                    <td>{{ $item->tgl_laporan }}</td>
                    <td>{{ $item->tgl_respon_laporan }}</td>
                    <td>
                        @php
                        $penyelesaian = DB::table('tbl_laporan_user_log')->where('tiket_laporan',$item->tiket_laporan)->first();
                        @endphp
                        @if ($penyelesaian)
                        @php
                        echo $penyelesaian->deskripsi_penyelesaian;
                        @endphp
                        @endif
                    </td>
                    <td>{{ $item->tgl_selesai_laporan }}</td>
                    <td><span class="badge bg-success">
                            @php
                            $dari = date_create($item->tgl_respon_laporan);
                            $sampai = date_create($item->tgl_selesai_laporan);
                            $diff = date_diff($dari, $sampai);
                            echo $diff->format(' %H:%i:%s');
                            @endphp

                            {{-- {{$datamenit}} --}}
                        </span>
                    </td>
                    <td>
                        @if ($item->status_laporan == 2)
                        Selesai
                        @else
                        Belum Selesai
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endforeach

        <table class="signature-table text-center">
            <tr>
                <td>
                    <div style="color: #444;">Pelaksana,</div>
                    <div class="signature-space" style="line-height: 75px; font-weight: bold; color: #1e40af; font-size: 10px;">
                        <!-- [ VERIFIED BY IT SYSTEM ] -->
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <div>
                        <span class="line-nama"></span>
                    </div>
                    <div style="color: #555; font-size: 10px;">Staff IT Support</div>
                </td>

                <td>
                    <div style="color: #444;">Mengetahui, , {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
                    <div style="color: #444; margin-top: 2px;">Manager SDM & UMMUM,</div>

                    <div class="signature-space">

                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <div>
                        <span class="line-nama"></span>
                    </div>
                    <div style="color: #555; font-size: 10px;">-</div>
                </td>

            </tr>
        </table>
        {{-- <div id="thanks">Thank you!</div> --}}
        <div id="notices">
            <img style="padding-top: 1px; left: 10px;"
                src="data:image/png;base64, {!! base64_encode(QrCode::style('round')->eye('circle')->format('svg')->size(30)->errorCorrection('H')->generate(123), ) !!}">
            <div class="notice">Notes: We really appreciate your business and if there’s anything else we can do, please
                let us know!</div>
        </div>
    </main>
</body>

</html>
