@extends('layouts.base')
@section('content')
    <link href='{{ asset('assets/plugins/fullcalendar/css/fullcalendar.css', []) }}' rel='stylesheet' />
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

            <div id='calendar'></div>

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
                    <h5 class="modal-title"><span class="badge badge-success p-1">Penjadwalan Piket</span></h5>
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
    <script src='{{ asset('assets/plugins/fullcalendar/js/moment.js', []) }}'></script>
    <script src='{{ asset('assets/plugins/fullcalendar/js/fullcalendar.min.js', []) }}'></script>
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
                msg: 'Berhasil Membuat Jadwal User'
            });
        }
        $(document).ready(function() {
            $('#buttonnotif').click();
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
                @foreach ($data as $data)
                    {
                        title: "{{ $data->kinerja }}",
                        start: "{{ $data->tgl_start }}",
                        end: "{{ $data->tgl_akhir }}",
                        url: "{{ url('../../admin/schedule/show/on', ['id'=> $data->kd_schedule]) }}",
                        color: "#0f1f2a",
                    },
                @endforeach

                {
                    title: "Click for Google",
                    url: "http://google.com/",
                    start: "2023-07-28",
                },
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
