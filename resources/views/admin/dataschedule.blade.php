@extends('layouts.base')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumb-->
            <div class="row pt-2 pb-2">
                <div class="col-sm-12">

                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="javaScript:void();">Schedule</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="javaScript:void();">Data</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{$data->kinerja}} ( {{$data->tgl_start}} Sampai {{$data->tgl_akhir}} )
                        </li>
                    </ol>
                </div>

            </div>
            <!-- End Breadcrumb-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <!-- Left sidebar -->
                                <div class="col-lg-3 col-md-4">

                                    <div class="card mt-3 shadow-none">
                                        <div class="list-groups shadow-none">
                                            @foreach ($datauser as $item)
                                            <a href="#" class="list-group-item " style="text-decoration: none;" id="buttonuserschedulexx" data-url="{{ asset('admin/datatask/user/pengerjaan/showdata') }}" data-id="{{$item->id_user}}" data-kode="{{$id}}"><i class="fa fa-user-o"></i> - {{$item->nama_lengkap}}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <!-- End Left sidebar -->

                                <!-- Right Sidebar -->
                                <div class="col-lg-9 col-md-8">

                                    <!-- End row -->
                                    <div class="card mt-3 shadow-none">
                                        <div class="card-body" id="dataschedule">

                                        </div>
                                    </div>
                                    <!-- card -->
                                </div>
                                <!-- end Col-9 -->
                            </div>
                            <!-- End row -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End row -->
            <!--start overlay-->
            <div class="overlay toggle-menu"></div>
            <!--end overlay-->
        </div>
        <!-- End container-fluid-->
    </div>
    <script>
        $(document).on('click', '#buttonuserschedulexx', function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            var kd = $(this).data("kode");
            // console.log(id);
            var url = $(this).data("url")+ '/' + id + '/' + kd;
            $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'html'
                })
                .done(function(data) {
                    $('#dataschedule').html(data);
                })
                .fail(function() {
                    $('#dataschedule').html(
                        '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                    );
                });
        });
    </script>
@endsection
