<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>App Log - {{ Auth::user()->name }}</title>
    <!--favicon-->
    <link rel="icon" href="{{ asset('1.jpg', []) }}" type="image/x-icon" />
    <link href="{{ asset('assets/plugins/simplebar/css/simplebar.css', []) }}" rel="stylesheet" />
    {{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css"> --}}
    <link href="{{ asset('assets/css/bootstrap.min.css', []) }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/animate.css', []) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.css', []) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/horizontal-menu.css', []) }}" rel="stylesheet" />

    <link href="{{ asset('assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css', []) }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css', []) }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/plugins/notifications/css/lobibox.min.css', []) }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/dist/summernote-bs4.css', []) }}" />
    <link href="{{ asset('assets/plugins/select2/css/select2.min.css', []) }}" rel="stylesheet" />
    <link href="{{ asset('css/notif.scss', []) }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/app-style.css', []) }}" rel="stylesheet" />

    <style>
        .footerx {
            padding: 5px;
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: rgb(255, 255, 255);
            color: rgb(0, 0, 0);
            text-align: center;
            border: 2px solid #2c717f;
        }
    </style>
    <style>
        @media only screen and (max-width: 800px) {

            td,
            tr {
                display: block;
            }

            /* Hide table headers (but not display: none;, for accessibility) */
            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                border: 1px solid #000000;
            }

            tr+tr {
                margin-top: 1.5em;
            }

            td {
                /* make like a "row" */
                border: 5px;
                border-bottom: 1px solid #eee;
                position: relative;
                padding-left: 50%;
                background-color: #bcc6c1;
                text-align: left;
            }

            td:before {
                content: attr(data-label);
                display: inline-block;
                font-family: 'Orbitron', sans-serif;
                padding-left: 10px;
                line-height: 2.5;
                margin-left: -100%;
                width: 100%;
                white-space: nowrap;
            }
        }

        .styled-table {
            /* position: static; */
            border-collapse: collapse;
            margin: 0px 0;
            font-size: 0.9em;

            width: 100%;
            /* min-width: 400px; */
            box-shadow: 0 0 20px rgba(217, 211, 211, 0.15);

        }

        .styled-table thead tr {
            background-color: #0095ff;
            color: #ffffff;
            text-align: left;
        }

        @media only screen and (min-width: 760px) {

            .styled-table th,
            .styled-table td {
                padding: 12px 15px;
            }
        }

        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #030303;
        }

        .styled-table tbody tr.active-row {
            font-weight: bold;
            color: #020202;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/script.js/2.1.1/script.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>

    <!-- start loader -->
    <div id="pageloader-overlay" class="visible incoming">
        <div class="loader-wrapper-outer">
            <div class="loader-wrapper-inner">
                <div class="loader"></div>
            </div>
        </div>
    </div>
    <!-- end loader -->

    <!-- Start wrapper-->
    <div id="wrapper" style="font-family: 'Chakra Petch', sans-serif;">

        <!--Start topbar header-->
        <header class="topbar-nav">
            <nav class="navbar navbar-expand">
                <ul class="navbar-nav mr-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void();">
                            <div class="media align-items-center">
                                <img src="{{ asset('gif.gif', []) }}" alt="logo icon"width="100"
                                    style="padding-top: 10px; padding-bottom: 10px;">

                                {{-- <div class="media-body">
                                    <h5 class="logo-text">App Log</h5>
                                </div> --}}
                            </div>
                        </a>
                    </li>

                </ul>

                <ul class="navbar-nav align-items-center right-nav-link">
                    @if (Auth::user()->kd_akses > 2 && Auth::user()->kd_akses < 5)
                        @php
                            $jumlahnotif = 0;
                            $notif = DB::table('tbl_schedule')
                                ->where('status_schedule', 1)
                                ->get();
                            foreach ($notif as $value) {
                                if (substr($value->tgl_akhir, 0, 10) >= date('Y-m-d')) {
                                    if (substr($value->tgl_start, 0, 10) <= date('Y-m-d')) {
                                        $cekdata = DB::table('tbl_schadule_log')
                                            ->where('kd_schedule', $value->kd_schedule)
                                            ->where('id_user', Auth::user()->id_user)
                                            ->count();

                                        if ($cekdata == 0) {
                                            $jumlahnotif = $jumlahnotif + 1;
                                        } else {
                                        }
                                    }
                                }
                            }
                        @endphp
                        <li class="nav-item pl-4">
                            <button class="dropdown-toggle waves-effect " onclick="waktu()" data-toggle="dropdown">
                                <i class="fa fa-envelope-open-o"></i><span class="badge badge-warning badge-up"
                                    id="detikwaktu"><strong id="kayu">{{ $jumlahnotif }}</strong></span></button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="list-group list-group-flush">

                                    <div id="nitifikasipesan"></div>

                                </ul>

                            </div>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
                            <span class="user-profile"><img src="{{ asset('icon.png', []) }}" class="img-circle" alt="user avatar"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item user-details">
                                <a href="javaScript:void();">
                                    <div class="media">
                                        <div class="avatar"><img class="align-self-start mr-3"
                                                src="{{ asset('icon.png', []) }}" alt="user avatar"></div>
                                        <div class="media-body">
                                            <h6 class="mt-2 user-title">{{ Auth::user()->name }} (
                                                @if (Auth::user()->kd_akses == 1)
                                                    Super Admin
                                                @elseif (Auth::user()->kd_akses == 2)
                                                    Admin
                                                @elseif (Auth::user()->kd_akses == 3)
                                                    User Leader
                                                @elseif (Auth::user()->kd_akses == 4)
                                                    User
                                                @elseif (Auth::user()->kd_akses == 5)
                                                    Verifikator
                                                @endif )
                                            </h6>
                                            <p class="user-subtitle">{{ Auth::user()->email }}</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="dropdown-divider"></li>

                            <li class="dropdown-item" style="cursor: pointer" data-toggle="modal"
                                data-target="#formuser"><i class="fa fa-key mr-2"></i> Ubah Password</li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item" style="cursor: pointer"
                                onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" id="keluarform">
                                <i class="icon-power mr-2"></i> Logout
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <form id="logout-form" action="{{ asset('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </header>
        <!--End topbar header-->

        <!-- start horizontal Menu -->
        <nav>
            <!-- Menu Toggle btn-->
            <div class="menu-toggle">
                {{-- <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon"> --}}
                {{-- <p><marquee direction="right">Teks ini ke kanan</marquee></p> --}}
                <button type="button" id="menu-btn">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <ul id="respMenu" class="horizontal-menu">

                <li>
                    <a href="javascript:;">
                        <i class="zmdi zmdi-view-dashboard" aria-hidden="true"></i>
                        <span class="title">Dashboard</span>
                        <span class="arrow"></span>
                    </a>
                    <!-- Level Two-->
                    <ul>
                        <li><a href="{{ asset('home', []) }}"><i class="zmdi zmdi-dot-circle-alt"></i> Home</a></li>

                    </ul>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="zmdi zmdi-view-dashboard" aria-hidden="true"></i>
                        <span class="title">Master Data</span>
                        <span class="arrow"></span>
                    </a>
                    <!-- Level Two-->
                    <ul>
                        <li><a href="{{ asset('master-data-user', []) }}"><i class="zmdi zmdi-dot-circle-alt"></i> Data User</a></li>

                    </ul>
                </li>
                @if (Auth::user()->kd_akses < 3)
                    <li>
                        <a href="javascript:;">
                            <i class="zmdi zmdi-view-dashboard" aria-hidden="true"></i>
                            <span class="title">Menu</span>
                            <span class="arrow"></span>
                        </a>
                        <ul>
                            <li><a href="{{ asset('schedule', []) }}"><i class="zmdi zmdi-dot-circle-alt"></i>
                                    Menu Jadwal</a>
                            </li>
                            <li><a href="{{ asset('cabang', []) }}"><i class="zmdi zmdi-dot-circle-alt"></i>
                                    Menu Cabang</a>
                            </li>
                            <li><a href="{{ asset('taskorder', []) }}"><i class="zmdi zmdi-dot-circle-alt"></i>
                                    Menu Task</a>
                            </li>
                        </ul>
                    </li>
                @endif


            </ul>
        </nav>
        <!-- end horizontal Menu -->

        <div class="clearfix"></div>

        @yield('content')

        <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>


        <footer class="footerx">
            <div class="container">
                <div class="text-center">
                    Copyright © 2022 LogApp Versi 1.0
                </div>
            </div>
        </footer>

    </div>
    <!--End wrapper-->
    <div class="modal fade" id="formuser">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-danger">
                <div class="modal-header bg-info">
                    <h5 class="modal-title text-white">Ubah Password User</h5>
                    <span>
                        <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </span>

                </div>
                <form action="{{ asset('ubahpassword', []) }}" method="post">
                    @csrf
                    <div class="modal-body" id="divtableworklist">
                        <div class="body" id="divinputworklist">
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Password Baru</label>
                                    <input type="text" class="form-control" name="password">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn-warning"><i class="fa fa-key"></i> Ubah Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-laporan-user">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content border-danger" id="bodytask_kinerja">

                gfd

            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/popper.min.js', []) }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js', []) }}"></script>
    <script src="{{ asset('assets/plugins/simplebar/js/simplebar.js', []) }}"></script>
    <script src="{{ asset('assets/js/horizontal-menu.js', []) }}"></script>
    <script src="{{ asset('assets/js/app-script.js', []) }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js', []) }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js', []) }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js', []) }}"></script>
    <script src="{{ asset('assets/plugins/notifications/js/lobibox.min.js', []) }}"></script>
    <script src="{{ asset('assets/plugins/notifications/js/notifications.min.js', []) }}"></script>
    <script src="{{ asset('assets/plugins/notifications/js/notification-custom-script.js', []) }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js', []) }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js', []) }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datatable/js/jszip.min.js', []) }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datatable/js/pdfmake.min.js', []) }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datatable/js/vfs_fonts.js', []) }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datatable/js/buttons.html5.min.js', []) }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datatable/js/buttons.print.min.js', []) }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datatable/js/buttons.colVis.min.js', []) }}"></script>
    <script>
        $(document).ready(function() {
            //Default data table
            $('#default-datatable').DataTable();
            $('#default-datatable1').DataTable();
            $('#default-datatable2').DataTable();


            var table = $('#example').DataTable({
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
            });

            table.buttons().container()
                .appendTo('#example_wrapper .col-md-6:eq(0)');

        });
    </script>
    @if (Auth::user()->kd_akses > 2 && Auth::user()->kd_akses < 5)
        <script>
            function notifpesanbaru() {
                Lobibox.notify('info', {
                    pauseDelayOnHover: true,
                    continueDelayOnInactiveTab: false,
                    icon: 'fa fa-envelope',
                    position: 'center top',
                    showClass: 'zoomIn',
                    hideClass: 'zoomOut',
                    sound: false,
                    width: 400,
                    msg: 'Ada Pesan Baru Yang belum dibaca'
                });
            }

            function showTime() {
                var waktu = $("#detikwaktu").text();
                $.ajax({
                        url: "user/notifikasi/lihatnotifwaktu",
                        type: "GET",
                        dataType: "html",
                    })
                    .done(function(data) {
                        $("#kayu").html(data);
                        if (waktu == data || data == 0) {

                        } else {
                            notifpesanbaru();
                        }
                    })
                    .fail(function() {
                        $("#kayu").html(
                            '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                        );
                    });

            }
            setInterval('showTime()', 2000);
        </script>
    @endif

</body>

</html>
