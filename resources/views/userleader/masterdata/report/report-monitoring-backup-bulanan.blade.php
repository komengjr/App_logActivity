<!DOCTYPE html>
<html lang="en">

<head>

    <title>Cetak</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css" integrity="sha512-SgaqKKxJDQ/tAUAAXzvxZz33rmn7leYDYfBP+YoMRSENhf3zJyx3SBASt/OfeQwBHA1nxMis7mM3EV/oYT6Fdw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
    table {
        border-collapse: collapse;
    }
</style>
</head>

<body style="padding-top: 25px; padding-left: 0px;">

    <div class="header">
        <div class="absolute-kiri">
            {{-- <img style="padding-top: 0px; margin: 2px; left: 2px; ;" src="icon1.png" width="152"> --}}
            <hr style="padding: 0%; margin: 0%;">
            <p style="font-size: 9px; text-align: center; margin-left: 2px;margin-right: 2px;">Data Cabang</p>
        </div>
        <h5 style="padding-top: 20px; margin: 20px; left: 100px; padding-left: 155px;text-decoration: underline;" >BACKUP DATA BISONE BULANAN</h5>
        {{-- <img style="padding-top: 11px;" src="data:image/png;base64, {!! base64_encode( QrCode::eyeColor(0, 255, 0, 0, 0, 0, 0)->style('round')->eye('circle')->format('svg')->size(107)->errorCorrection('H')->generate(123123),) !!}"> --}}

        <div class="absolute">
            <img style="padding-top: 2px; padding-left: 2px; left: 10px;" src="data:image/png;base64, {!! base64_encode(
                QrCode::style('round')->eye('circle')->format('svg')->size(98)->errorCorrection('H')->generate('qwe'),
            ) !!}">
        </div>
    </div>
    <div class="body">
        <br>
        <h5><span class="badge badge-dark">Date Range : {{$start}} Sampai {{$end}}</span></h5>

        @foreach ($datahandle as $datahandle)
        @php
            $data = DB::table('users_backup_bulanan')->where('kd_cabang',$datahandle->kd_cabang)->whereBetween('tgl_input', [$start,$end])->get();
        @endphp
        <h5>{{$datahandle->nama_cabang}}</h5>
        <table style="font-size: 8px; margin: 0px; padding: 0px; width: 710px; font-size: 11px; font-family: Calibri (Body);" border="1">
            <thead style="font-weight: bold;">
                 <tr>
                     <td class="text-center">No</td>
                     <td class="text-center">Kode Backup</td>
                     <td class="text-center">Bulan Backup</td>
                     <td class="text-center">Tahun Backup</td>
                     <td class="text-center">Deskripsi</td>
                 </tr>

            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($data as $item)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$item->kd_backup_bulanan  }}</td>
                        <td>{{$item->nama_backup_bulanan }}</td>
                        <td>{{$item->tahun_backup_bulanan }}</td>
                        <td>@php
                            echo $item->deskripsi;
                        @endphp</td>
                    </tr>
                @endforeach
            </tbody>
         </table>
        @endforeach
        <br><br><br>

    <div class="footer">
        <table
            style="font-size: 8px; margin: 0px; padding: 0px; width: 710px; font-size: 11px; font-family: Calibri (Body);"
            border="1">
            <tr>

                <td colspan="3" class="text-right"><strong>Nama Cabang , {{date('d - m - Y ')}}</strong></td>
            </tr>
            <tr>
                <td>Mengetahui,</td>
                <td>Pejabat Penilai ,</td>
                <td>Pegawai Yang Dinilai ,</td>
            </tr>
            <tr >
                <td class="text-center" style="padding-top: 15px; padding-bottom: 15px; width: 33%;">
                    {{-- <img style="padding-left: 2px; left: 20px;" src=""> --}}
                    <br><br><br><br><br>


                </td>
                <td class="text-center" style="width: 33%;">
                    <br><br><br><br><br>


                </td>
                <td class="text-center" style="width: 33%;">
                    <br><br><br><br><br>

                </td>
            </tr>

        </table>
    </div>
    </div>


</html>
