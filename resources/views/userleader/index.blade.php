@php $jumlahtugashariini = 0; @endphp
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
            text-align: justify;
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
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumb-->
        <div class="row pt-2 pb-0">
            <div class="col-sm-12">
                <h4 class="page-title">Profil User</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javaScript:void();">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="javaScript:void();">Pages</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ auth::user()->name }}
                    </li>
                </ol>
            </div>

        </div>
        @if ($message = Session::get('sukses'))
            {{-- <div class="alert alert-icon-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <div class="alert-icon icon-part-success">
                    <i class="fa fa-check"></i>
                </div>
                <div class="alert-message">
                    <span><strong>Success!</strong> {{ $message }} </span>
                </div>
            </div> --}}
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
        @endif

        @php
            $cekbio = DB::table('tbl_biodata')
                ->where('id_user', auth::user()->id_user)
                ->get();
        @endphp

        @if ($cekbio->isEmpty())
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="signupForm" action="{{ asset('user/lengkapi/data', []) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <h4 class="form-header text-uppercase">
                                    <i class="fa fa-address-book-o"></i>
                                    Lengkapi Profile
                                </h4>
                                <div class="form-group row">
                                    <label for="input-10" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="input-10" name="nama_lengkap" />
                                    </div>
                                    <label for="input-11" class="col-sm-2 col-form-label">NIP</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="input-11" name="nip" />
                                    </div>
                                </div>

                                <h4 class="form-header text-uppercase">
                                    <i class="fa fa-envelope-o"></i>
                                    Contact Info & Bio
                                </h4>
                                <div class="form-group row">
                                    <label for="input-12" class="col-sm-2 col-form-label">Tempat Lahir</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="input-12" name="tempat_lahir" />
                                    </div>
                                    <label for="input-13" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                    <div class="col-sm-4">
                                        <input type="date" class="form-control" id="input-13" name="tgl_lahir" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-14" class="col-sm-2 col-form-label">E-mail</label>
                                    <div class="col-sm-4">
                                        <input type="email" class="form-control" name="email" />
                                    </div>
                                    <label for="input-14" class="col-sm-2 col-form-label">No HP / WA</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="input-14" name="nomor_hp" />
                                    </div>
                                </div>

                                <div class="form-group row">

                                    <label for="input-15" class="col-sm-2 col-form-label">Pilih Photo Profil</label>
                                    <div class="col-sm-4">
                                        <input type="file" class="form-control" id="input-15" name="gambar" />
                                    </div>
                                    <label for="input-16" class="col-sm-2 col-form-label">Pilih Cabang</label>
                                    <div class="col-sm-4">
                                        <select name="cabang" class="form-control single-select">
                                            <option value="">Pilih Asal Cabang</option>
                                            @foreach ($cabang as $item)
                                                <option value="{{ $item->kd_cabang }}">{{ $item->nama_cabang }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="input-17" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="4" id="input-17" name="alamat"></textarea>
                                    </div>
                                </div>
                                <div class="form-footer">

                                    <button type="submit" class="btn btn-success" style="float: right;">
                                        <i class="fa fa-check-square-o"></i> Simpan Biodata
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-lg-4">
                    <div class="card profile-card-2">
                        <div class="card-img-block rounded-0 texture-info">

                        </div>

                        <div class="card-body pt-5">
                            <img src="{{ asset('storage/' . $biodata->gambar) }}" alt="profile-image"
                                class="profile" />
                            <h5 class="card-title">{{ $biodata->nama_lengkap }}</h5>
                            <p class="card-text">
                                Welcome to the IT activity log application.
                            </p>

                            <div class="icon-block">
                                <a href="javascript:void();"><i class="fa fa-facebook bg-facebook text-white"></i></a>
                                <a href="javascript:void();">
                                    <i class="fa fa-twitter bg-twitter text-white"></i></a>
                                <a href="javascript:void();">
                                    <i class="fa fa-google-plus bg-google-plus text-white"></i></a>
                            </div>
                        </div>

                        <div class="btn-group float-sm-right" style="padding: 0px;">

                            <span class="btn btn-light dropdown-toggle-split rounded-0 texture-info" style="cursor: pointer;" data-toggle="modal" data-target="#modal-cabang-user" id="button-hendle-cabang-user">
                                {{-- <span class="caret"></span> --}}
                                <i class="fa fa-search"> </i>Cabang
                            </span>

                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
                                <li class="nav-item">
                                    <a href="javascript:void();" data-target="#profile" data-toggle="pill"
                                        class="nav-link active"><i class="icon-user"></i>
                                        <span class="hidden-xs">Profile</span></a>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:void();" data-target="#messages" data-toggle="pill"
                                        class="nav-link"><i class="fa fa-file-text-o"></i>
                                        <span class="hidden-xs">Score KPI</span></a>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:void();" data-target="#edit" data-toggle="pill"
                                        class="nav-link"><i class="icon-note"></i>
                                        <span class="hidden-xs">Edit</span></a>
                                </li>
                            </ul>
                            <div class="tab-content p-3">
                                <div class="tab-pane active" id="profile">
                                    <h5 class="mb-3">User Profile</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 style="text-decoration: underline;">Nomor Induk Pegawai</h6>
                                            <p>{{ $biodata->nip }}</p>
                                            <h6 style="text-decoration: underline;">Tempat / Tanggal Lahir</h6>
                                            <p>
                                                {{ $biodata->tempat_lahir }} / {{ $biodata->tgl_lahir }}
                                            </p>
                                            <h6 style="text-decoration: underline;">Alamat</h6>
                                            <p>
                                                {{ $biodata->alamat }}
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 style="text-decoration: underline;">Cabang Group</h6>
                                            @foreach ($groupcabang as $groupcabang)
                                                <a href="javascript:void();"
                                                    class="badge badge-dark badge-pill">{{ $groupcabang->nama_cabang }}</a>
                                            @endforeach

                                            <hr />
                                            <button class="btn-warning" data-toggle="modal"
                                                data-target="#input_tiketxx" id="buttonmemberitugasuser"><i
                                                    class="fa fa-pencil"></i> Beri Tugas</button>
                                            <button class="btn-dark" data-toggle="modal" data-target="#showtask"
                                                id="buttonlihattugasuser"><i class="fa fa-eye"></i> Lihat
                                                Tugas</button>


                                        </div>
                                        <div class="col-md-12">
                                            <h5 class="mt-2 mb-3">
                                                <span class="fa fa-clock-o ion-clock float-right"></span>
                                                Task Group
                                            </h5>
                                            @foreach ($groupworklist as $groupworklist)
                                                <div class="alert alert-danger alert-dismissible" role="alert"
                                                    style="cursor: pointer;" data-toggle="modal"
                                                    data-target="#input_tiketxx" id="buttontiketgroup"
                                                    data-id="{{ $groupworklist->id_tiket_group_worklist }}">
                                                    {{-- <button type="button" class="close" data-dismiss="alert">&times;</button> --}}
                                                    <div class="alert-icon contrast-alert">
                                                        <button><i class="fa fa-exclamation-triangle"></i></button>
                                                    </div>
                                                    <div class="alert-message" style="text-align: justify;">
                                                        <span><strong>Tugas Group :</strong> <span
                                                                style="color: black;">{{ $groupworklist->nama_worklist }}</span>
                                                            <strong>Dengan
                                                                No Tiket :</strong> <span
                                                                style="color: black;">{{ $groupworklist->no_tiket }}</span></span>
                                                    </div>
                                                </div>
                                                @php $jumlahtugashariini = $jumlahtugashariini + 1; @endphp
                                            @endforeach
                                            @foreach ($worklistperson as $worklistperson)
                                                @if (substr($worklistperson->tgl_buat, 0, 10) == date('Y-m-d'))
                                                    <div class="alert alert-warning alert-dismissible" role="alert"
                                                        style="cursor: pointer;" data-toggle="modal"
                                                        data-target="#input_tiketxx" id="buttontiketpersonal"
                                                        data-id="{{ $worklistperson->id_tiket_worklist_person }}">
                                                        <div class="alert-icon contrast-alert">
                                                            <button><i class="fa fa-exclamation-triangle"></i></button>
                                                        </div>
                                                        <div class="alert-message">
                                                            <span><strong>Tugas Baru : </strong> <span
                                                                    style="color: black;">{{ $worklistperson->nama_worklist }}</span>
                                                                Dengan
                                                                No
                                                                Tiket <span
                                                                    style="color: black">{{ $worklistperson->no_tiket }}</span></span>
                                                        </div>
                                                    </div>
                                                    @php $jumlahtugashariini = $jumlahtugashariini + 1; @endphp
                                                @endif
                                            @endforeach
                                            @foreach ($datalaporan as $datalaporan)
                                                <div class="alert alert-danger alert-dismissible" role="alert"
                                                    style="cursor: pointer;" data-toggle="modal"
                                                    data-target="#showtask" id="buttontiketlaporan"
                                                    data-id="{{ $datalaporan->id_tiket_laporan }}">
                                                    <div class="alert-icon contrast-alert">
                                                        <button><i class="fa fa-envelope"></i></button>
                                                    </div>
                                                    <div class="alert-message">
                                                        <span><strong>Tugas Baru : </strong> <span
                                                                style="color: black;">{{ $datalaporan->kd_kinerja }}</span>
                                                        </span>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <hr>

                                        </div>
                                    </div>
                                    <!--/row-->
                                </div>

                                <div class="tab-pane" id="messages">
                                    <div style="float: right;">
                                        <button data-toggle="modal" data-target="#input_tiketxx" id="printkpi"
                                            href="{{ asset('user/userleader/pdf/kpi') }}"
                                            class="btn-info mb-5 ml-2"><i class="fa fa-print"></i> Cetak</a>
                                            <button class="btn-warning mb-5 ml-2"><i class="fa fa-send"></i></button>
                                    </div>
                                    <br><br>
                                    <h6 class="mb-3">A. Kinerja Team</h6>
                                    <div class="card">
                                        <table class="styled-table">
                                            <tbody>
                                                @foreach ($tbl_kinerja as $item)
                                                    @if ($item->jenis_kinerja == 1)
                                                        <tr>
                                                            <td>{{ $item->kinerja }} </td>
                                                            <td><span class="float-right font-weight-bold">0</span>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                    <h6 class="mb-3 pt-3">B. Kinerja Individu</h6>
                                    <div class="card">
                                        <table class="styled-table">
                                            <tbody>
                                                @foreach ($tbl_kinerja as $item1)
                                                    @if ($item1->jenis_kinerja == 2)
                                                        <tr>
                                                            <td>{{ $item1->kinerja }}</td>
                                                            <td>
                                                                <span class="float-right font-weight-bold">0</span>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane" id="edit">
                                    <form>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Nama
                                                Lengkap</label>
                                            <div class="col-lg-9">
                                                <input class="form-control" type="text"
                                                    value="{{ $biodata->nama_lengkap }}" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Tanggal
                                                Lahir</label>
                                            <div class="col-lg-9">
                                                <input class="form-control" type="text"
                                                    value="{{ $biodata->tgl_lahir }}" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Tempat
                                                Lahir</label>
                                            <div class="col-lg-9">
                                                <input class="form-control" type="email"
                                                    value="{{ $biodata->tempat_lahir }}" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label"> Ganti
                                                Profil</label>
                                            <div class="col-lg-9">
                                                <input class="form-control" type="file" />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Alamat</label>
                                            <div class="col-lg-9">
                                                <textarea name="" id="" cols="30" rows="10" class="form-control">{{ $biodata->alamat }}</textarea>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Username</label>
                                            <div class="col-lg-9">
                                                <input class="form-control" type="text"
                                                    value="{{ $biodata->email }}" disabled />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label"></label>
                                            <div class="col-lg-9">
                                                <input type="reset" class="btn btn-secondary" value="Cancel" />
                                                <input type="button" class="btn btn-primary" value="Save Changes" />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif




        {{-- <h6 class="text-uppercase">Status Tugas</h6>
        <hr />
        <div class="row">
            <div class="col-12 col-lg-4 col-xl-4">
                <div class="card texture-wave-b rounded-0">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body">
                                <h5 class="mb-0 text-white">{{ $jumlahtugashariini }}</h5>
                                <p class="mb-0 text-white">Tugas Hari ini</p>
                            </div>
                            <div class="w-icon">
                                <i class="fa fa-tasks text-white"></i>
                            </div>
                        </div>
                        <div class="progress-wrapper mt-3">
                            <div class="progress mb-0" style="height: 5px">
                                @if ($tugashariini == 0)
                                    <div class="progress-bar bg-white" role="progressbar" style="width: 100%"></div>
                                @else
                                    <div class="progress-bar bg-white" role="progressbar"
                                        style="width: {{ 100 - ($jumlahtugashariini * 100) / ($jumlahtugashariini + $tugashariini) }}%">
                                    </div>
                                @endif

                            </div>
                            @if ($tugashariini == 0)
                                <p class="extra-small-font text-white"> 100 % </p>
                            @else
                                <p class="extra-small-font text-white">
                                    {{ 100 - ($jumlahtugashariini * 100) / ($jumlahtugashariini + $tugashariini) }} %
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 col-xl-4">
                <div class="card texture-wave-f rounded-0">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body">
                                <h5 class="mb-0 text-white">{{ $tugasbelumselesai }}</h5>
                                <p class="mb-0 text-white">Total Tugas Tidak Selesai</p>
                            </div>
                            <div class="w-icon">
                                <i class="fa fa-warning text-white"></i>
                            </div>
                        </div>
                        <div class="progress-wrapper mt-3">
                            <div class="progress mb-0" style="height: 5px">
                                <div class="progress-bar bg-white" role="progressbar"
                                    style="width: {{ $persenbelumselesai }}%"></div>
                            </div>
                            <p class="extra-small-font text-white">
                                {{ $persenbelumselesai }} %
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 col-xl-4">
                <div class="card texture-wave-c rounded-0">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body">
                                <h5 class="mb-0 text-white">{{ $tugasselesai }}</h5>
                                <p class="mb-0 text-white">Total Tugas Selesai</p>
                            </div>
                            <div class="w-icon">
                                <i class="zmdi zmdi-thumb-up text-white"></i>
                            </div>
                        </div>
                        <div class="progress-wrapper mt-3">
                            <div class="progress mb-0" style="height: 5px">
                                <div class="progress-bar bg-white" role="progressbar"
                                    style="width: {{ $persenselesai }}%"></div>
                            </div>
                            <p class="extra-small-font text-white">
                                {{ $persenselesai }} %
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="row">
            <div class="col-12 col-lg-12 col-xl-12">


                <div class="card">
                    <div class="card-header text-uppercase">Column Chart
                        <div class="card-action">
                            <div class="dropdown">
                                <a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret"
                                    data-toggle="dropdown">
                                    <i class="icon-options"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="javaScript:void();" class="dropdown-item" data-toggle="modal"
                                        data-target="#input_tiketxx" id="buttoninputlaporan"><i
                                            class="fa fa-exclamation-circle"></i> Input Laporan</a>
                                    <a class="dropdown-item" href="javascript:void();">Another action</a>
                                    <a class="dropdown-item" href="javascript:void();">Something else here</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="javaScript:void();" class="dropdown-item" data-toggle="modal"
                                        data-target="#inputtiketbaruadmin" id="buttonadminbuattiket"><i
                                            class="fa fa-tasks"></i>
                                        Buat Tiket</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="chart3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="input_tiketxx">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-danger" id="bodyformdatainputtiket">

            <img src="{{ asset('gif.gif') }}" alt="" srcset="">

        </div>
    </div>
</div>

<div class="modal fade" id="showtask">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content border-danger" id="lihatdatatask">

            <img src="{{ asset('gif.gif') }}" alt="" srcset="">

        </div>
    </div>
</div>

<div class="modal fade" id="modal-cabang-user">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content border-danger" id="menu-data-cabang-user" style="border: 0px; background: transparent;">

            <img src="{{ asset('gif.gif') }}" alt="" srcset="">

        </div>
    </div>
</div>

<script src="{{ asset('js/user-app.js', []) }}"></script>
<script src="assets/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script>
    $().ready(function() {

        $("#personal-info").validate();

        // validate signup form on keyup and submit
        $("#signupForm").validate({
            rules: {

                nama_lengkap: "required",
                nip: "required",
                gambar: "required",
                cabang: "required",


                username: {
                    required: true,
                    minlength: 2
                },
                password: {
                    required: true,
                    minlength: 5
                },
                confirm_password: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                },
                email: {
                    required: true,
                    email: true
                },
                contactnumber: {
                    required: true,
                    minlength: 10
                },
                topic: {
                    required: "#newsletter:checked",
                    minlength: 2
                },
                nomor_hp: "required",
                agree: "required"

            },
            messages: {
                nomor_hp: "Masukan No Wa Yang Benar",
                nama_lengkap: "Masukan Nama Lengkap Dengan Benar .  ",
                nip: "Masukan NIP Dengan Benar",
                gambar: "Masukan Photo Profil",
                cabang: "Pilih Salah Satu Cabang",


                username: {
                    required: "Please enter a username",
                    minlength: "Your username must consist of at least 2 characters"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                confirm_password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long",
                    equalTo: "Please enter the same password as above"
                },
                email: "Masukan email Yang Valid",
                contactnumber: "Masukan Nomor Dengan Angka",
                agree: "Please accept our policy",
                topic: "Please select at least 2 topics"
            }
        });

    });
</script>
<script>
    $(document).ready(function() {
        $('.single-select').select2();
    });
</script>
<script src="{{ asset('assets/plugins/apexcharts/apexcharts.js', []) }}"></script>

<script>
    $(function() {
        "use strict";




        // chart 8

        var options = {
            chart: {
                height: 350,
                type: 'bar',
                foreColor: '#4e4e4e',
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            grid: {
                show: true,
                borderColor: 'rgba(255, 255, 255, 0.00)',
            },
            series: [{
                name: 'Total Tiket',
                data: [
                    @foreach ($periode as $periodtotal)
                        @php
                            $totaldatatiketperson = DB::table('tbl_tiket_person_worklist')
                                ->whereBetween('tgl_buat', [$periodtotal->awal_tgl, $periodtotal->akhir_tgl])
                                ->count();
                            $totaldatatiketgroup = DB::table('tbl_tiket_group_worklist')
                                ->whereBetween('tgl_buat', [$periodtotal->awal_tgl, $periodtotal->akhir_tgl])
                                ->count();
                            $totaltiket = $totaldatatiketperson + $totaldatatiketgroup;
                        @endphp
                            '{{ $totaltiket }}',
                    @endforeach
                ]
            }, {
                name: 'Selesai',
                data: [
                    @foreach ($periode as $periodtota2)
                        @php
                            $totaldatatiketpersonselesai = DB::table('tbl_tiket_person_worklist')
                                ->where('status_tiket', 2)
                                ->whereBetween('tgl_buat', [$periodtota2->awal_tgl, $periodtota2->akhir_tgl])
                                ->count();
                            $totaldatatiketgroupselesai = DB::table('tbl_tiket_group_worklist')
                                ->where('status_tiket', 2)
                                ->whereBetween('tgl_buat', [$periodtota2->awal_tgl, $periodtota2->akhir_tgl])
                                ->count();
                            $totaltiketselesai = $totaldatatiketpersonselesai + $totaldatatiketgroupselesai;
                        @endphp
                            '{{ $totaltiketselesai }}',
                    @endforeach
                ]
            }, {
                name: 'Tidak',
                data: [
                    @foreach ($periode as $periodtota3)
                        @php
                            $totaldatatiketpersontidakselesai = DB::table('tbl_tiket_person_worklist')
                                ->where('status_tiket', 0)
                                ->whereBetween('tgl_buat', [$periodtota3->awal_tgl, $periodtota3->akhir_tgl])
                                ->count();
                            $totaldatatiketgrouptidakselesai = DB::table('tbl_tiket_group_worklist')
                                ->where('status_tiket', 0)
                                ->whereBetween('tgl_buat', [$periodtota3->awal_tgl, $periodtota3->akhir_tgl])
                                ->count();
                            $totaltikettidakselesai = $totaldatatiketpersontidakselesai + $totaldatatiketgrouptidakselesai;
                        @endphp
                            '{{ $totaltikettidakselesai }}',
                    @endforeach
                ]
            }],
            xaxis: {
                categories: [
                    @foreach ($periode as $periodenama)
                        '{{ $periodenama->bulan }} - {{ $periodenama->tahun }}',
                    @endforeach
                ],
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    gradientToColors: ['#00c8ff', '#08a50e', '#7f00ff'],
                    shadeIntensity: 1,
                    type: 'horizontal',
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 100, 100, 100]
                },
            },
            colors: ["#0072ff", "#cddc35", "#e100ff"],
            tooltip: {
                theme: 'dark',
                y: {
                    formatter: function(val) {
                        return "" + val + " Tiket"
                    }
                }
            }
        }

        var chart = new ApexCharts(
            document.querySelector("#chart3"),
            options
        );

        chart.render();



    });
</script>
