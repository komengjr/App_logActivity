@extends('layouts.base')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header mb-3">
                            <div class="row">
                                <div class="col-lg-8">
                                    <h5><span class="badge badge-dark">Log Bisone</span></h5>
                                </div>
                                <div class="col-lg-4">

                                    <div class="btn-toolbar" role="toolbar" style="justify-content: right;">
                                        <div class="btn-group">
                                            <button type="button"
                                                class="btn btn-outline-primary waves-effect waves-light dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false">
                                                More
                                                <span class="caret"></span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a href="javaScript:void();" class="dropdown-item" data-toggle="modal"
                                                    data-target="#modal-monitoring-log-bisone"
                                                    id="button-cetak-log-bisone"><i class="zmdi zmdi-tasks"></i> Cetak
                                                    Laporan Log</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table id="example1" class="styled-table table-striped table-bordered"
                            style="width:100%; text-align: left;" border="1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>logDate</th>
                                    <th>logType</th>
                                    <th>logBranchCode</th>
                                    <th>logMessage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $data)
                                    <tr>
                                        <td>{{ $data->logID }}</td>
                                        <td>{{ $data->logDate }}</td>
                                        <td>{{ $data->logType }}</td>
                                        <td>{{ $data->logBranchCode }}</td>
                                        <td>
                                            @php
                                                $data = str_replace('UP', '<br>UP', $data->logMessage);
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


                        <div class="card-footer text-center bg-transparent border-0">
                            {{-- <a href="javascript:void();">View all listings</a> --}}
                        </div>

                    </div>
                </div>

            </div><!--End Row-->
            <!--start overlay-->
            <div class="overlay toggle-menu"></div>
            <!--end overlay-->
            <div id="loading"></div>
        </div>
        <!-- End container-fluid-->

    </div>
    <div class="modal fade" id="modal-monitoring-log-bisone">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content border-danger" id="menu-monitoring-log-bisone">

                gfd

            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var table = $('#example1').DataTable({
                lengthChange: false,
                // buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
            });

            table.buttons().container()
                .appendTo('#example_wrapper .col-md-6:eq(0)');

        });
    </script>
    <script>
        $(document).on("click", "#button-cetak-log-bisone", function(e) {
            e.preventDefault();
            // $("#menu-monitoring-log-bisone").html(123);
            $.ajax({
                    url: "{{route('show-menu-cetak-log')}}",
                    type: "POST",
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    dataType: "html",
                }).done(function(data) {
                    $("#menu-monitoring-log-bisone").html(data);
                }).fail(function() {
                    Lobibox.notify("error", {
                        pauseDelayOnHover: true,
                        icon: "fa fa-info-circle",
                        continueDelayOnInactiveTab: false,
                        position: "center top",
                        showClass: "bounceIn",
                        hideClass: "bounceOut",
                        sound: false,
                        width: 400,
                        msg: "Hubungi Administrator Jika terjadi Eror",
                    });
                });
        });
    </script>
    <script>
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
