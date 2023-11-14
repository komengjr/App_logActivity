
<style>
    /* @import url('https://fonts.googleapis.com/css2?family=Russo+One&display=swap'); */

    /* General */


    @page {
        margin-left: 25px;
        margin-top: 5px;
        font-family: Calibri (Body);

    }
</style>
<style>
    div.header {
        position: relative;
        left: 20px;
        width: 100%;
        height: 106px;
        border: 0.2px solid #000000;
    }

    div.body {
        position: relative;
        left: 20px;
        width: 100%;
        height: 700px;
        border: 0px solid #302a2a;
        font-size: 15px;
    }

    div.absolute {
        position: absolute;
        top: 0px;
        right: 0;
        width: 101px;
        height: 104px;
        border: 1px solid #252424;
    }
    div.absolute-kiri {
        position: absolute;
        top: 0px;
        left: 0;
        width: 156px;
        height: 104px;
        border: 1px solid #252424;
    }

    table tr td {

        padding: 10px;
        margin: 5px;
        font-weight: bold;
    }
    div.footer {
        position: fixed;
        left: 0;
        bottom: 20px;
        border: 0px solid #302a2a;
        font-size: 15px;
    }
    table {
        border-collapse: collapse;
    }
</style>
</head>

<body style="padding-top: 25px; padding-left: 0px;">

    <div class="header">
        <div class="absolute-kiri">
            {{-- <img style="padding-top: 0px; margin: 2px; left: 2px; ;" src="data:image/png;base64, {{$image}}" width="152"> --}}
            <hr style="padding: 0%; margin: 0%;">
            <p style="font-size: 9px; text-align: center; margin-left: 2px;margin-right: 2px;">PT PRAMITA</p>
        </div>
        <h5 style="padding-top: 20px; margin: 20px; left: 100px; padding-left: 155px;text-decoration: underline;" >LAPORAN PENGUJIAN FASILITAS SARANA DAN PRASARANA KRITIS</h5>
        {{-- <img style="padding-top: 11px;" src="data:image/png;base64, {!! base64_encode( QrCode::eyeColor(0, 255, 0, 0, 0, 0, 0)->style('round')->eye('circle')->format('svg')->size(107)->errorCorrection('H')->generate(123123),) !!}"> --}}

        <div class="absolute">
            <img style="padding-top: 1px; left: 10px;" src="data:image/png;base64, {!! base64_encode(
                QrCode::eyeColor(0, 0, 111, 115, 255, 114, 232)->style('dot')->eye('circle')->format('svg')->size(101)->errorCorrection('H')->generate('qwe'),
            ) !!}">
        </div>
    </div>
    <div class="body">
        <br>
        <table style="font-size: 8px;  width: 100%; font-size: 11px; font-family: Calibri (Body);" border="0">
            <tr>
                <td style="width: 150px;">Nama Pegawai</td>
                <td style="width: 5px;">:</td>
                <td style="width: 440px;">Agus Prasetyo Raharjo</td>
            </tr>
            <tr>
                <td style="width: 150px;">NIP Pegawai</td>
                <td style="width: 5px;">:</td>
                <td>33.2131.1231</td>

            </tr>


        </table>
        <br>
        @foreach ($hendlecabang as $hendlecabang)
        <br>
        Cabang : {{$hendlecabang->nama_cabang}}

        <table style="font-size: 8px; margin: 0px; padding: 0px; width:100%; font-size: 11px; font-family: Calibri (Body);" border="1">
            <tbody>
                <thead>
                    <tr>
                        <th rowspan="2" style="width: 2%;">No</th>
                        <th rowspan="2" style="width: 10%; margin: 10px; padding: 10px;">Jenis Alat/Fasilitas</th>
                        <th colspan="{{count($harimasuk)}}">Hasil Pengukuran</th>
                    </tr>
                    <tr>
                        @foreach ($harimasuk as $datamasuk)
                            <th style="padding: 2px; font-size: 7px;">{{date('d/m/Y', $datamasuk)}}</th>
                        @endforeach
                    </tr>
                </thead>
                @php
                    $no = 1;
                @endphp
                @foreach ($dataharian as $item)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$item->kinerja_sub}}</td>
                    @foreach ($harimasuk as $datamasuk1)
                        @php
                            $cekdata = DB::table('users_handler_record_log')
                            ->where('kd_kinerja_sub',$item->kd_kinerja_sub)
                            ->where('kd_cabang',$hendlecabang->kd_cabang)
                            ->where('tgl_record',date('Y-m-d', $datamasuk1))->first();
                        @endphp
                        @if ($cekdata)
                            <td style="text-align: center;font-size: 12px;">{{$cekdata->ket_kinerja_sub}}</td>
                        @else
                            <td></td>
                        @endif

                    @endforeach

                </tr>
                @endforeach
            </tbody>
        </table>
        @endforeach

    <div class="footer">

        <table style="font-size: 8px; margin-top: 30px; padding-top: 10px; width:1515px;  font-size: 11px; font-family: Calibri (Body);" border="0">
            <tr>

                <td colspan="3" class="text-right"><strong>Pontianak , {{date('d - m - Y ')}}</strong></td>
            </tr>
            <tr>
                <td>Mengetahui,</td>
                <td>Pejabat Penilai ,</td>
                <td>Pegawai Yang Dinilai ,</td>
            </tr>
            <tr >
                <td class="text-center" style="width: 33%;">
                    {{-- <img style="padding-left: 2px; left: 20px;" src=""> --}}
                    <br><br>
                    Agus Prasetyo Raharjo

                </td>
                <td class="text-center" style="width: 33%;">
                    <br><br>

                    Agus Prasetyo Raharjo
                </td>
                <td class="text-center" style="width: 33%;">
                    <br><br>
                    Agus Prasetyo Raharjo
                </td>
            </tr>

        </table>
    </div>
    </div>



