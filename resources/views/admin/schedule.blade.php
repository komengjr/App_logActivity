@extends('layouts.base')
@section('content')
    <link href='{{ asset('assets/plugins/fullcalendar/css/fullcalendar.css', []) }}' rel='stylesheet' />
    <div class="content-wrapper">
        <div class="container-fluid">

            <!-- Breadcrumb-->
            <div class="row pt-2 pb-2">
                <div class="col-sm-9">
                    <h4 class="page-title">Calendar</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javaScript:void();">Dashtreme</a></li>
                        <li class="breadcrumb-item"><a href="javaScript:void();">Calendar</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Calendar</li>
                    </ol>
                </div>
                <div class="col-sm-3">
                    <div class="btn-group float-sm-right">
                        <button type="button" class="btn btn-light waves-effect waves-light"><i class="fa fa-cog mr-1"></i>
                            Setting</button>
                        <button type="button"
                            class="btn btn-light dropdown-toggle dropdown-toggle-split waves-effect waves-light"
                            data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <div class="dropdown-menu">
                            <a href="javaScript:void();" class="dropdown-item">Action</a>
                            <a href="javaScript:void();" class="dropdown-item">Another action</a>
                            <a href="javaScript:void();" class="dropdown-item">Something else here</a>
                            <div class="dropdown-divider"></div>
                            <a href="javaScript:void();" class="dropdown-item">Separated link</a>
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
                    <h5 class="modal-title">Setup Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="bodycalender">

                </div>
            </div>
        </div>
    </div>
    <script src='{{ asset('assets/plugins/fullcalendar/js/moment.js', []) }}'></script>
    <script src='{{ asset('assets/plugins/fullcalendar/js/fullcalendar.min.js', []) }}'></script>


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
                    },
                @endforeach

                {
                    title: "Click for Google",
                    url: "http://google.com/",
                    start: "2018-03-28",
                },
            ],
            select: function(start, end, table) {

                console.log(start._d);
                $("#formemodal").modal('show');
                $('#txt_name').on("change", function() {
                    var datanama = $("#txt_name option:selected").attr('data-nama');
                    alert(datanama)
                });
                var title = '';
                var url = 'schedule/datacalender/'+start._d;
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

                            var user_name = "Rohit";
                            document.cookie = "name = " + user_name;
                            var tglskrng = document.getElementById('date').value;
                            console.log(title);
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
                                        end: tglskrng + " 24:00:00",
                                    },
                                    success: function(data) {
                                        alert(data.success);
                                    }

                                });
                                $("#calendar").fullCalendar("renderEvent", eventData, true);
                                console.log(eventData);
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
