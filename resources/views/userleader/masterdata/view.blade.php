@extends('layouts.base')
@section('content')
    <style>
        #button-user-log:hover {
            background: rgb(151, 186, 186);
        }

        #button-report-monitoring-harian:hover {
            /* display: flex; */
            cursor: pointer;
            background: rgb(151, 186, 186);
        }

        #button-report-monitoring-kerusakan:hover {
            /* display: flex; */
            cursor: pointer;
            background: rgb(151, 186, 186);
        }
    </style>
    <div class="content-wrapper">
        <div class="container-fluid">

            <div class="row mt-3">
                <div class="col-12 col-lg-6 col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <p class="mb-0 ">Total Pengerjaan <span class="float-right badge badge-primary">All</span></p>
                            <div class="">
                                <h4 class="mb-0 py-3 text-primary">{{ $data->count() }}<span class="float-right"><i
                                            class="fa fa-home"></i></span></h4>
                            </div>
                            <div class="progress-wrapper">
                                <div class="progress" style="height:5px;">
                                    <div class="progress-bar bg-primary" style="width:60%"></div>
                                </div>
                            </div>
                            <p class="mb-0 mt-2 small-font">Compare to last month <span class="float-right">+15% <i
                                        class="fa fa-long-arrow-up"></i></span></p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <p class="text-success mb-0">Penilaian Individu <span
                                    class="float-right badge badge-success">Value</span>
                            </p>
                            <div class="">
                                <h4 class="mb-0 py-3 text-success">100%<span class="float-right"><i
                                            class="fa fa-user-o"></i></span></h4>
                            </div>
                            <div class="progress-wrapper">
                                <div class="progress" style="height:5px;">
                                    <div class="progress-bar bg-success" style="width:80%"></div>
                                </div>
                            </div>
                            <p class="mb-0 mt-2 small-font">Compare to yesterday <span class="float-right">+43% <i
                                        class="fa fa-long-arrow-up"></i></span></p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <p class="text-danger mb-0">Gagal Pengerjaan<span class="float-right badge badge-danger">Fail
                                    Task</span>
                            </p>
                            <div class="">
                                <h4 class="mb-0 py-3 text-danger">0<span class="float-right"><i
                                            class="fa fa-times-circle"></i></span></h4>
                            </div>
                            <div class="progress-wrapper">
                                <div class="progress" style="height:5px;">
                                    <div class="progress-bar bg-danger" style="width:45%"></div>
                                </div>
                            </div>
                            <p class="mb-0 mt-2 small-font">Compare to last week <span class="float-right">+32% <i
                                        class="fa fa-long-arrow-up"></i></span></p>
                        </div>
                    </div>
                </div>
            </div><!--End Row-->

            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-2 p-1">
                                    <label for="Cari">Cari Tiket</label>
                                    <input type="text" class="form-control" name="" id="">
                                </div>
                                <div class="col-md-2 p-1">
                                    <label for="">Cari Cabang</label>
                                    <select name="" class="form-control single-select" id="">
                                        <option value="">Pilih Cabang</option>
                                        @foreach ($datacabang as $datacabang)
                                            <option value="">{{ $datacabang->nama_cabang }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2 p-1">
                                    <label for="Cari">Status</label>
                                    <select name="" class="form-control single-select" id="">
                                        <option value="">Pilih Status</option>
                                        <option value="0">Belum</option>
                                        <option value="1">Proses</option>
                                        <option value="2">Selesai</option>

                                    </select>
                                </div>
                                <div class="col-md-6 p-1">
                                    <div class="card-action">
                                        <div id="dateragne-picker">
                                            <label for="">Date</label>
                                            <div class="input-daterange input-group">
                                                <input type="text" class="form-control" name="start" />
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">to</span>
                                                </div>
                                                <input type="text" class="form-control" name="end" />
                                                <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                            <div class="card-body" style="padding:1%;"></div>
                            {{-- @foreach ($data as $item)
                                <li class="list-group-item" id="button-user-log" style="cursor: pointer;"
                                    data-toggle="modal" data-target="#modal-master-data-user"
                                    data-id="{{ $item->tiket_laporan }}">
                                    <div class="media align-items-center">
                                        <img src="{{ asset('assets/images/avatar/1.png') }}" alt="user avatar"
                                            class="customer-img rounded">
                                        <div class="media-body ml-3">
                                            <h6 class="mb-0">{{ $item->deskripsi_laporan }}</h6>
                                            <p style="font-size: 10px;">( {{ $item->nama_user }} ) - PRAMITA PONTIANAK</p>
                                            <small class="small-font mt-0">
                                                @if ($item->status_laporan == 0)
                                                    <span class="badge bg-danger text-white">Belum</span>
                                                @elseif ($item->status_laporan == 1)
                                                    <span class="badge bg-warning">Proses</span>
                                                @elseif ($item->status_laporan == 2)
                                                    <span class="badge bg-success text-white">Selesai</span>
                                                @endif
                                            </small>
                                        </div>
                                        <div class="row p-2 pl-3" style="font-size: 12px;">
                                            <div class="col-sm pt-1">
                                                <h6 class="mb-2"><span class="badge bg-dark text-white">Waktu Laporan
                                                        Masuk</span></h6>
                                                <p class="mb-0">{{ $item->tgl_laporan }}</p>
                                            </div>
                                            <div class="col-sm pt-1">
                                                <h6 class="mb-2"><span class="badge bg-primary text-white">Waktu Terima
                                                        Laporan</span></h6>
                                                <p class="mb-0">{{ $item->tgl_respon_laporan }}</p>
                                            </div>
                                            <div class="col-sm pt-1">
                                                <h6 class="mb-2"><span class="badge bg-success text-white">Waktu Selesai
                                                        Laporan</span></h6>
                                                <p class="mb-0">{{ $item->tgl_selesai_laporan }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach --}}
                            <table id="example1" class="table table-striped table-bordered" style="width:100%;"
                                border="1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Detail Report</th>
                                        <th>Waktu Laporan Masuk</th>
                                        <th>Waktu Terima Laporan</th>
                                        <th>Waktu Selesai Laporan</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($data as $item)
                                        <tr id="button-user-log" style="cursor: pointer;"
                                        data-toggle="modal" data-target="#modal-master-data-user"
                                        data-id="{{ $item->tiket_laporan }}">
                                            <td>{{ $no++ }}</td>
                                            <td>
                                                <h6 class="mb-0">{{ $item->deskripsi_laporan }}</h6>
                                                <p style="font-size: 10px;">( {{ $item->nama_user }} ) - PRAMITA PONTIANAK
                                                </p>
                                                <small class="small-font mt-0">
                                                    @if ($item->status_laporan == 0)
                                                        <span class="badge bg-danger text-white">Belum</span>
                                                    @elseif ($item->status_laporan == 1)
                                                        <span class="badge bg-warning">Proses</span>
                                                    @elseif ($item->status_laporan == 2)
                                                        <span class="badge bg-success text-white">Selesai</span>
                                                    @endif
                                                </small>
                                            </td>
                                            <td>
                                                <h6 class="mb-2"><span class="badge bg-dark text-white">Waktu Laporan
                                                        Masuk</span></h6>
                                                <p class="mb-0">{{ $item->tgl_laporan }}</p>
                                            </td>
                                            <td>
                                                <h6 class="mb-2"><span class="badge bg-primary text-white">Waktu Terima
                                                        Laporan</span></h6>
                                                <p class="mb-0">{{ $item->tgl_respon_laporan }}</p>
                                            </td>
                                            <td>
                                                <h6 class="mb-2"><span class="badge bg-success text-white">Waktu Selesai
                                                        Laporan</span></h6>
                                                <p class="mb-0">{{ $item->tgl_selesai_laporan }}</p>
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
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">Data Laporan
                            <div class="card-action">
                                {{-- <div class="dropdown">
                                    <a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret"
                                        data-toggle="dropdown">
                                        <i class="icon-options"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="javascript:void();">Action</a>
                                        <a class="dropdown-item" href="javascript:void();">Another action</a>
                                        <a class="dropdown-item" href="javascript:void();">Something else here</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="javascript:void();">Separated link</a>
                                    </div>
                                </div> --}}
                            </div>
                        </div>

                        <ul class="list-group list-group-flush shadow-none">
                            <li class="list-group-item" id="button-report-monitoring-harian" data-toggle="modal"
                                data-target="#modal-master-data-user">
                                <div class="media align-items-center">
                                    <img src="{{ asset('assets/images/avatar/report.png') }}" alt="user avatar"
                                        class="customer-img rounded">
                                    <div class="media-body ml-3">
                                        <h6 class="mb-0">Monitoring Harian</h6>
                                    </div>
                                    <div class="date">
                                        Submited List: 250
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item" id="button-report-monitoring-kerusakan" data-toggle="modal"
                                data-target="#modal-master-data-user">
                                <div class="media align-items-center">
                                    <img src="{{ asset('assets/images/avatar/kerusakan.png') }}" alt="user avatar"
                                        class="customer-img rounded">
                                    <div class="media-body ml-3">
                                        <h6 class="mb-0">Monitoring Laporan Kerusakan</h6>
                                    </div>
                                    <div class="date">
                                        Submited List: 250
                                    </div>
                                </div>
                            </li>

                        </ul>

                        <div class="card-footer text-center bg-transparent border-0">
                            {{-- <a href="javascript:void();">View all Categories</a> --}}
                        </div>



                    </div>
                </div>
            </div><!--End Row-->
            <!--start overlay-->
            <div class="overlay toggle-menu"></div>
            <!--end overlay-->

        </div>
        <!-- End container-fluid-->

    </div>
    <div class="modal fade" id="modal-master-data-user">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content border-danger " id="menu-modal-master-data-user" style="border: 0px;">

                <img src="{{ asset('gif.gif') }}" alt="" srcset="">

            </div>
        </div>
    </div>
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $('#dateragne-picker .input-daterange').datepicker({});
    </script>
    <script>
        $(document).ready(function() {
            $('.single-select').select2();
        });
    </script>
    <script>
        $(document).ready(function() {
            //Default data table
            $('#default-datatable').DataTable();
            $('#default-datatable1').DataTable();
            $('#default-datatable2').DataTable();


            var table = $('#example1').DataTable({
                lengthChange: false,
                // buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
            });

            table.buttons().container()
                .appendTo('#example_wrapper .col-md-6:eq(0)');

        });
    </script>
    <script>
        $(document).on("click", "#button-user-log", function(e) {
            e.preventDefault();
            var kode = $(this).data("id");
            $("#menu-modal-master-data-user").html(
                '<div class="card"><div style="text-align: center; padding:2%;"><div class="spinner-border" role="status" > <span class="sr-only"></span> </div></div></div>'
            );
            $.ajax({
                    url: "../../master-data-user/laporan/detail",
                    type: "POST",
                    cache: false,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "tiket": kode,
                    },
                    dataType: 'html',
                })
                .done(function(data) {
                    $("#menu-modal-master-data-user").html(data);
                })
                .fail(function() {
                    Lobibox.notify("error", {
                        pauseDelayOnHover: true,
                        continueDelayOnInactiveTab: false,
                        position: "top right",
                        icon: "fa fa-info",
                        msg: "Gagal",
                    });
                });
        });
    </script>
    <script>
        $(document).on("click", "#button-report-monitoring-harian", function(e) {
            e.preventDefault();
            var kode = $(this).data("id");
            $("#menu-modal-master-data-user").html(
                '<div class="card"><div style="text-align: center; padding:2%;"><div class="spinner-border" role="status" > <span class="sr-only"></span> </div></div></div>'
            );
            $.ajax({
                    url: "../../master-data-user/laporan/monitoring/harian",
                    type: "POST",
                    cache: false,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "tiket": kode,
                    },
                    dataType: 'html',
                })
                .done(function(data) {
                    $("#menu-modal-master-data-user").html(data);
                })
                .fail(function() {
                    Lobibox.notify("error", {
                        pauseDelayOnHover: true,
                        continueDelayOnInactiveTab: false,
                        position: "top right",
                        icon: "fa fa-info",
                        msg: "Gagal",
                    });
                });
        });
    </script>
    <script>
        $(document).on("click", "#button-report-monitoring-kerusakan", function(e) {
            e.preventDefault();
            var kode = $(this).data("id");
            $("#menu-modal-master-data-user").html(
                '<div class="card"><div style="text-align: center; padding:2%;"><div class="spinner-border" role="status" > <span class="sr-only"></span> </div></div></div>'
            );
            $.ajax({
                    url: "../../master-data-user/laporan/monitoring/kerusakan",
                    type: "POST",
                    cache: false,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "tiket": kode,
                    },
                    dataType: 'html',
                })
                .done(function(data) {
                    $("#menu-modal-master-data-user").html(data);
                })
                .fail(function() {
                    Lobibox.notify("error", {
                        pauseDelayOnHover: true,
                        continueDelayOnInactiveTab: false,
                        position: "top right",
                        icon: "fa fa-info",
                        msg: "Gagal",
                    });
                });
        });
    </script>
    <script>
        $(document).on("click", "#button-privew-monitoring-harian", function(e) {
            e.preventDefault();
            var data = $("#form-monitoring-harian").serialize();
            $("#show-monitoring-harian").html(
                '<div style="text-align: center; padding:2%;"><div class="spinner-border" role="status" > <span class="sr-only">Loading...</span> </div></div>'
            );
            $.ajax({
                    url: "master-data-user/laporan/monitoring/harian/preview",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf"]').attr("content"),
                    },
                    type: "POST",
                    data: data,
                    dataType: "html",
                })
                .done(function(datapdf) {
                    $("#show-monitoring-harian").html(
                        '<iframe src="data:application/pdf;base64, ' +
                        datapdf +
                        '" style="width:100%;; height:500px;" frameborder="0"></iframe>'
                    );
                })
                .fail(function() {
                    // console.log(data);
                    $("#show-monitoring-harian").html("Gagal Baca");
                });
        });
    </script>
@endsection
