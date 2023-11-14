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
    <link rel="icon" href="{{ asset('icon.png', []) }}" type="image/x-icon">
    <link href="{{ asset('assets/css/bootstrap.min.css', []) }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/animate.css', []) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.css', []) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app-style.css', []) }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
</head>

<body class="gradient-royal">

    <!-- start loader -->

    <!-- end loader -->

    <!-- Start wrapper-->
    <div id="wrapper ">

        {{-- <div class="loader-wrapper">
            <div class="lds-ring">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div> --}}
        <nav class="navbar navbar-expand gradient-dusk">
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
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown"
                        href="#">
                        <span class="user-profile"><img src="{{ asset('menu.PNG') }}" class="img-circle"
                                alt="user avatar"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right ">
                        <li class="dropdown-divider"></li>
                        <li class="dropdown-item" style="cursor: pointer;"><i class="fa fa-tasks mr-2"></i> Case Baru</li>
                        <li class="dropdown-divider"></li>
                    </ul>
                </li>
            </ul>
        </nav>
        {{-- <div class="pb-5"></div>
        <div class="pb-5"></div> --}}
        <div class="card card-authentication1 mx-auto my-5 pt-2">
            <div class="card-body">
                <div class="card-content p-0">
                    <div class="text-center m-0">
                        <img src="{{ asset('gif.gif', []) }}" alt="logo icon" width="300">
                    </div>
                    <div class="card-title text-uppercase text-center py-3">Login Aplikasi</div>
                    <form method="POST" action="login">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputUsername" class="sr-only">Username</label>
                            <div class="position-relative has-icon-right">
                                <!-- <input type="text" id="exampleInputUsername" class="form-control input-shadow" placeholder="Enter Username"> -->
                                <input id="email" type="text"
                                    class="form-control @error('email') is-invalid @enderror input-shadow"
                                    name="email"placeholder="Enter Username" value="{{ old('email') }}" required
                                    autocomplete="email" autofocus>
                                <div class="form-control-position">
                                    <i class="icon-user"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword" class="sr-only">Password</label>
                            <div class="position-relative has-icon-right">
                                {{-- <input type="password" id="exampleInputPassword" class="form-control input-shadow" placeholder="Enter Password"> --}}
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror input-shadow"
                                    name="password" placeholder="Enter Password" required
                                    autocomplete="current-password">
                                <div class="form-control-position">
                                    <i class="icon-lock"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <div class="icheck-material-info">
                                    <input type="checkbox" id="user-checkbox" checked="" />
                                    <label for="user-checkbox">Remember me</label>
                                </div>
                            </div>
                            <div class="form-group col-6 text-right">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info btn-block">masuk</button>


                    </form>
                </div>
            </div>
            <div class="card-footer text-center py-3">
                <p class="text-dark mb-0">Copyright © 2022</p>
            </div>
        </div>

        <!--Start Back To Top Button-->
        <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
        <!--End Back To Top Button-->



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
