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
            border-bottom: 1px solid #000000;
            position: relative;
            padding-left: 50%;
            background-color: #f1efef;
            text-align: left;
            padding: 10px;
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

    .styled-tablex {
        /* position: static; */
        border-collapse: collapse;
        margin: 0px 0;
        font-size: 0.9em;

        width: 100%;
        /* min-width: 400px; */
        box-shadow: 0 0 20px rgba(217, 211, 211, 0.15);

    }

    .styled-tablex thead tr {
        background-color: #0095ff;
        color: #ffffff;
        text-align: left;
    }

    @media only screen and (min-width: 760px) {

        .styled-tablex th,
        .styled-tablex td {
            padding: 12px 15px;
        }
    }

    .styled-tablex tbody tr {
        border-bottom: 1px solid #dddddd;
    }

    .styled-tablex tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }

    .styled-tablex tbody tr:last-of-type {
        border-bottom: 2px solid #030303;
    }

    .styled-tablex tbody tr.active-row {
        font-weight: bold;
        color: #020202;
    }
</style>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row pt-2 pb-2 ">
            <div class="col-sm-12 ">
                <h4 class="page-title">Dashboard Verifikator {{ auth::user()->name }}</h4>
                <ol class="breadcrumb ">
                    <li class="breadcrumb-item"><a href="javaScript:void();">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javaScript:void();">Verifikator</a></li>
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

        <!--End Row-->

        <div class="card">
            <div class="card-header">
                Property Order Status
                <div class="btn-group group-round btn-group-sm float-right">
                    {{-- <button type="button" class="btn btn-info waves-effect waves-light">
                        Monthly
                    </button> --}}
                    <button type="button" class="btn btn-info waves-effect waves-light" data-toggle="modal"
                        data-target="#modal-cabang-verivikator" id="button-grapic-cabang-verifikator">
                        Menu
                    </button>
                    {{-- <button type="button" class="btn btn-info waves-effect waves-light">
                        Daily
                    </button> --}}
                </div>
            </div>
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-2 text-center">
                        <p class="mt-4">Total Laporan</p>
                        <h4 class="mb-0">{{ $totalkerusakan }}</h4>
                        <hr />
                        <p>Total Selesai</p>
                        <h4 class="mb-0 text-info">{{ $totalkerusakan }}</h4>
                    </div>
                    <div class="col-12 col-lg-10 col-xl-10">
                        <div class="chart-container">
                            <div id="recruitment-cost"></div>
                        </div>
                    </div>
                </div>
                <!--End Row-->
            </div>
        </div>

        <!--end row-->
        <div class="row">
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
                                    <a class="dropdown-item" href="#" id="buttontambahorderverify"
                                        data-toggle="modal" data-target="#modalverif"><i class="fa fa-ticket"></i>
                                        Tambah Order</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pt-4 pb-4">
                        <table class="styled-tablex" id="default-datatable">
                            <thead>
                                <tr>
                                    <th style="width: 5px;">No</th>
                                    <th>Kinerja</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Berakhir</th>
                                    <th>Status Tiket</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($tiket as $tiket)
                                    <tr>
                                        <td class="text-center">
                                            {{ $no++ }}
                                        </td>

                                        <td data-label="Kinerja">{{ $tiket->kinerja }}</td>
                                        <td data-label="Tanggal Start">
                                            {{ $tiket->tgl_start }}
                                        </td>
                                        <td data-label="Tanggal End">
                                            {{ $tiket->tgl_end }}
                                        </td>
                                        <td data-label="Status">
                                            @if ($tiket->status_task == 1)
                                                <span class="badge-dot">
                                                    <i class="bg-danger"></i> pending
                                                </span>
                                            @else
                                                <span class="badge-dot">
                                                    <i class="bg-success"></i> Selesai
                                                </span>
                                            @endif



                                        </td>
                                        <td class="text-center">
                                            <button class="btn-info" data-toggle="modal" data-target="#modalverif"
                                                id="modalveriflihatschedule" data-id="{{ $tiket->kd_tiket_task }}"><i
                                                    class="fa fa-file-text"></i></button>
                                            {{-- <button class="btn-warning"><i class="fa fa-send"></i></button> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

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

<div class="modal fade" id="modalverif">
    <div class="modal-dialog modal-dialog-centered modal-xl" id="showmodalverif">
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

<div class="modal fade" id="modal-cabang-verivikator">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content border-danger" id="menu-data-cabang-verifikator">

            <img src="{{ asset('gif.gif') }}" alt="" srcset="">

        </div>
    </div>
</div>
<script src="{{ asset('js/verif.js', []) }}"></script>
<script src="{{ url('assets/plugins/Chart.js/Chart.min.js', []) }}"></script>
{{-- <script src="{{ url('assets/js/dashboard-property-listing.js', []) }}"></script> --}}

<!-- Apex Chart JS -->
<script src="{{ asset('assets/plugins/apexcharts/apexcharts.js', []) }}"></script>
{{-- <script src="assets/plugins/apexcharts/apexcharts.js"></script> --}}
{{-- <script src="{{ asset('assets/js/dashboard-human-resources.js') }}"></script> --}}
<script>
    $(function() {
        "use strict";

        // chart 1

        var options = {
            chart: {
                height: 325,
                type: 'bar',
                stacked: false,
                foreColor: '#4e4e4e',
                toolbar: {
                    show: false
                },
                dropShadow: {
                    // enabled: true,
                    opacity: 0.1,
                    blur: 3,
                    left: -7,
                    top: 22,
                }
            },
            plotOptions: {
                bar: {
                    columnWidth: '50%',
                    endingShape: 'rounded',
                    dataLabels: {
                        position: 'top', // top, center, bottom
                    },
                }
            },
            dataLabels: {
                enabled: false,
                formatter: function(val) {
                    return parseInt(val);
                },
                offsetY: -20,
                style: {
                    fontSize: '14px',
                    colors: ["#304758"]
                }
            },
            stroke: {
                show: true,
                width: [0, 0, 0],
                dashArray: [0, 0, 0],
                curve: 'smooth'
                // colors: ['transparent']
            },
            grid: {
                show: true,
                borderColor: 'rgba(0, 0, 0, 0.10)',
            },
            series: [{
                name: 'Server',
                data: [3, 4, 3, 4, 4, 4, 4]
            }, {
                name: 'Networking',
                data: [4, 4, 4, 4, 4, 4, 4]
            }, {
                name: 'PC',
                data: [3, 3, 3, 3, 3, 3, 3]
            }, {
                name: 'Messages',
                data: [2, 2, 2, 2, 2, 2, 2]
            }],
            xaxis: {
                categories: ['11-11-2023', '12-11-2023', '13-11-2023', '14-11-2023', '15-11-2023',
                    '16-11-2023', '17-11-2023'
                ],
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    gradientToColors: ['#009efd', '#ff6a00', '#000428'],
                    shadeIntensity: 1,
                    type: 'vertical',
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 100, 100, 100]
                },
            },
            colors: ["#2af598", "#ee0979", '#0072ff'],
            tooltip: {
                theme: 'dark',
                y: {
                    formatter: function(val) {
                        return "" + val + " Task"
                    }
                }
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        height: 330,
                        stacked: true,
                    },
                    legend: {
                        show: !0,
                        position: "top",
                        horizontalAlign: "left",
                        offsetX: -20,
                        fontSize: "10px",
                        markers: {
                            radius: 50,
                            width: 10,
                            height: 10
                        }
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '30%'
                        }
                    }
                }
            }]
        }

        var chart = new ApexCharts(
            document.querySelector("#recruitment-cost"),
            options
        );

        chart.render();

    });
</script>

