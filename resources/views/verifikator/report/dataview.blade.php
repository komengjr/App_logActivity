<div class="chart-container">
    <div id="recruitment-cost-view"></div>
</div>
<table class="styled-tablex" id="default-datatable1">
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

    </tbody>
</table>
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
                data: [
                    @foreach ($harimasuk as $item)
                        @php
                        $cekdata = DB::table('users_handler_record_log')
                            ->join('tbl_kinerja_sub','tbl_kinerja_sub.kd_kinerja_sub','=','users_handler_record_log.kd_kinerja_sub')
                            ->where('users_handler_record_log.kd_cabang', Auth::user()->cabang)
                            ->where('tbl_kinerja_sub.kd_jenis_kinerja', 'server')
                            ->where('users_handler_record_log.tgl_record', date('Y-m-d', $item))
                            ->count();
                        @endphp
                        '{{$cekdata}}',
                    @endforeach
                ]
            }, {
                name: 'Networking',
                data: [
                    @foreach ($harimasuk as $item1)
                        @php
                        $cekdata1 = DB::table('users_handler_record_log')
                            ->join('tbl_kinerja_sub','tbl_kinerja_sub.kd_kinerja_sub','=','users_handler_record_log.kd_kinerja_sub')
                            ->where('users_handler_record_log.kd_cabang', Auth::user()->cabang)
                            ->where('tbl_kinerja_sub.kd_jenis_kinerja', 'network')
                            ->where('users_handler_record_log.tgl_record', date('Y-m-d', $item1))
                            ->count();
                        @endphp
                        '{{$cekdata1}}',
                    @endforeach
                ]
            }, {
                name: 'PC',
                data: [
                    @foreach ($harimasuk as $item2)
                        @php
                        $cekdata2 = DB::table('users_handler_record_log')
                            ->join('tbl_kinerja_sub','tbl_kinerja_sub.kd_kinerja_sub','=','users_handler_record_log.kd_kinerja_sub')
                            ->where('users_handler_record_log.kd_cabang', Auth::user()->cabang)
                            ->where('tbl_kinerja_sub.kd_jenis_kinerja', 'pc')
                            ->where('users_handler_record_log.tgl_record', date('Y-m-d', $item2))
                            ->count();
                        @endphp
                        '{{$cekdata2}}',
                    @endforeach
                ]
            }, {
                name: 'Messages',
                data: [
                    @foreach ($harimasuk as $item3)
                        @php
                        $cekdata3 = DB::table('users_handler_record_log')
                            ->join('tbl_kinerja_sub','tbl_kinerja_sub.kd_kinerja_sub','=','users_handler_record_log.kd_kinerja_sub')
                            ->where('users_handler_record_log.kd_cabang', Auth::user()->cabang)
                            ->where('tbl_kinerja_sub.kd_jenis_kinerja', 'massages')
                            ->where('users_handler_record_log.tgl_record', date('Y-m-d', $item3))
                            ->count();
                        @endphp
                        '{{$cekdata3}}',
                    @endforeach
                ]
            }],
            xaxis: {
                categories: [
                    @foreach ($harimasuk as $item4)
                    '{{ date("d/m/Y", $item4) }}',
                    @endforeach

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
            document.querySelector("#recruitment-cost-view"),
            options
        );

        chart.render();

    });
</script>
<script>
    $(document).ready(function() {

        $('#default-datatable1').DataTable();
        var table = $('#example').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
        });
        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');
    });
</script>
