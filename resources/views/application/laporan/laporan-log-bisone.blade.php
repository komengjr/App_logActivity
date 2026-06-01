@extends('layouts.template')
@section('base.css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.4/css/responsive.bootstrap5.css">
@endsection
@section('content')
<div class="card">
    <div class="card-header bg-primary">
        <div class="d-flex justify-content-between">
            <div>
                <a class="btn btn-dark btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#modal-laporan" id="button-print-log-bisone">
                    <span class="fas fa-printer me-2"></span> Print Log Bisone
                </a>
                <!-- <span class="mx-1 mx-sm-2 text-300">|</span>
                <button class="btn btn-falcon-default btn-sm" type="button" data-bs-toggle="tooltip"
                    data-bs-placement="top" title="" data-bs-original-title="Archive" aria-label="Archive"><span
                        class="fas fa-print"></span></button> -->

            </div>
            <div class="d-flex">

            </div>
        </div>
    </div>
    <div class="card-body">
        <table id="example" class="table table-striped" style="width:100%">
            <thead class="bg-300 fs--1">
                <tr>
                    <th>No</th>
                    <th>logDate</th>
                    <th>logType</th>
                    <th>logBranchCode</th>
                    <th>logMessage</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $datas)
                <tr>
                    <td>{{ $datas->logID }}</td>
                    <td>{{ $datas->logDate }}</td>
                    <td>{{ $datas->logType }}</td>
                    <td>{{ $datas->logBranchCode }}</td>
                    <td class="fs--2">
                        @php
                        $data = str_replace('UP', '<br>UP', $datas->logMessage);
                        $data1 = str_replace('Service :', '<br>Service :', $data);
                        $data2 = str_replace('Pacs', '<br>Pacs', $data1);
                        $data3 = str_replace('Web Server', '<br>Web Server', $data2);
                        $data4 = str_replace('Report Server', '<br>Report Server', $data3);
                        $data5 = str_replace('MariaDB Server', '<br>MariaDB Server', $data4);
                        $data6 = str_replace('----------', '<br>----------', $data5);
                        $data7 = str_replace('Resource :', '<br>Resource :', $data6);
                        $data8 = str_replace('folder', '<br>folder', $data7);
                        $data9 = str_replace('Connectivity:', '<br>Connectivity:<br>', $data8);
                        echo $data9;
                        @endphp
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <div class="card-footer text-center bg-transparent border-0">
        {{-- <a href="javascript:void();">View all listings</a> --}}
    </div>

</div>
@endsection
@section('base.js')
<div class="modal fade" id="modal-laporan" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content border-0">
            <div class="position-absolute top-0 end-0 mt-3 me-3 z-index-1">
                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="menu-laporan"></div>
        </div>
    </div>
</div>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.4/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.4/js/responsive.bootstrap5.js"></script>
<script>
    new DataTable('#example', {
        responsive: true
    });
</script>
<script>
    $(document).on("click", "#button-print-log-bisone", function(e) {
        e.preventDefault();
        // var code = $(this).data("code");
        $('#menu-laporan').html(
            '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        $.ajax({
            url: "{{ route('laporan_log_bisone_print') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "code": 123
            },
            dataType: 'html',
        }).done(function(data) {
            $('#menu-laporan').html(data);
        }).fail(function() {
            $('#menu-laporan').html('eror');
        });
    });
    $(document).on("click", "#button-privew-monitoring-log-bisone", function(e) {
        e.preventDefault();
        var data = $("#form-monitoring-log-bisone").serialize();
        $("#show-monitoring-log-bisone").html(
            '<div style="text-align: center; padding:2%;"><div class="spinner-border" role="status" > <span class="sr-only">Loading...</span> </div></div>'
        );
        $.ajax({
            url: "{{route('post-menu-cetak-log')}}",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf"]').attr("content"),
            },
            type: "POST",
            data: data,
            dataType: "html",
        }).done(function(datapdf) {
            $("#show-monitoring-log-bisone").html(
                '<iframe src="data:application/pdf;base64, ' +
                datapdf +
                '" style="width:100%;; height:500px;" frameborder="0"></iframe>'
            );
        }).fail(function() {
            // console.log(data);
            $("#show-monitoring-log-bisone").html("Gagal Baca");
        });
    });
</script>
@endsection
