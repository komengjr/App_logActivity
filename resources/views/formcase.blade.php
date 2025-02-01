<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Form Case</title>
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
            /* font-family: 'Roboto', sans-serif; */
            font-size: 16px;
            font-weight: 300;
            margin: 0;
            padding: 0;
        }

        .wizard-content-left {
            background-blend-mode: darken;
            background-color: rgba(0, 0, 0, 0.45);
            background-image: url("../design.jpg");
            background-position: center center;
            background-size: cover;
            height: 80vh;
            padding: 30px;
        }

        .wizard-content-left h3 {
            color: #ffffff;
            font-size: 20px;
            font-weight: 600;
            padding: 12px 20px;
            text-align: center;
        }

        .form-wizard {
            color: #888888;
            padding: 30px;
            background-color: #ffffff;
        }

        .form-wizard .wizard-form-radio {
            display: inline-block;
            margin-left: 5px;
            position: relative;
        }

        .form-wizard .wizard-form-radio input[type="radio"] {
            -webkit-appearance: none;
            -moz-appearance: none;
            -ms-appearance: none;
            -o-appearance: none;
            appearance: none;
            background-color: #dddddd;
            height: 25px;
            width: 25px;
            display: inline-block;
            vertical-align: middle;
            border-radius: 50%;
            position: relative;
            cursor: pointer;
        }

        .form-wizard .wizard-form-radio input[type="radio"]:focus {
            outline: 0;
        }

        .form-wizard .wizard-form-radio input[type="radio"]:checked {
            background-color: #fb1647;
        }

        .form-wizard .wizard-form-radio input[type="radio"]:checked::before {
            content: "";
            position: absolute;
            width: 10px;
            height: 10px;
            display: inline-block;
            background-color: #ffffff;
            border-radius: 50%;
            left: 1px;
            right: 0;
            margin: 0 auto;
            top: 8px;
        }

        .form-wizard .wizard-form-radio input[type="radio"]:checked::after {
            content: "";
            display: inline-block;
            webkit-animation: click-radio-wave 0.65s;
            -moz-animation: click-radio-wave 0.65s;
            animation: click-radio-wave 0.65s;
            background: #000000;
            content: '';
            display: block;
            position: relative;
            z-index: 100;
            border-radius: 50%;
        }

        .form-wizard .wizard-form-radio input[type="radio"]~label {
            padding-left: 10px;
            cursor: pointer;
        }

        .form-wizard .form-wizard-header {
            text-align: center;
        }

        .form-wizard .form-wizard-next-btn,
        .form-wizard .form-wizard-previous-btn,
        .form-wizard .form-wizard-submit {
            background-color: #d65470;
            color: #ffffff;
            display: inline-block;
            min-width: 100px;
            min-width: 120px;
            padding: 10px;
            text-align: center;
        }

        .form-wizard .form-wizard-next-btn:hover,
        .form-wizard .form-wizard-next-btn:focus,
        .form-wizard .form-wizard-previous-btn:hover,
        .form-wizard .form-wizard-previous-btn:focus,
        .form-wizard .form-wizard-submit:hover,
        .form-wizard .form-wizard-submit:focus {
            color: #ffffff;
            opacity: 0.6;
            text-decoration: none;
        }

        .form-wizard .wizard-fieldset {
            display: none;
        }

        .form-wizard .wizard-fieldset.show {
            display: block;
        }

        .form-wizard .wizard-form-error {
            display: none;
            background-color: #d70b0b;
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 2px;
            width: 100%;
        }

        .form-wizard .form-wizard-previous-btn {
            background-color: #fb1647;
        }

        .form-wizard .form-control {
            font-weight: 300;
            height: auto !important;
            padding: 15px;
            color: #888888;
            background-color: #f1f1f1;
            border: none;
        }

        .form-wizard .form-control:focus {
            box-shadow: none;
        }

        .form-wizard .form-group {
            position: relative;
            margin: 25px 0;
        }

        .form-wizard .wizard-form-text-label {
            position: absolute;
            left: 10px;
            top: 16px;
            transition: 0.2s linear all;
        }

        .form-wizard .focus-input .wizard-form-text-label {
            color: #d65470;
            top: -18px;
            transition: 0.2s linear all;
            font-size: 12px;
        }

        .form-wizard .form-wizard-steps {
            margin: 30px 0;
        }

        .form-wizard .form-wizard-steps li {
            width: 25%;
            float: left;
            position: relative;
        }

        .form-wizard .form-wizard-steps li::after {
            background-color: #f3f3f3;
            content: "";
            height: 5px;
            left: 0;
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 100%;
            border-bottom: 1px solid #dddddd;
            border-top: 1px solid #dddddd;
        }

        .form-wizard .form-wizard-steps li span {
            background-color: #dddddd;
            border-radius: 50%;
            display: inline-block;
            height: 40px;
            line-height: 40px;
            position: relative;
            text-align: center;
            width: 40px;
            z-index: 1;
        }

        .form-wizard .form-wizard-steps li:last-child::after {
            width: 50%;
        }

        .form-wizard .form-wizard-steps li.active span,
        .form-wizard .form-wizard-steps li.activated span {
            background-color: #d65470;
            color: #ffffff;
        }

        .form-wizard .form-wizard-steps li.active::after,
        .form-wizard .form-wizard-steps li.activated::after {
            background-color: #d65470;
            left: 50%;
            width: 50%;
            border-color: #d65470;
        }

        .form-wizard .form-wizard-steps li.activated::after {
            width: 100%;
            border-color: #d65470;
        }

        .form-wizard .form-wizard-steps li:last-child::after {
            left: 0;
        }

        .form-wizard .wizard-password-eye {
            position: absolute;
            right: 32px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        @keyframes click-radio-wave {
            0% {
                width: 25px;
                height: 25px;
                opacity: 0.35;
                position: relative;
            }

            100% {
                width: 60px;
                height: 60px;
                margin-left: -15px;
                margin-top: -15px;
                opacity: 0.0;
            }
        }

        @media screen and (max-width: 767px) {
            .wizard-content-left {
                height: auto;
            }
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
                        <li class="dropdown-item" style="cursor: pointer;"><a href="{{ url('login', []) }}"><i
                                    class="fa fa-tasks mr-2" style="float: right;"></i> Login</a></li>

                        <li class="dropdown-divider"></li>
                        <li class="dropdown-item" style="cursor: pointer;"><a href="{{ url('newcase', []) }}"><i
                            class="fa fa-tasks mr-2" style="float: right;"></i> Buat laporan</a></li>
                        <li class="dropdown-item" style="cursor: pointer;"><a href="{{ url('cek-status-laporan', []) }}"><i
                            class="fa fa-tasks mr-2" style="float: right;"></i> Status Laporan</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <div class="row mt-3">
            <section class="wizard-section">
                <div class="row no-gutters">
                    <div class="col-lg-4 col-md-6">
                        <div class="wizard-content-left d-flex justify-content-center align-items-center">
                            <h3>Membuat Laporan Baru</h3>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-6">
                        <div class="form-wizard">
                            <form action="#" method="post" role="form" id="form-case">
                                @csrf
                                <div class="form-wizard-header">
                                    <p>Form Pengisian Laporan * <span style="color: #d70b0b;">Perhatian Untuk Semua Harus Diisi</span></p>
                                    <ul class="list-unstyled form-wizard-steps clearfix">
                                        <li class="active"><span>1</span></li>
                                        <li><span>2</span></li>
                                        <li><span>3</span></li>
                                        <li><span>4</span></li>
                                    </ul>
                                </div>
                                <div>
                                    <fieldset class="wizard-fieldset show">
                                        <h5>Personal Cabang</h5>
                                        <div id="fix-data-cabang">
                                            <div class="form-group">
                                                <input type="text" class="form-control wizard-required"
                                                    name="cabang" id="caricabang" onkeydown="search(this)" required>
                                                <label for="fname" class="wizard-form-text-label">Cari Tujuan Cabang
                                                    * <span style="color: #d70b0b;"></span></label>
                                                <div class="wizard-form-error"></div>
                                                <input type="text" class="form-control wizard-required"
                                                    style="display: none">
                                            </div>
                                            <div class="row" id="tampil-data-cabang">
                                                <input type="text" class="form-control wizard-required"
                                                    style="display: none">

                                            </div>
                                        </div>
                                        <div class="form-group clearfix">
                                            <a href="javascript:;" class="form-wizard-next-btn float-right">Next</a>
                                        </div>
                                    </fieldset>
                                    <fieldset class="wizard-fieldset">
                                        <h5>Personal Information</h5>
                                        <div class="form-group">
                                            <input type="email" class="form-control wizard-required" id="email" name="nama">
                                            <label for="email" class="wizard-form-text-label">Nama Personal
                                                *</label>
                                            <div class="wizard-form-error"></div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control wizard-required"
                                                id="username" name="nip">
                                            <label for="username" class="wizard-form-text-label">NIP *</label>
                                            <div class="wizard-form-error"></div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control wizard-required"
                                                name="divisi">
                                            <label for="pwd" class="wizard-form-text-label">Divisi *</label>
                                            <div class="wizard-form-error"></div>
                                            <span class="wizard-password-eye"><i class="far fa-eye"></i></span>
                                        </div>
                                        {{-- <div class="form-group">
                                            <input type="text" class="form-control wizard-required"
                                                id="cpwd">
                                            <label for="cpwd" class="wizard-form-text-label">Bagian *</label>
                                            <div class="wizard-form-error"></div>
                                        </div> --}}
                                        <div class="form-group clearfix">
                                            <a href="javascript:;"
                                                class="form-wizard-previous-btn float-left">Previous</a>
                                            <a href="javascript:;" class="form-wizard-next-btn float-right">Next</a>
                                        </div>
                                    </fieldset>
                                    <fieldset class="wizard-fieldset">
                                        <h5>Deskripsi Laporan</h5>
                                        <div class="form-group">
                                            <select name="tingkat_laporan" class="form-control wizard-required" id="">
                                                <option value=""></option>
                                                <option value="1">Rendah</option>
                                                <option value="2">Sedang</option>
                                                <option value="3">Tinggi</option>
                                            </select>
                                            <label for="bname" class="wizard-form-text-label">Tingkat Laporan</label>
                                            <div class="wizard-form-error"></div>
                                        </div>
                                        <div class="form-group">
                                            <select name="kategori_laporan" class="form-control wizard-required" id="">
                                                <option value=""></option>
                                                <option value="ER-001">Software</option>
                                                <option value="ER-002">Hardware</option>
                                            </select>
                                            <label for="bname" class="wizard-form-text-label">Kategori</label>
                                            <div class="wizard-form-error"></div>
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control wizard-required" id="summernoteEditor" cols="30" rows="10" name="deskripsi"></textarea>
                                            <label for="bname" class="wizard-form-text-label">Deskripsi *</label>
                                            <div class="wizard-form-error"></div>
                                        </div>

                                        <div class="form-group clearfix">
                                            <a href="javascript:;"
                                                class="form-wizard-previous-btn float-left">Previous</a>
                                            <a href="javascript:;" class="form-wizard-next-btn float-right">Next</a>
                                        </div>
                                    </fieldset>
                                    <fieldset class="wizard-fieldset">
                                        <h5>Detail Information</h5>

                                        <div class="form-group">
                                            <input type="text" name="email" class="form-control wizard-required" id="email"
                                                required>
                                            <label for="honame" class="wizard-form-text-label">Email </label>
                                            <div class="wizard-form-error"></div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="telegram" class="form-control wizard-required" id="no_telegram"
                                                required>
                                            <label for="honame" class="wizard-form-text-label">Telegram </label>
                                            <div class="wizard-form-error"></div>
                                        </div>

                                        <div class="form-group clearfix" id="loading-button">
                                            <a href="javascript:;"
                                                class="form-wizard-previous-btn float-left">Previous</a>
                                            <a href="#" class="form-wizard-submit float-right"
                                                id="button-simpan-kasus">Submit</a>
                                        </div>
                                    </fieldset>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!--Start Back To Top Button-->
        <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
        <!--End Back To Top Button-->

    </div><!--wrapper-->

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/public.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js', ) }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js', ) }}"></script>
    <script src="{{ asset('assets/js/horizontal-menu.js', ) }}"></script>
    <script src="{{ asset('assets/js/app-script.js', ) }}"></script>
    <script src="{{ asset('assets/plugins/alerts-boxes/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/alerts-boxes/js/sweet-alert-script.js') }}"></script>
    <script>
        $(document).on("click", "#button-simpan-kasus", function(e) {
            e.preventDefault();
            var data = $("#form-case").serialize();
            $("#loading-button").html(
                '<span class="badge badge-info m-1">Mohon Menunggu..</span>'
            );
            setTimeout(() => {
                $.ajax({
                        url: 'simpan-newcase',
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf"]').attr("content"),
                        },
                        type: "POST",
                        data: data,
                        dataType: "html",
                    })
                    .done(function(datapdf) {
                        swal("Berhasil Input", "Dengan Nomor Tiket : " +datapdf+"-", "success");
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    })
                    .fail(function() {
                        // console.log(data);
                        $("#show-modal-view-dashboard").html(
                            'Gagal Baca'
                        );
                    });
            }, 1500);
        });
    </script>
    <script src="{{ asset('assets/plugins/summernote/dist/summernote-bs4.min.js', []) }}"></script>
    <script>
     $('#summernoteEditor').summernote({
              height: 400,
              tabsize: 2
          });
    </script>
</body>

</html>
