@extends('layouts.base')
@section('content')
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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header mb-3">
                            <div class="row">
                                <div class="col-lg-8">
                                    <h5><span class="badge badge-dark">Data Tidak Terikirm</span></h5>
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
                                    <th>Tiket</th>
                                    <th>Cabang</th>
                                    <th>Nama Pelapor</th>
                                    <th>Tanggal Melapor</th>
                                    <th>No Hp</th>
                                    <th>Email</th>
                                    <th>Status Pengiriman</th>
                                    <th>Status Laporan</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($data as $data)
                                    <tr>
                                        <td data-label="No">{{ $no++ }}</td>
                                        <td data-label="Tiket">{{ $data->tiket_laporan }}</td>
                                        <td data-label="Cabang">{{ $data->nama_cabang }}</td>
                                        <td data-label="Nama Pelapor">{{ $data->nama_user }}</td>
                                        <td data-label="Tanggal Laporan">{{ $data->tgl_laporan }}</td>
                                        <td data-label="No Hp">{{ $data->no_hp }}</td>
                                        <td data-label="Email">{{ $data->email }}</td>
                                        <td>
                                            <span class="badge badge-danger">Gagal Kirim</span>
                                        </td>
                                        <td>
                                            @if ($data->status_laporan == 2)
                                                <span class="badge badge-success">Selesai</span>
                                            @else
                                                <span class="badge badge-danger">Belum Selesai</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button"
                                                    class="btn-outline-primary waves-effect waves-light dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false">
                                                    Option
                                                    <span class="caret"></span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a href="javaScript:void();" class="dropdown-item" data-toggle="modal"
                                                        data-target="#modal-monitoring-telegram"
                                                        id="button-edit-monitoring-telegram"
                                                        data-id="{{ $data->id_laporan }}"><i class="zmdi zmdi-edit"></i>
                                                        Edit</a>
                                                    <a href="javaScript:void();" class="dropdown-item" data-toggle="modal"
                                                        data-target="#modal-monitoring-telegram"
                                                        id="button-detail-monitoring-telegram"
                                                        data-id="{{ $data->id_laporan }}"><i class="zmdi zmdi-eye"></i>
                                                        Detail</a>
                                                    <a href="javaScript:void();" class="dropdown-item">Something else
                                                        here</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="javaScript:void();" class="dropdown-item"
                                                        id="button-kirim-ulang-telegram"><i class="zmdi zmdi-mail-send"></i>
                                                        Kirim Ulang</a>
                                                </div>
                                            </div>
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
    <div class="modal fade" id="modal-monitoring-telegram">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Data Telegram</h5>
                    <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body-monitoring-telegram">

                </div>
                <div class="modal-footer">
                    <span class="badge badge-warning">Copyright</span>
                </div>

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
        $(document).on("click", "#button-no-telegram", function(e) {
            e.preventDefault();
            // var id = $(this).data("id");
            $.ajax({
                    url: "{{ route('no-gateway-telegram') }}",
                    type: "GET",
                    dataType: "html",
                })
                .done(function(data) {
                    $("#modal-body-monitoring-telegram").html(data);
                })
                .fail(function() {
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
        $(document).on("click", "#button-log-telegram", function(e) {
            e.preventDefault();
            // var id = $(this).data("id");
            $.ajax({
                    url: "{{ route('log-gateway-telegram') }}",
                    type: "GET",
                    dataType: "html",
                })
                .done(function(data) {
                    $("#modal-body-monitoring-telegram").html(data);
                })
                .fail(function() {
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
        $(document).on("click", "#button-all-laporan-telegram", function(e) {
            e.preventDefault();
            // var id = $(this).data("id");
            $.ajax({
                    url: "{{ route('all-laporan-gateway-telegram') }}",
                    type: "GET",
                    dataType: "html",
                })
                .done(function(data) {
                    $("#modal-body-monitoring-telegram").html(data);
                })
                .fail(function() {
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
        $(document).on("click", "#button-edit-monitoring-telegram", function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            console.log(id);

            $.ajax({
                    url: '../../admin/gateway/telegram/edit-log-telegram/' + id,
                    type: "GET",
                    dataType: "html",
                })
                .done(function(data) {
                    $("#modal-body-monitoring-telegram").html(data);
                })
                .fail(function() {
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
        $(document).on("click", "#button-detail-monitoring-telegram", function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            console.log(id);

            $.ajax({
                    url: '../../admin/gateway/telegram/detail-log-telegram/' + id,
                    type: "GET",
                    dataType: "html",
                })
                .done(function(data) {
                    $("#modal-body-monitoring-telegram").html(data);
                })
                .fail(function() {
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
        $(document).on("click", "#button-kirim-ulang-telegram", function(e) {
            e.preventDefault();

            $("#loading").html(
                '<div id="pageloader-overlay" class="visible incoming"> <div class="loader-wrapper-outer"> <div class="loader-wrapper-inner"> <div class="loader"></div> </div> </div> </div>'
            );
            setTimeout(() => {
                location.reload();
            }, 3000);
            // $.ajax({
            //         url: '../../admin/gateway/telegram/detail-log-telegram/'+id,
            //         type: "GET",
            //         dataType: "html",
            //     })
            //     .done(function(data) {
            //         $("#modal-body-monitoring-telegram").html(data);
            //     })
            //     .fail(function() {
            //         Lobibox.notify("error", {
            //             pauseDelayOnHover: true,
            //             icon: "fa fa-info-circle",
            //             continueDelayOnInactiveTab: false,
            //             position: "center top",
            //             showClass: "bounceIn",
            //             hideClass: "bounceOut",
            //             sound: false,
            //             width: 400,
            //             msg: "Hubungi Administrator Jika terjadi Eror",
            //         });
            //     });
        });
    </script>
@endsection
