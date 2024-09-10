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
                                                data-target="#modal-monitoring-telegram" id="button-no-telegram"><i
                                                    class="zmdi zmdi-format-list-numbered"></i> No
                                                Terdaftar</a>
                                            <a href="javaScript:void();" class="dropdown-item" data-toggle="modal"
                                                data-target="#modal-monitoring-telegram" id="button-log-telegram"><i
                                                    class="zmdi zmdi-tv-list"></i> Cek
                                                Log Update
                                                Telegram</a>
                                            <a href="javaScript:void();" class="dropdown-item" data-toggle="modal"
                                                data-target="#modal-monitoring-telegram"
                                                id="button-all-laporan-telegram"><i class="zmdi zmdi-view-list"></i>
                                                Semua Laporan User</a>
                                            <div class="dropdown-divider"></div>
                                            <a href="javaScript:void();" class="dropdown-item"data-toggle="modal"
                                                data-target="#modal-monitoring-telegram">Kirim Ulang Semua</a>
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
                                    <td>{{$data->logID}}</td>
                                    <td>{{$data->logDate}}</td>
                                    <td>{{$data->logType}}</td>
                                    <td>{{$data->logBranchCode}}</td>
                                    <td>{{$data->logMessage}}</td>
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
@endsection
