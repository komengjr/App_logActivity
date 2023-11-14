@extends('layouts.base')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row pt-2 pb-2">
                <div class="col-sm-12">
                    <h4 class="page-title">Dashboard Admin</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javaScript:void();">Menu</a></li>
                        <li class="breadcrumb-item"><a href="javaScript:void();">Jadwal</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Piket</li>
                    </ol>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header"><i class="fa fa-table"></i> Data Table Example</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="default-datatable" class="styled-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Id Piket</th>
                                            <th>User</th>
                                            <th>Cabang</th>
                                            <th>Tanggal Piket</th>
                                            <th>Status Piket</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Row-->
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {

            // DataTable
            var table = $('#default-datatable').DataTable({
                // responsive: true
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.jadwalpiket', ['id' => 12]) }}",
                columns: [{
                        data: 'id',
                        "width": "4%"
                    },
                    {
                        data: 'id_piket'
                    },
                    {
                        data: 'id_user',
                        className: 'text-right'
                    },
                    {
                        data: 'kd_cabang',
                        className: 'text-right'
                    },
                    {
                        data: 'tgl_piket',
                        className: 'text-right'
                    },
                    {
                        data: 'status_piket',
                        className: 'text-right'
                    },
                    {
                        data: 'btn',
                        className: 'text-center',
                        "width": "4%"
                    }
                ]

            });
            // console.log(columns);
            // new $.fn.dataTable.FixedHeader(table);
        });
    </script>
@endsection