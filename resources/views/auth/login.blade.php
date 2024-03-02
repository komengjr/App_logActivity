<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    {{-- <meta name="description" content="" />
    <meta name="author" content="" /> --}}
    <title> Pramita - Panel Login</title>
    <!--favicon-->
    <link rel="icon" href="{{ asset('assets/images/logo-icon.png', []) }}" type="image/x-icon">
    <link href="{{ asset('assets/css/bootstrap.min.css', []) }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/animate.css', []) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.css', []) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app-style.css', []) }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
</head>
<style>
    body {
        background-image: url('vendor/bg.jpg');
        height: 100%;
        /* width: 100%; */
        /* Center and scale the image nicely */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    /* For width 400px and larger: */
    @media only screen and (max-width: 550px) {
        body {
            background-image: url('vendor/bg.png');
            height: 100%;

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    }
</style>

<body class="">

    <!-- start loader -->

    <!-- end loader -->

    <!-- Start wrapper-->
    <div class="wrapper">

        <nav class="navbar navbar-expand-lg navbar-light bg-dark">
            <a class="navbar-brand text-white" href="#">LOG APP</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    {{-- <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">Disabled</a>
                    </li> --}}
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <a href="{{ url('newcase', []) }}" class="btn btn-outline-warning mx-2"><i
                            class="fa fa-window-restore"></i> NEW CASE</a>

                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fa fa-lock"></i>
                        Login</button>
                </form>
            </div>
        </nav>
        {{-- <nav class="navbar navbar-expand bg-transparant">
            <ul class="navbar-nav mr-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void();">
                        <div class="media align-items-center">
                            <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
                            <div class="media-body">
                                <h5 class="logo-text"></h5>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="nav-item">

                </li>
            </ul>

            <ul class="navbar-nav align-items-center right-nav-link ">

                <li class="nav-item ">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
                        <span class="user-profile"><img src="{{ asset('menu.png') }}" class="img-circle"
                                alt="user avatar"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right ">
                        <li class="dropdown-divider"></li>
                        <li class="dropdown-item" style="cursor: pointer;"><a href="{{ url('newcase', []) }}"><i
                                    class="fa fa-tasks mr-2"></i> Case Baru</a></li>
                        <li class="dropdown-divider"></li>
                    </ul>
                </li>
            </ul>
        </nav> --}}
        {{-- <div class="pb-5"></div>
        <div class="pb-5"></div> --}}
        <div class="pb-5" style="padding-top: 3%;"></div>
        <div class="card-authentication2 mx-auto my-5" style="padding-left: 2px; padding-right: 2px">
            <div class="card-group">
                <div class="card mb-0">
                    <div class="bg-signin2"></div>
                    <div class="card-img-overlay rounded-left my-4">
                        <h2 class="text-white">LOG APP</h2>
                        <h5 class="text-white">MANAGEMENT SOFTWARE</h5>
                        <p class="card-text text-white pt-5">There are many variations of passages of Lorem Ipsum
                            available, but the majority have suffered alteration in some form, by injected humour, or
                            randomised words which don't look even slightly believable.</p>
                    </div>
                </div>

                <div class="card mb-0 ">
                    <div class="card-body bg-light">
                        <div class="card-content p-3">
                            <div class="text-center">
                                {{-- <img src="assets/images/logo-icon.png" alt="logo icon"> --}}
                            </div>
                            <div class="card-title text-uppercase text-center py-3">Sign In</div>
                            <form method="POST" action="login">
                                @csrf
                                <div class="form-group">
                                    <div class="position-relative has-icon-left">
                                        <label for="exampleInputUsername" class="sr-only">Username</label>
                                        <input id="email" type="text"
                                            class="form-control @error('email') is-invalid @enderror input-shadow"
                                            name="email"placeholder="Enter Username" value="{{ old('email') }}"
                                            required autocomplete="email" autofocus>
                                        <div class="form-control-position">
                                            <i class="icon-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="position-relative has-icon-left">
                                        <label for="exampleInputPassword" class="sr-only">Password</label>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror input-shadow"
                                            name="password" placeholder="Enter Password" required
                                            autocomplete="current-password">
                                        <div class="form-control-position">
                                            <i class="icon-lock"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row mr-0 ml-0">
                                    <div class="form-group col-6">
                                        <div class="icheck-material-primary">
                                            <input type="checkbox" id="user-checkbox" checked="" />
                                            <label for="user-checkbox">Remember me</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-6 text-right">
                                        {{-- <a href="authentication-reset-password2.html">Reset Password</a> --}}
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block waves-effect waves-light">Sign
                                    In</button>
                                <div class="text-center pt-3">


                                    <hr>
                                    <p class="text-dark mb-0">Copyright © 2023</p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Start Back To Top Button-->
        <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
        <!--End Back To Top Button-->

        <footer class="bg-dark shadow-sm p-2 text-center fixed-bottom">
            <p class="mb-0 text-white">Copyright © 2023. All right reserved.</p>
        </footer>

    </div>
    <!--wrapper-->

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/js/jquery.min.js', []) }}"></script>
    <script src="{{ asset('assets/js/popper.min.js', []) }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js', []) }}"></script>
    <script src="{{ asset('assets/js/horizontal-menu.js', []) }}"></script>
    <script src="{{ asset('assets/js/app-script.js', []) }}"></script>

</body>

</html>
