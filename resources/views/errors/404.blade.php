<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Eror 404 !!</title>
  <!--favicon-->
  <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet"/>
  <link href="{{ asset('assets/css/app-style.css') }}" rel="stylesheet"/>

</head>

<body>

<!-- start loader -->
   <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
   <!-- end loader -->

<!-- Start wrapper-->
 <div id="wrapper">

    <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center error-pages">
                        <h1 class="error-title text-warning"> 404</h1>
                        <h2 class="error-sub-title text-dark">404 not found</h2>

                        <p class="error-message text-dark text-uppercase">Sorry, an error has occured, Requested page not found!</p>


                        <div class="mt-4">
                          <a href="{{ url('home', []) }}" class="btn btn-dark btn-round m-1">Go To Home </a>
                          {{-- <a href="javascript:void();" class="btn btn-primary btn-round m-1">Previous Page </a> --}}
                        </div>

                        <div class="mt-4">
                            <p class="">Copyright © 2022 LogApp Versi 1.0.</p>
                        </div>
                           <hr class="w-50 border-light-2">
                        <div class="mt-2">

                        </div>
                    </div>
                </div>
            </div>
        </div>


 </div><!--wrapper-->


  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

  <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

  <!-- simplebar js -->
  {{-- <script src="assets/plugins/simplebar/js/simplebar.js"></script> --}}
  <!-- horizontal-menu js -->
  <script src="{{ asset('assets/js/horizontal-menu.js') }}"></script>

  <!-- Custom scripts -->
  <script src="{{ asset('assets/js/app-script.js') }}"></script>

</body>
</html>
