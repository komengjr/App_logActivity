@extends('layouts.template')
@section('base.css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.4/css/responsive.bootstrap5.css">
    <link href="{{ asset('vendors/choices/choices.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <div class="row mb-3">
        <div class="col">
            <div class="card bg-100 shadow-none border border-danger">
                <div class="row gx-0 flex-between-center">
                    <div class="col-sm-auto d-flex align-items-center border-bottom">
                        <img class="ms-3 mx-3" src="{{ asset('img/go.png') }}" alt="" width="50" />
                        <div>
                            <h6 class="text-danger fs--1 mb-0 pt-2">Welcome to </h6>
                            <h4 class="text-danger fw-bold mb-1">Suplier <span class="text-danger fw-medium">Management
                                    System</span></h4>
                        </div>
                        <img class="ms-n4 d-none d-lg-block "
                            src="{{ asset('asset/img/illustrations/crm-line-chart.png') }}" alt="" width="150" />
                    </div>
                    <div class="col-xl-auto px-3 py-2">
                        <h6 class="text-danger fs--1 mb-0">Menu : </h6>
                        <h4 class="text-danger fw-bold mb-0">Master <span class="text-danger fw-medium">Penilaian Kapus</span></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header bg-danger">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="m-0"><span class="badge bg-danger m-0 p-0">Master Penilaian Kapus</span></h3>
                        </div>
                        <div class="col-auto">

                            <div class="btn-group" role="group">
                                <button class="btn btn-sm btn-falcon-primary dropdown-toggle" id="btnGroupVerticalDrop2"
                                    type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span
                                        class="fas fa-align-left me-1" data-fa-transform="shrink-3"></span>Option</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop2">
                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-barang"
                                        id="button-tambah-kategori-penilaian" data-code="123"><span
                                            class="fab fa-superpowers"></span> Tambah Kategori Penilaian</button>
                                    <!-- <div class="dropdown-divider"></div>
                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-barang"
                                id="button-upload-data-barang" data-code="123"><span
                                    class="fas fa-cloud-upload-alt"></span> Upload Barang</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body border-top p-3">
                    <table id="example" class="table table-striped nowrap" style="width:100%">
                        <thead class="bg-200 text-700">
                            <tr>
                                <th>No</th>
                                <th>Kategori</th>
                                <th>Type Penilaian</th>
                                <th>Aspek Penilaian</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($data as $datas)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $datas->s_penilaian_cat_name }}</td>
                                    <td>{{ $datas->s_penilaian_type_name }} <button class="btn btn-primary btn-sm" id="button-tambah-detail-kategori" data-code="{{ $datas->s_penilaian_cat_code }}" data-bs-toggle="modal" data-bs-target="#modal-barang">+</button></td>
                                    <td>
                                        @php
                                            $detail = DB::table('s_penilaian_detail')->where('s_penilaian_cat_code',$datas->s_penilaian_cat_code)->get();
                                        @endphp
                                        @foreach ($detail as $det)
                                            <h6 class="mb-0"><a href="#" id="button-tambah-add-point-detail" data-code="{{ $det->s_penilaian_detail_code }}" data-bs-toggle="modal" data-bs-target="#modal-barang">{{ $det->s_penilaian_detail_name }} </a> ( {{ $det->s_penilaian_detail_point }} Point )</h6>
                                            @php
                                            $list = DB::table('s_penilaian_point')->where('s_penilaian_detail_code', $det->s_penilaian_detail_code)->get();
                                            @endphp
                                             <div class="mb-2">
                                                @foreach ($list as $lists)
                                                <li class="fs--2">{{ $lists->s_penilaian_point_name }} ( {{ $lists->s_penilaian_point_value }} Point ) </li>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('base.js')
    <div class="modal fade" id="modal-barang" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content border-0">
                <div class="position-absolute top-0 end-0 mt-3 me-3 z-index-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="menu-barang"></div>
            </div>
        </div>
    </div>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.4/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.4/js/responsive.bootstrap5.js"></script>
    <script src="{{ asset('vendors/choices/choices.min.js') }}"></script>
    <script>
        new DataTable('#example', {
            responsive: true
        });
    </script>
    <script>
        $(document).on("click", "#button-tambah-kategori-penilaian", function (e) {
            e.preventDefault();
            var code = $(this).data("code");
            $('#menu-barang').html(
                '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
            );
            $.ajax({
                url: "{{ route('master_penilaian_kapus_add') }}",
                type: "POST",
                cache: false,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "code": code
                },
                dataType: 'html',
            }).done(function (data) {
                $('#menu-barang').html(data);
            }).fail(function () {
                $('#menu-barang').html('eror');
            });
        });
        $(document).on("click", "#button-tambah-detail-kategori", function (e) {
            e.preventDefault();
            var code = $(this).data("code");
            $('#menu-barang').html(
                '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
            );
            $.ajax({
                url: "{{ route('master_penilaian_kapus_add_detail') }}",
                type: "POST",
                cache: false,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "code": code
                },
                dataType: 'html',
            }).done(function (data) {
                $('#menu-barang').html(data);
            }).fail(function () {
                $('#menu-barang').html('eror');
            });
        });
        $(document).on("click", "#button-tambah-add-point-detail", function (e) {
            e.preventDefault();
            var code = $(this).data("code");
            $('#menu-barang').html(
                '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
            );
            $.ajax({
                url: "{{ route('master_penilaian_kapus_add_point_detail') }}",
                type: "POST",
                cache: false,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "code": code
                },
                dataType: 'html',
            }).done(function (data) {
                $('#menu-barang').html(data);
            }).fail(function () {
                $('#menu-barang').html('eror');
            });
        });
    </script>
    <script>
        $(document).on("click", "#button-tambah-point-penilaian", function (e) {
            e.preventDefault();
            var code = $(this).data("code");
            $('#menu-barang').html(
                '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
            );
            $.ajax({
                url: "{{ route('master_penilaian_add_detail') }}",
                type: "POST",
                cache: false,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "code": code
                },
                dataType: 'html',
            }).done(function (data) {
                $('#menu-barang').html(data);
            }).fail(function () {
                $('#menu-barang').html('eror');
            });
        });
        $(document).on("click", "#button-tambah-add-point", function (e) {
            e.preventDefault();
            var code = $(this).data("code");
            $('#menu-barang').html(
                '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
            );
            $.ajax({
                url: "{{ route('master_penilaian_add_point') }}",
                type: "POST",
                cache: false,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "code": code
                },
                dataType: 'html',
            }).done(function (data) {
                $('#menu-barang').html(data);
            }).fail(function () {
                $('#menu-barang').html('eror');
            });
        });
    </script>
@endsection
