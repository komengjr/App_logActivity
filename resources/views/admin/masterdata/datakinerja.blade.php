@extends('layouts.base')
@section('content')
    <style>
        #button-user-log:hover {
            background: rgb(151, 186, 186);
        }

        #button-show-data-kinerja-form:hover {
            /* display: flex; */
            cursor: pointer;
            background: rgb(151, 186, 186);
        }

        #button-report-monitoring-kerusakan:hover {
            /* display: flex; */
            cursor: pointer;
            background: rgb(151, 186, 186);
        }

        #button-data-kinerja:hover {
            /* display: flex; */
            cursor: pointer;
            background: rgb(151, 186, 186);
        }
    </style>
    @if ($message = Session::get('sukses'))
        <button class="btn btn-warning" onclick="sukses_notifikasi()" id="buttonnotif" hidden>SHOW ME</button>
        <script>
            function sukses_notifikasi() {
                Lobibox.notify('success', {
                    pauseDelayOnHover: true,
                    continueDelayOnInactiveTab: false,
                    position: 'center top',
                    showClass: 'zoomIn',
                    hideClass: 'zoomOut',
                    icon: 'fa fa-check-circle',
                    width: 400,
                    msg: '{{ $message }}'
                });
            }
            $(document).ready(function() {
                $('#buttonnotif').click();
            });
        </script>
    @elseif ($message = Session::get('gagal'))
        <button class="btn btn-warning" onclick="gagal_notifikasi()" id="buttongagal" hidden>SHOW ME</button>
        <script>
            function gagal_notifikasi() {
                Lobibox.notify('warning', {
                    pauseDelayOnHover: true,
                    continueDelayOnInactiveTab: false,
                    position: 'center top',
                    showClass: 'zoomIn',
                    hideClass: 'zoomOut',
                    icon: 'fa fa-exclamation-triangle',
                    width: 400,
                    msg: '{{ $message }}'
                });
            }
            $(document).ready(function() {
                $('#buttongagal').click();
            });
        </script>
    @endif
    <div class="content-wrapper">
        <div class="container-fluid">

            <div class="row mt-4">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="btn-toolbar" role="toolbar" style="justify-content: right;">
                                        <div class="btn-group mr-1">
                                            <button type="button" class="btn btn-outline-primary waves-effect waves-light">
                                                <i class="fa fa-inbox"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-primary waves-effect waves-light">
                                                <i class="fa fa-refresh"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-primary waves-effect waves-light">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                        </div>
                                        <div class="btn-group mr-1">
                                            <button type="button" class="btn btn-outline-primary dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-folder"></i>
                                                <b class="caret"></b>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a href="javaScript:void();" class="dropdown-item">Action</a>
                                                <a href="javaScript:void();" class="dropdown-item">Another action</a>
                                                <a href="javaScript:void();" class="dropdown-item">Something else here</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="javaScript:void();" class="dropdown-item">Separated link</a>
                                            </div>
                                        </div>
                                        <div class="btn-group mr-1">
                                            <button type="button"
                                                class="btn btn-outline-primary waves-effect waves-light dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-tag"></i>
                                                <b class="caret"></b>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a href="javaScript:void();" class="dropdown-item">Action</a>
                                                <a href="javaScript:void();" class="dropdown-item">Another action</a>
                                                <a href="javaScript:void();" class="dropdown-item">Something else here</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="javaScript:void();" class="dropdown-item">Separated link</a>
                                            </div>
                                        </div>

                                        <div class="btn-group">
                                            <button type="button"
                                                class="btn btn-outline-primary waves-effect waves-light dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false">
                                                More
                                                <span class="caret"></span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a href="javaScript:void();" class="dropdown-item">Action</a>
                                                <a href="javaScript:void();" class="dropdown-item">Another action</a>
                                                <a href="javaScript:void();" class="dropdown-item">Something else here</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="javaScript:void();" class="dropdown-item">Separated link</a>
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
                        <table id="example1" class="styled-table table-striped table-bordered"
                            style="width:100%; text-align: left;" border="1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Kinerja</th>
                                    <th>Kinerja</th>
                                    <th>Jumlah Template</th>
                                    <th>Status Kinerja</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($data as $data)
                                    <tr id="button-data-kinerja" data-id="{{ $data->kd_kinerja }}">
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $data->kd_kinerja }}</td>
                                        <td>{{ $data->kinerja }}</td>
                                        <td>0</td>
                                        <td class="text-center">
                                            @if ($data->status_kinerja == 1)
                                                <span class="badge badge-success">Aktif</span>
                                            @else
                                            @endif
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
                    <div class="card" id="sub-detail-kinerja">
                        <div class="card-header">
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
    <div class="modal fade" id="modal-master-data-kinerja" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" id="modal-show-kinerja-form">

            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-add-kinerja-detail">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Detail Kinerja</h5>
                    <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('simpan-master-data-kinerja-detail-data') }}">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="input-1">ID Kinerja</label>
                            <input type="text" class="form-control" id="id_kinerja" name="id_kinerja">
                        </div>
                        <div class="form-group">
                            <label for="input-1">Detail Kinerja</label>
                            <input type="text" class="form-control" name="detail_kinerja" required>
                        </div>
                        <div class="form-group">
                            <label for="input-2">Jenis Kinerja</label>
                            <input type="text" class="form-control" name="jenis_kinerja" required>
                        </div>
                        <div class="form-group">
                            <label for="input-3">Jangka Waktu</label>
                            <input type="text" class="form-control" name="waktu" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="fa fa-times"></i>
                            Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Save
                            changes</button>
                    </div>
                </form>
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
        // SETUP KINERJA
        $(document).on("click", "#button-add-kinerja-detail", function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            $('#id_kinerja').val(id);
        });
        $(document).on("click", "#button-data-kinerja", function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            $("#sub-detail-kinerja").html(
                '<div style="text-align: center; padding:2%;"><div class="spinner-border text-warning" role="status" > <span class="sr-only"></span> </div></div>'
            );
            $.ajax({
                    url: "master-data-kinerja/detaildata",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf"]').attr("content"),
                    },
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        data: id,
                        // "pilihan": pilihan,
                    },
                    dataType: "html",
                })
                .done(function(datapdf) {
                    $("#sub-detail-kinerja").html(datapdf);
                })
                .fail(function() {
                    // console.log(data);
                    $("#sub-detail-kinerja").html("Gagal Baca");
                });
        });
        $(document).on("click", "#button-show-data-kinerja-form", function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            $("#modal-show-kinerja-form").html(
                '<div style="text-align: center; padding:2%;"><div class="spinner-border text-warning" role="status" > <span class="sr-only"></span> </div></div>'
            );
            $.ajax({
                    url: "master-data-kinerja/detaildata/form",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf"]').attr("content"),
                    },
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        data: id,
                        // "pilihan": pilihan,
                    },
                    dataType: "html",
                })
                .done(function(datapdf) {
                    $("#modal-show-kinerja-form").html(datapdf);
                })
                .fail(function() {
                    // console.log(data);
                    $("#modal-show-kinerja-form").html("Gagal Baca");
                });
        });
        $(document).on("click", "#button-tambah-field-form-kinerja", function(e) {
            e.preventDefault();
            var data = $("#form-field-data-kinerja").serialize();
            $("#table-field-form").html(
                '<div style="text-align: center; padding:2%;"><div class="spinner-border text-warning" role="status" > <span class="sr-only"></span> </div></div>'
            );
            $.ajax({
                    url: "master-data-kinerja/detaildata/fieldform",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf"]').attr("content"),
                    },
                    type: "POST",
                    data: data,
                    dataType: "html",
                })
                .done(function(datapdf) {
                    $("#table-field-form").html(datapdf);
                })
                .fail(function() {
                    // console.log(data);
                    $("#table-field-form").html("Gagal Baca");
                });
        });
    </script>
@endsection
