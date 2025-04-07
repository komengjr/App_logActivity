<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Main Piket</title>
    <!--favicon-->
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon" />
    <!-- Bootstrap core CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/dist/summernote-bs4.css', []) }}" />
    <link href="{{ asset('assets/css/app-style.css') }}" rel="stylesheet" />
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

        <nav class="navbar navbar-expand bg-dark" style="justify-content: left; ">
            <ul class="navbar-nav right-nav-link" style="text-align: end;">
                <li class="nav-item " style="float: right;">
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
                        <li class="dropdown-item" style="cursor: pointer;"><a href="{{ url('/', []) }}"><i
                                    class="fa fa-tasks mr-2" style="float: right;"></i> Kembali</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <div class=" mt-3">
            <h6 class="text-uppercase text-white">User Piker</h6>
            <hr>
            <div class="row pr-0">
                @foreach ($data as $datas)
                    <div class="col-lg-3">
                        <div class="card profile-card-2">
                            <div class="card-img-block rounded-0 texture-info">

                            </div>

                            <div class="card-body pt-5">
                                <span class="user-profile">
                                    <img src="{{ asset('storage/' . $datas->gambar) }}" alt="profile-image"
                                        class="profile" style="width: 300px; height: 80px;">

                                </span>
                                <h5 class="card-title">{{ $datas->nama_lengkap }} {{$datas->nip}}</h5>
                                <p class="card-text">
                                    {{$datas->no_hp}}
                                </p>

                                <div class="icon-block">
                                    <a href="javascript:void();"><i
                                            class="fa fa-facebook bg-facebook text-white"></i></a>
                                    <a href="javascript:void();">
                                        <i class="fa fa-twitter bg-twitter text-white"></i></a>
                                    <a href="javascript:void();">
                                        <i class="fa fa-google-plus bg-google-plus text-white"></i></a>
                                </div>
                            </div>

                            <div class="btn-group float-sm-right" style="padding: 0px;">

                                <span class="btn btn-light dropdown-toggle-split rounded-0 texture-info"
                                    style="cursor: pointer;" data-toggle="modal" data-target="#modal-cabang-user"
                                    id="button-hendle-cabang-user">

                                    <span class="badge bg-warning p-2"><strong>Detail User</strong></span>
                                </span>

                            </div>
                        </div>
                    </div>
                @endforeach
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
