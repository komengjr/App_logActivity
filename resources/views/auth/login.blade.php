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
    <link rel="icon" href="{{ url('icon.png', []) }}" type="image/x-icon">
    <link href="{{ url('assets/css/bootstrap.min.css', []) }}" rel="stylesheet" />
    <link href="{{ url('assets/css/animate.css', []) }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/icons.css', []) }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/app-style.css', []) }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
</head>

<body>

    <!-- start loader -->
    
    <!-- end loader -->

    <!-- Start wrapper-->
    <div id="wrapper" style="font-family: 'Russo One', sans-serif;" class="p-3">

        {{-- <div class="loader-wrapper">
            <div class="lds-ring">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div> --}}
        <div class="pb-5"></div>
        <div class="pb-5"></div>
        <div class="card card-authentication1 mx-auto my-5 pt-2">
            <div class="card-body">
                <div class="card-content p-0">
                    <div class="text-center m-0">
                        <img src="{{ url('gif.gif', []) }}" alt="logo icon" width="300">
                    </div>
                    <div class="card-title text-uppercase text-center py-3"
                        style="font-family: "Copperplate", "Courier New" , Monospace;">Login Aplikasi</div>
                    <form method="POST" action="{{ route('login') }}">
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
    <script src="{{ url('assets/js/jquery.min.js', []) }}"></script>
    <script src="{{ url('assets/js/popper.min.js', []) }}"></script>
    <script src="{{ url('assets/js/bootstrap.min.js', []) }}"></script>
    <script src="{{ url('assets/js/horizontal-menu.js', []) }}"></script>
    <script src="{{ url('assets/js/app-script.js', []) }}"></script>

</body>

</html>
