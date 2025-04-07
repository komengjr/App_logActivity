<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Main Dashboard</title>
    <!--favicon-->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon" />
    <!-- Bootstrap core CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/dist/summernote-bs4.css', []) }}" />
    <link href="assets/css/app-style.css" rel="stylesheet" />
    <style>
        body {
            background-color: #ffffff;
            color: #444444;
            font-family: 'Roboto', sans-serif;
            font-size: 16px;
            font-weight: 300;
            margin: 0;
            padding: 0;
        }

        #menu-main:hover {
            border-radius: 20px;
            background: rgb(2, 0, 36);
            background: linear-gradient(90deg, rgba(2, 0, 36, 1) 0%, rgba(74, 37, 111, 1) 35%, rgba(0, 212, 255, 1) 100%);
            text-align: end;
        }
    </style>
    <style>

    </style>
</head>

<body class="gradient-forest m-3">

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
    <div id="wrapper gradient-fores">

        <nav class="navbar navbar-expand bg-dark" style="justify-content: left;">
            <ul class="navbar-nav right-nav-link">
                <li class="nav-item ">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
                        <span class="user-profile"><img src="{{ asset('menu.png') }}" class="img-circle"
                                alt="user avatar"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right" style="float: right;">
                        <li class="dropdown-divider"></li>


                        <li class="dropdown-divider"></li>
                        {{-- <li class="dropdown-item" style="cursor: pointer;"><a href="{{ url('newcase', []) }}"><i
                                    class="fa fa-tasks mr-2" style="float: right;"></i> Buat laporan</a></li>
                        <li class="dropdown-item" style="cursor: pointer;"><a
                                href="{{ url('cek-status-laporan', []) }}"><i class="fa fa-tasks mr-2"
                                    style="float: right;"></i> Status Laporan</a></li>
                        <li class="dropdown-item" style="cursor: pointer;"><a
                                href="{{ url('cek-status-laporan', []) }}"><i class="fa fa-tasks mr-2"
                                    style="float: right;"></i> Jadwal Piket</a></li> --}}
                        <li class="dropdown-item" style="cursor: pointer;"><a href="{{ url('login', []) }}"><i
                                    class="fa fa-tasks mr-2" style="float: right;"></i> Login</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <div class="row mt-3">
            <div class="col-12 col-lg-3 col-xl-3" style="cursor: pointer;" onclick="window.location = '{{route('piket_user')}}';">
                <div class="card gradient-success" style="border: 4px solid #fff; border-radius: 25px;">
                    <div class="card-body" id="menu-main">
                        <div class="row align-items-center">
                            <div class="col">
                                <h2 class="mb-0 text-white"><span class="badge bg-dark"
                                        style="border-radius: 20px;">Jadwal Piket</span></h2>
                            </div>
                            {{-- <div class="col">
                                <div class="icon-box float-right rounded-circle bg-light">
                                    <i class="zmdi zmdi-balance-wallet text-white"></i>
                                </div>
                            </div> --}}
                        </div>
                        <h3 class="mt-4 mb-0 text-white" id="menu-main-gambar">
                            <img src="{{ asset('assets/images/avatar/1.png') }}" alt="" srcset=""
                                width="50">
                        </h3>
                        <p class="mb-0 extra-small-font text-white">Menu Jadwal</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 col-xl-3" style="cursor: pointer;" onclick="window.location = '{{route('newcase_create')}}';">
                <div class="card gradient-info" style="border: 4px solid #fff; border-radius: 25px;">
                    <div class="card-body" id="menu-main">
                        <div class="row align-items-center">
                            <div class="col">
                                <h2 class="mb-0 text-white"><span class="badge bg-dark"
                                        style="border-radius: 20px;">Membuat Laporan</span></h2>
                            </div>
                            {{-- <div class="col">
                                <div class="icon-box float-right rounded-circle bg-light">
                                    <i class="zmdi zmdi-balance-wallet text-white"></i>
                                </div>
                            </div> --}}
                        </div>
                        <h3 class="mt-4 mb-0 text-white" id="menu-main-gambar">
                            <img src="{{ asset('assets/images/avatar/1.png') }}" alt="" srcset=""
                                width="50">
                        </h3>
                        <p class="mb-0 extra-small-font text-white">Menu Jadwal</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 col-xl-3" style="cursor: pointer;" onclick="window.location = '{{route('cek-status-laporan')}}';">
                <div class="card gradient-warning" style="border: 4px solid #fff; border-radius: 25px;">
                    <div class="card-body" id="menu-main">
                        <div class="row align-items-center">
                            <div class="col">
                                <h2 class="mb-0 text-white"><span class="badge bg-dark"
                                        style="border-radius: 20px;">Status Laporan</span></h2>
                            </div>
                            {{-- <div class="col">
                                <div class="icon-box float-right rounded-circle bg-light">
                                    <i class="zmdi zmdi-balance-wallet text-white"></i>
                                </div>
                            </div> --}}
                        </div>
                        <h3 class="mt-4 mb-0 text-white" id="menu-main-gambar">
                            <img src="{{ asset('assets/images/avatar/1.png') }}" alt="" srcset=""
                                width="50">
                        </h3>
                        <p class="mb-0 extra-small-font text-white">Menu Jadwal</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 col-xl-3" style="cursor: pointer;" onclick="window.location = '{{route('login')}}';">
                <div class="card gradient-secondary" style="border: 4px solid #fff; border-radius: 25px;">
                    <div class="card-body" id="menu-main">
                        <div class="row align-items-center">
                            <div class="col">
                                <h2 class="mb-0 text-white"><span class="badge bg-dark"
                                        style="border-radius: 20px;">Cetak Laporan</span></h2>
                            </div>
                            {{-- <div class="col">
                                <div class="icon-box float-right rounded-circle bg-light">
                                    <i class="zmdi zmdi-balance-wallet text-white"></i>
                                </div>
                            </div> --}}
                        </div>
                        <h3 class="mt-4 mb-0 text-white" id="menu-main-gambar">
                            <img src="{{ asset('assets/images/avatar/1.png') }}" alt="" srcset=""
                                width="50">
                        </h3>
                        <p class="mb-0 extra-small-font text-white">Menu Jadwal</p>
                    </div>
                </div>
            </div>
        </div>

        <!--Start Back To Top Button-->
        <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
        <!--End Back To Top Button-->

    </div><!--wrapper-->

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/public.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/horizontal-menu.js') }}"></script>
    <script src="{{ asset('assets/js/app-script.js') }}"></script>
    <script src="{{ asset('assets/plugins/alerts-boxes/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/alerts-boxes/js/sweet-alert-script.js') }}"></script>

</body>

</html>
