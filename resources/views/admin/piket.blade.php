@extends('layouts.base')
@section('content')
    <link href='{{ asset('assets/plugins/fullcalendar/css/fullcalendar.css') }}' rel='stylesheet' />

    <div class="content-wrapper gradient-meridian">
        <div class="container-fluid">


            <!-- Breadcrumb-->
            <div class="row pt-3 pb-4">
                <div class="col-sm-12">
                    {{-- <h4 class="page-title">Calendar</h4> --}}
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javaScript:void();">Menu</a></li>
                        <li class="breadcrumb-item"><a href="javaScript:void();">Data</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Piket</li>
                    </ol>
                    <div class="btn-group float-sm-right">
                        <button type="button"
                            class="btn btn-light dropdown-toggle dropdown-toggle-split waves-effect waves-light"
                            data-toggle="dropdown">
                            <i class="fa fa-cog"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a href="javaScript:void();" class="dropdown-item">Action</a>
                            <a href="javaScript:void();" class="dropdown-item">Another action</a>
                            <a href="javaScript:void();" class="dropdown-item">Something else here</a>
                            <div class="dropdown-divider"></div>
                            <a href="javaScript:void();" class="dropdown-item" data-toggle="modal"
                                data-target='#formupload'>Upload Jadwal</a>
                        </div>
                    </div>
                </div>

            </div>
            <!-- End Breadcrumb-->
            <div class="row">
                <div class="col-md-7">
                    <div id='calendar'></div>
                </div>
                <div class="col-md-5">
                    <div class="card pb-3">
                        <div class="card-header mb-3">Data Piket
                            <div class="card-action">
                                {{-- <div class="dropdown">
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
                                </div> --}}
                            </div>
                        </div>
                        <table id="example1" class="styled-table table-striped table-bordered "
                            style="width:100%; text-align: left;" border="1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Tiket</th>
                                    <th>Tanggal Piket</th>
                                    <th>User Piket</th>
                                    <th>Act</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($datax as $item)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$item->tiket_piket_nasional}}</td>
                                        <td>{{$item->tgl_piket_nasional}}</td>
                                        <td>
                                            @php
                                                $datauser = DB::table('piket_nasional_user')
                                                ->join('tbl_biodata','tbl_biodata.id_user','=','piket_nasional_user.user_piket')
                                                ->where('piket_nasional_user.tiket_piket_nasional',$item->tiket_piket_nasional)
                                                ->get();
                                            @endphp
                                            @foreach ($datauser as $userx)
                                               <li> {{$userx->nama_lengkap}} - {{$userx->id_user}}</li>
                                            @endforeach
                                        </td>
                                        <td class="text-center"><button class="btn-info" data-toggle="modal" data-target="#modal-piket"><i class="fa fa-plus"></i></button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <br>

            <!--start overlay-->
            <div class="overlay toggle-menu"></div>

            <!--end overlay-->
        </div>
        <!-- End container-fluid-->
    </div>
    <!--End content-wrapper-->

    <div class="modal fade" id="formemodal">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><button class="btn-dark" disabled>Penjadwalan Piket</button></h5>
                    <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body" id="bodycalender">

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-piket">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><button class="btn-dark" disabled></button></h5>
                    <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body" id="bodycalender">

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="formupload">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Your modal title here</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="input-1">Name</label>
                            <input type="text" class="form-control" id="input-1" placeholder="Enter Your Name">
                        </div>
                        <div class="form-group">
                            <label for="input-2">Email</label>
                            <input type="text" class="form-control" id="input-2"
                                placeholder="Enter Your Email Address">
                        </div>
                        <div class="form-group">
                            <label for="input-3">Password</label>
                            <input type="text" class="form-control" id="input-3" placeholder="Enter Password">
                        </div>
                        <div class="form-group">
                            <div class="icheck-material-white">
                                <input type="checkbox" id="user-checkbox1" checked="">
                                <label for="user-checkbox1">Remember me</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary px-5"><i class="icon-lock"></i> Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src='{{ asset('assets/plugins/fullcalendar/js/moment.js') }}'></script>
    <script src='{{ asset('assets/plugins/fullcalendar/js/fullcalendar.min.js') }}'></script>
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
    <script>
        $(document).ready(function() {
            var table = $('#example1').DataTable({
                lengthChange: false,
                // buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
            });

            table.buttons().container()
                .appendTo('#example_wrapper .col-md-6:eq(0)');

        });
    </script>
    <script>
        $("#calendar").fullCalendar({
            header: {
                left: "prev,next today",
                center: "title",
                right: "month,agendaWeek,agendaDay",
            },

            navLinks: true, // can click day/week names to navigate views
            selectable: true,
            selectHelper: true,
            editable: false,
            eventLimit: true, // allow "more" link when too many events
            events: [
                @foreach ($datax as $data)
                    {
                        title: "{{ $data->tiket_piket_nasional }}",
                        start: "{{ $data->tgl_piket_nasional }}",
                        end: "{{ $data->tgl_piket_nasional }}",
                        url: "{{ url('../../admin/menu/piket/detail', ['id' => $data->tiket_piket_nasional]) }}",
                        target: '#',
                        // color: "#0f1f2a",
                    },
                @endforeach

                // {
                //     title: 'Click for Google',
                //     event: $('#formupload').modal('show'),
                //     button: 'sadasds',
                //     start: "2025-01-31",
                // },
            ],
            select: function(start, end, table) {

                $("#formemodal").modal('show');
                $('#txt_name').on("change", function() {
                    var datanama = $("#txt_name option:selected").attr('data-nama');
                    alert(datanama)
                });
                var title = '';
                var url = '../../admin/menu/form-piket/' + start._d;
                $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'html'
                    })
                    .done(function(data) {

                        $('#bodycalender').html(data);
                        $("#simpan").click(function() {
                            var title = document.getElementById('txt_name').value;
                            var judul = document.getElementById('judul').value;
                            var ket = document.getElementById('ket').value;
                            var cabang = document.getElementById('cabang').value;

                            var user_name = "Rohit";
                            document.cookie = "name = " + user_name;
                            var tglskrng = document.getElementById('date').value;

                            $("#calendar").fullCalendar("unselect");
                            var tanggal = $(this).data("date");

                            if (title) {
                                eventData = {
                                    title: judul,
                                    start: start,
                                    end: tglskrng + " 24:00:00",
                                };
                                $.ajax({
                                    type: 'post',
                                    url: 'admin/buatjadwal/user',
                                    data: {
                                        judul: title,
                                        date: start._d,
                                        ket: ket,
                                        cabang: cabang,
                                        end: tglskrng + " 24:00:00",
                                    },
                                    success: function(data) {
                                        sukses_notifikasi();
                                    }

                                });
                                $("#calendar").fullCalendar("renderEvent", eventData, 'red');

                            }


                        });

                    })
                    .fail(function() {
                        $('#bodycalender').html(
                            '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                        );
                    });
            },
        });
    </script>
@endsection
