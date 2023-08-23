<!DOCTYPE html>
<html lang="en">

<head>

    <title>Cetak</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css"
        integrity="sha512-SgaqKKxJDQ/tAUAAXzvxZz33rmn7leYDYfBP+YoMRSENhf3zJyx3SBASt/OfeQwBHA1nxMis7mM3EV/oYT6Fdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"
        integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
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
        width: 710px;
        height: 106px;
        border: 0.2px solid #000000;
    }

    div.body {
        position: relative;
        left: 20px;
        width: 710px;
        height: 920px;
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

    table tr td p {

        padding: 0px;
        margin: 0px;
        font-weight: bold;
    }

    div.footer {
        position: fixed;
        left: 0;
        bottom: 20px;
        border: 0px solid #302a2a;
        font-size: 15px;
    }
</style>
</head>

<body style="padding-top: 25px; padding-left: 0px;">

    <div class="header">
        <div class="absolute-kiri">
            <img style="padding-top: 0px; margin: 2px; left: 2px; ;" src="icon1.png" width="152">
            <hr style="padding: 0%; margin: 0%;">
            <p style="font-size: 9px; text-align: center; margin-left: 2px;margin-right: 2px;">qwert</p>
        </div>
        <h5 style="padding-top: 20px; margin: 20px; left: 200px; padding-left: 255px;text-decoration: underline;">SURAT
            TUGAS IT</h5>
        {{-- <img style="padding-top: 11px;" src="data:image/png;base64, {!! base64_encode( QrCode::eyeColor(0, 255, 0, 0, 0, 0, 0)->style('round')->eye('circle')->format('svg')->size(107)->errorCorrection('H')->generate(123123),) !!}"> --}}

        <div class="absolute">
            <img style="padding-top: 1px; left: 10px;" src="data:image/png;base64, {!! base64_encode(
                QrCode::eyeColor(0, 0, 111, 115, 255, 114, 232)->style('dot')->eye('circle')->format('svg')->size(101)->errorCorrection('H')->generate('qwe'),
            ) !!}">
        </div>
    </div>
    <div class="body">
        <br>
        <table
            style="font-size: 8px; margin: 0px; padding: 0px; width: 710px; font-size: 11px; font-family: Calibri (Body);"
            border="0">
            <tr>
                <td colspan="4" class="text-right"><strong>SDM.33-FRM-PP-07.2/02 </strong></td>
            </tr>
            <tr>
                <td colspan="3">
                    <p style="text-decoration: underline;">FORM TUGAS :</p>
                </td>
                <td rowspan="4" class="text-right">

                </td>
            </tr>
            <tr>
                <td style="width: 150px;">Nama Pegawai</td>
                <td style="width: 5px;">:</td>
                <td style="width: 440px;">{{$data->nama_lengkap}}</td>

            </tr>
            <tr>
                <td style="width: 150px;">NIP Pegawai</td>
                <td style="width: 5px;">:</td>
                <td>{{$data->nip}}</td>

            </tr>
            <tr>
                <td>Kinerja</td>
                <td style="width: 5px;">:</td>
                <td>{{ $data->kinerja }}</td>

            </tr>
            <tr>
                <td>Tanggal Mulai</td>
                <td style="width: 5px;">:</td>
                <td>{{ $data->tgl_start }}</td>

            </tr>
            <tr>
                <td>Tanggal Berakhir</td>
                <td style="width: 5px;">:</td>
                <td>{{ $data->tgl_end }}</td>

            </tr>

        </table>
        <br>
        <table
            style="font-size: 8px; margin: 0px; padding: 0px; width: 710px; font-size: 11px; font-family: Calibri (Body);"
            border="1">
            <thead style="font-weight: bold;">
                <tr>
                    <td>Deskripsi Tugas</td>
                </tr>

            </thead>
            <tbody>
                <tr>
                    <td>
                        @php
                            echo $data->deskripsi_task;
                        @endphp
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        <table
            style="font-size: 8px; margin: 0px; padding: 0px; width: 710px; font-size: 11px; font-family: Calibri (Body);"
            border="1">
            <thead style="font-weight: bold;">
                <tr>
                    <td>Penyelesaian Tugas</td>
                </tr>

            </thead>
            <tbody>
                <tr>
                    <td>
                        @php
                            $log = DB::table('tbl_tiket_task_log')->where('kd_tiket_task',$data->kd_tiket_task)->first();
                            echo $log->deskripsi_task_log;
                        @endphp
                    </td>
                </tr>
            </tbody>
        </table>
        <br><br><br>

        <div class="footer">
            <table
                style="font-size: 8px; margin: 0px; padding: 0px; width: 710px; font-size: 11px; font-family: Calibri (Body);"
                border="1">
                <tr>

                    <td colspan="3" class="text-right"><strong>Pontianak , {{ date('d - m - Y ') }}</strong></td>
                </tr>
                <tr>
                    <td>Pemberi Tugas ,</td>
                    <td>User Terkait ,</td>
                    <td>Yang Memverifikasi ,</td>
                </tr>
                <tr>
                    <td class="text-center" style="padding-top: 15px; padding-bottom: 15px; width: 33%;">
                        {{-- <img style="padding-left: 2px; left: 20px;" src=""> --}}
                        <br><br><br><br><br>
                        @php
                            $userleader = DB::table('users')->where('id_user',$data->id_leader)->first();
                        @endphp
                        {{$userleader->name}}

                    </td>
                    <td class="text-center" style="width: 33%;">
                        <br><br><br><br><br>
                        {{$data->nama_lengkap}}

                    </td>
                    <td class="text-center" style="width: 33%;">
                        <br><br><br><br><br>
                        {{$data->name}}
                    </td>
                </tr>

            </table>
        </div>
    </div>


</html>
