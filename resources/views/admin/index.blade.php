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

    @media only screen and (min-width: 260px) {

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
        <div class="row pt-2 pb-2">
            <div class="col-sm-12">
                <h4 class="page-title">Dashboard Admin</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javaScript:void();">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javaScript:void();">Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Home</li>
                </ol>
            </div>

        </div>
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
        <div class="row mt-3">
            <div class="col-12 col-lg-4 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <p class="mb-0 text-primary">
                            <i class="fa fa-user-circle-o"> </i> - Data User
                            <span class="float-right badge badge-primary">memo</span>
                        </p>
                        <div class="">
                            <h4 class="mb-0 py-3 text-primary">
                                {{ $user->count() }}
                                <span class="float-right"><i class="fa fa-search" style="cursor: pointer;"
                                        data-toggle="modal" data-target="#showdatamaps" id="datauseradmin"></i></span>
                            </h4>
                        </div>
                        <div class="progress-wrapper">
                            <div class="progress" style="height: 5px">
                                <div class="progress-bar bg-primary" style="width: 0%"></div>
                            </div>
                        </div>
                        <p class="mb-0 mt-2 small-font">
                            Persentase Kapasitas
                            <span class="float-right">+0% <i class="fa fa-long-arrow-up"></i></span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <p class="text-success mb-0">
                            <i class="fa fa-home"> </i> - Data Cabang
                            <span class="float-right badge badge-success">memo</span>
                        </p>
                        <div class="">
                            <h4 class="mb-0 py-3 text-success">
                                {{ $cabang->count() }}
                                <span class="float-right"><i class="fa fa-search" style="cursor: pointer;"
                                        data-toggle="modal" data-target="#showdatamaps" id="datacabang"></i></span>
                            </h4>
                        </div>
                        <div class="progress-wrapper">
                            <div class="progress" style="height: 5px">
                                <div class="progress-bar bg-success" style="width: 0%"></div>
                            </div>
                        </div>
                        <p class="mb-0 mt-2 small-font">
                            Persentase Kapasitas
                            <span class="float-right">+0% <i class="fa fa-long-arrow-up"></i></span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <p class="text-info mb-0">
                           <i class="fa fa-users"></i> - Data Grup Cabang
                            <span class="float-right badge badge-info">memo</span>
                        </p>
                        <div class="">
                            <h4 class="mb-0 py-3 text-info">
                                {{$group}}
                                <span class="float-right"><i class="fa fa-search" style="cursor: pointer;"
                                        data-toggle="modal" data-target="#showdatamaps" id="datagroup"></i></span>
                            </h4>
                        </div>
                        <div class="progress-wrapper">
                            <div class="progress" style="height: 5px">
                                <div class="progress-bar bg-info" style="width: 0%"></div>
                            </div>
                        </div>
                        <p class="mb-0 mt-2 small-font">
                            Compare to last week
                            <span class="float-right">+0% <i class="fa fa-long-arrow-up"></i></span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <p class="text-danger mb-0">
                            <i class="fa fa-calendar-o"> </i> - Data Periode
                            <span class="float-right badge badge-danger">memo</span>
                        </p>
                        <div class="">
                            <h4 class="mb-0 py-3 text-danger">
                                {{$periode->count()}}
                                <span class="float-right"><i class="fa fa-search" style="cursor: pointer;"
                                        data-toggle="modal" data-target="#showdatamaps" id="dataperiode"></i></span>
                            </h4>
                        </div>
                        <div class="progress-wrapper">
                            <div class="progress" style="height: 5px">
                                <div class="progress-bar bg-danger" style="width: 0%"></div>
                            </div>
                        </div>
                        <p class="mb-0 mt-2 small-font">
                            -
                            <span class="float-right">+0% <i class="fa fa-long-arrow-up"></i></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!--End Row-->

        <div class="row">
            <div class="col-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header text-uppercase">Column Chart
                        <div class="card-action">
                            <div class="dropdown">
                                <button class="dropdown-toggle-nocaret btn-dark" data-toggle="dropdown">
                                    <i class="icon-options"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="javaScript:void();" class="dropdown-item" data-toggle="modal" data-target="#modal-dashboard-admin" id="button-view-data-admin"><i
                                            class="fa fa-tasks"></i>View Data</a>
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
        <div class="row">
            <div class="col-12 col-lg-4 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <h3 class="mt-3 mb-0">{{ $dataindividu }}</h3>
                                <p class="mb-0">Kinerja Individu</p>
                            </div>
                            <div class="card-content dash-array-chart-box">
                                <div id="screening-calls"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <h3 class="mt-3 mb-0">{{ $datateam }}</h3>
                                <p class="mb-0">Kinerja Team</p>
                            </div>
                            <div class="card-content dash-array-chart-box">
                                <div id="assignments"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <h3 class="mt-3 mb-0">0</h3>
                                <p class="mb-0">Data Kinerja</p>
                            </div>
                            <div class="card-content dash-array-chart-box">
                                <div id="interviews"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 col-xl-4">
                <div class="card">
                    <div class="card-header text-uppercase text-center">Database</div>
                    <div class="card-body">
                        <div class="text-center">
                            <div class="chart-container-9 d-flex align-items-center justify-content-center">
                                <div id="vacancy-status"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row align-items-center text-center">
                            <div class="col border-right border-light">
                                <h4 class="mb-0 text-dark">0</h4>
                                <small class="extra-small-font">Filled Vacancies</small>
                            </div>
                            <div class="col">
                                <h4 class="mb-0 text-dark">0</h4>
                                <small class="extra-small-font">Total Vacancies</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 col-xl-4">
                <div class="card">
                    <div class="card-header text-uppercase text-center">Top User</div>
                    <div class="card-body p-0">
                        <div class="">
                            <div id="top-refefrers"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
        {{-- <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <div class="card-header border-0">
                        Recent Actifity Today
                        <div class="card-action">
                            <div class="dropdown">
                                <a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret"
                                    data-toggle="dropdown">
                                    <i class="icon-options"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="javascript:void();">Action</a>
                                    <a class="dropdown-item" href="javascript:void();">Another action</a>
                                    <a class="dropdown-item" href="javascript:void();">Something else here</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:void();">Separated link</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Nama</th>
                                    <th>Nomor Tiket</th>
                                    <th>Tanggal Tiket</th>
                                    <th>Status Tiket</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <img alt="Image placeholder" src="https://via.placeholder.com/110x110"
                                            class="product-img" />
                                    </td>
                                    <td>Ahmad Soleh</td>
                                    <td>129383</td>
                                    <td>
                                        2
                                    </td>
                                    <td>
                                        <span class="badge-dot">
                                            <i class="bg-danger"></i> pending
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn-success"><i class="fa fa-whatsapp"></i></button>
                                        <button class="btn-success"><i class="fa fa-envelope-o"></i></button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> --}}

        <!--End Row-->
        <!--start overlay-->
        <div class="overlay toggle-menu"></div>

        <!--start overlay-->
        <div class="overlay toggle-menu"></div>
        <!--end overlay-->
    </div>
    <!-- End container-fluid-->

</div>
<div class="modal fade" id="showdatamaps">
    <div class="modal-dialog modal-dialog-centered modal-xl" id="bodyformdatamapscabang">
        <div class="modal-content border-danger" style="background: transparent;">
            <div class="text-center">
                <img src="{{ asset('loading1.gif', []) }}" alt="" srcset="" width="250"
                    style="height: auto;">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-dashboard-admin">
    <div class="modal-dialog modal-dialog-centered modal-xl" id="show-menu-dashboard-admin">
        <div class="modal-content border-danger">
            <div class="text-center">
                <img src="{{ asset('loading1.gif', []) }}" alt="" srcset="" width="250"
                    style="height: auto;">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modaladmin">
    <div class="modal-dialog modal-dialog-centered modal-xl" id="showmodaladmin">
        <div class="modal-content border-danger" style="background: transparent;">
            <div class="text-center">
                <img src="{{ asset('loading1.gif', []) }}" alt="" srcset="" width="250"
                    style="height: auto;">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="inputtiketbaruadmin">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-danger" id="bodyformdatatiket">

            loading ..

        </div>
    </div>
</div>
<script src="{{ asset('js/admin-app.js', []) }}"></script>
<script>
    $(document).ready(function() {
        //Default data table
        $("#default-datatable").DataTable();
        $("#default-datatable1").DataTable();

        var table = $("#example").DataTable({
            lengthChange: false,
            buttons: ["copy", "excel", "pdf", "print", "colvis"],
        });

        table
            .buttons()
            .container()
            .appendTo("#example_wrapper .col-md-6:eq(0)");
    });
</script>
<script src="{{ asset('assets/plugins/apexcharts/apexcharts.js', []) }}"></script>
<script>
    $(function() {
        "use strict";

        var options = {
            chart: {
                width: 180,
                //height: 150,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    //startAngle: -135,
                    //endAngle: 135,
                    hollow: {
                        margin: 0,
                        size: '65%',
                        background: '#fff',
                        image: undefined,
                        imageOffsetX: 0,
                        imageOffsetY: 0,
                        position: 'front',
                        dropShadow: {
                            enabled: true,
                            top: 3,
                            left: 0,
                            blur: 4,
                            opacity: 0.1
                        }
                    },
                    track: {
                        background: '#fff',
                        strokeWidth: '100%',
                        margin: 0, // margin is in pixels
                        dropShadow: {
                            enabled: true,
                            top: -3,
                            left: 0,
                            blur: 4,
                            opacity: 0.1
                        }
                    },
                    dataLabels: {
                        name: {
                            fontSize: '14px',
                            color: '#000',
                            offsetY: -10,
                            show: false
                        },
                        value: {
                            offsetY: 6,
                            fontSize: '20px',
                            color: '#000',
                            formatter: function(val) {
                                return val + "%";
                            }
                        }
                    }
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    shadeIntensity: 0.15,
                    gradientToColors: ['#f14793'],
                    inverseColors: false,
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 50, 65, 91]
                },
            },
            stroke: {
                dashArray: 4,
            },
            colors: ["#5204ce"],
            series: ['{{ round($persendataindividuselesai) }}'],
            labels: ['Screening Calls'],

        }

        var chart = new ApexCharts(
            document.querySelector("#screening-calls"),
            options
        );

        chart.render();

        // chart 4

        var options = {
            chart: {
                width: 180,
                //height: 150,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    //startAngle: -135,
                    //endAngle: 135,
                    hollow: {
                        margin: 0,
                        size: '65%',
                        background: '#fff',
                        image: undefined,
                        imageOffsetX: 0,
                        imageOffsetY: 0,
                        position: 'front',
                        dropShadow: {
                            enabled: true,
                            top: 3,
                            left: 0,
                            blur: 4,
                            opacity: 0.1
                        }
                    },
                    track: {
                        background: '#fff',
                        strokeWidth: '100%',
                        margin: 0, // margin is in pixels
                        dropShadow: {
                            enabled: true,
                            top: -3,
                            left: 0,
                            blur: 4,
                            opacity: 0.1
                        }
                    },
                    dataLabels: {
                        name: {
                            fontSize: '14px',
                            color: '#000',
                            offsetY: -10,
                            show: false
                        },
                        value: {
                            offsetY: 6,
                            fontSize: '20px',
                            color: '#000',
                            formatter: function(val) {
                                return val + "%";
                            }
                        }
                    }
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    shadeIntensity: 0.15,
                    gradientToColors: ['#ff5447'],
                    inverseColors: false,
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 50, 65, 91]
                },
            },
            stroke: {
                dashArray: 4,
            },
            colors: ["#f1076f"],
            series: ['{{ $persendatateamselesai }}'],
            labels: ['Assignments'],

        }

        var chart = new ApexCharts(
            document.querySelector("#assignments"),
            options
        );

        chart.render();

        // chart 5

        var options = {
            chart: {
                width: 180,
                //height: 150,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    //startAngle: -135,
                    //endAngle: 135,
                    hollow: {
                        margin: 0,
                        size: '65%',
                        background: '#fff',
                        image: undefined,
                        imageOffsetX: 0,
                        imageOffsetY: 0,
                        position: 'front',
                        dropShadow: {
                            enabled: true,
                            top: 3,
                            left: 0,
                            blur: 4,
                            opacity: 0.1
                        }
                    },
                    track: {
                        background: '#fff',
                        strokeWidth: '100%',
                        margin: 0, // margin is in pixels
                        dropShadow: {
                            enabled: true,
                            top: -3,
                            left: 0,
                            blur: 4,
                            opacity: 0.1
                        }
                    },
                    dataLabels: {
                        name: {
                            fontSize: '14px',
                            color: '#000',
                            offsetY: -10,
                            show: false
                        },
                        value: {
                            offsetY: 6,
                            fontSize: '20px',
                            color: '#000',
                            formatter: function(val) {
                                return val + "%";
                            }
                        }
                    }
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    shadeIntensity: 0.15,
                    gradientToColors: ['#0575e6'],
                    inverseColors: false,
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 50, 65, 91]
                },
            },
            stroke: {
                dashArray: 4,
            },
            colors: ["#00f260"],
            series: [0],
            labels: ['interviews'],

        }

        var chart = new ApexCharts(
            document.querySelector("#interviews"),
            options
        );

        chart.render();




        // chart 6

        var options = {
            chart: {
                height: 335,
                type: 'radialBar',
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                radialBar: {
                    startAngle: -135,
                    endAngle: 225,
                    hollow: {
                        margin: 20,
                        size: '70%',
                        background: '#000',
                        image: undefined,
                        imageOffsetX: 0,
                        imageOffsetY: 0,
                        position: 'front',
                        dropShadow: {
                            enabled: true,
                            top: 3,
                            left: 0,
                            blur: 4,
                            opacity: 0.24
                        }
                    },
                    track: {
                        background: '#fff',
                        strokeWidth: '67%',
                        margin: 0, // margin is in pixels
                        dropShadow: {
                            enabled: true,
                            top: -3,
                            left: 0,
                            blur: 4,
                            opacity: 0.35
                        }
                    },

                    dataLabels: {
                        showOn: 'always',
                        name: {
                            offsetY: -10,
                            show: false,
                            color: '#fff',
                            fontSize: '16px'
                        },
                        value: {
                            formatter: function(val) {
                                return val + "%";
                            },
                            color: '#fff',
                            fontSize: '40px',
                            show: true,
                        }
                    }
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'light',
                    type: 'horizontal',
                    shadeIntensity: 0.5,
                    gradientToColors: ['#f1076f'],
                    inverseColors: false,
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 100]
                }
            },
            // colors: ["#ff5447"],
            series: [1],
            stroke: {
                lineCap: 'round'
            },
            labels: ['Median Ratio'],

        }

        var chart = new ApexCharts(
            document.querySelector("#vacancy-status"),
            options
        );

        chart.render();




        // chart 7

        var options = {
            chart: {
                height: 380,
                type: 'bar',
                toolbar: {
                    show: false
                },
                dropShadow: {
                    enabled: true,
                    opacity: 0.1,
                    blur: 3,
                    left: -7,
                    top: 22,
                }
            },
            plotOptions: {
                bar: {
                    barHeight: '100%',
                    endingShape: 'rounded',
                    distributed: true,
                    horizontal: true,
                    dataLabels: {
                        position: 'bottom'
                    },
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    gradientToColors: ['#8f50ff', '#0072ff', '#f1076f', '#08a50e', '#f7971e', '#fc00ff',
                        '#000428', '#ba8b02', '#009efd', '#000000'
                    ],
                    shadeIntensity: 1,
                    type: 'horizontal',
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 100, 100, 100]
                },
            },
            colors: ['#d13adf', '#00c8ff', '#ff5447', ],
            dataLabels: {
                enabled: true,
                textAnchor: 'start',
                style: {
                    colors: ['#fff']
                },
                formatter: function(val, opt) {
                    return opt.w.globals.labels[opt.dataPointIndex] + " :  " + val
                },
                offsetX: 0,
                dropShadow: {
                    enabled: true
                }
            },
            series: [{
                data: [
                    @foreach ($user as $userx)
                        @php
                            $totaltiketuser = DB::table('tbl_tiket_person_worklist')
                                ->where('id_user', $userx->id_user)
                                ->where('status_tiket', 2)
                                ->count();
                            $totaltiketuser1 = DB::table('tbl_tiket_group_worklist')
                                ->where('id_user', $userx->id_user)
                                ->where('status_tiket', 2)
                                ->count();
                            $totaltiketuser2 = DB::table('users_handler_record_log')
                                ->where('id_user', $userx->id_user)
                                ->count();
                            $totaltiketselesai = $totaltiketuser + $totaltiketuser1 + $totaltiketuser2;
                        @endphp
                            '{{ $totaltiketselesai }}',
                    @endforeach
                ]
            }],
            stroke: {
                width: 1,
                colors: ['#fff'],

            },
            xaxis: {
                categories: [
                    @foreach ($user as $user)
                        '{{ $user->name }}',
                    @endforeach

                ],
            },
            yaxis: {
                labels: {
                    show: false
                }
            },
            tooltip: {
                theme: 'dark',
                x: {
                    show: false
                },
                y: {
                    title: {
                        formatter: function() {
                            return ''
                        }
                    }
                }
            }
        }

        var chart = new ApexCharts(
            document.querySelector("#top-refefrers"),
            options
        );

        chart.render();


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
                            $monitoringharian = DB::table('users_handler_record_log')
                                ->whereBetween('tgl_record', [$periodtotal->awal_tgl, $periodtotal->akhir_tgl])
                                ->count();
                            $totaltiket = $totaldatatiketperson + $totaldatatiketgroup + $monitoringharian;
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
                            $monitoringharian = DB::table('users_handler_record_log')
                                ->whereBetween('tgl_record', [$periodtota2->awal_tgl, $periodtota2->akhir_tgl])
                                ->count();
                            $totaltiketselesai = $totaldatatiketpersonselesai + $totaldatatiketgroupselesai + $monitoringharian;
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
