@extends('layouts.template')
@section('base.css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.4/css/responsive.bootstrap5.css">
<link href="{{ asset('vendors/choices/choices.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
<div class="row mb-3">
    <div class="col">
        <div class="card bg-100 shadow-none border">
            <div class="row gx-0 flex-between-center">
                <div class="col-sm-auto d-flex align-items-center border-bottom">
                    <img class="ms-3 mx-3" src="{{ asset('asset/img/logos/apple.png') }}" alt="" width="50" />
                    <div>
                        <h6 class="text-primary fs--1 mb-0 pt-2">Welcome to </h6>
                        <h4 class="text-primary fw-bold mb-1">Suplier <span class="text-info fw-medium">Management
                                System</span></h4>
                    </div>
                    <img class="ms-n4 d-none d-lg-block "
                        src="{{ asset('asset/img/illustrations/crm-line-chart.png') }}" alt="" width="150" />
                </div>
                <div class="col-xl-auto px-3 py-2">
                    <h6 class="text-primary fs--1 mb-0">Menu : </h6>
                    <h4 class="text-primary fw-bold mb-0">Master <span class="text-info fw-medium">Jasa</span></h4>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card mb-3">
    <div class="card-header bg-primary">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="m-0"><span class="badge bg-primary m-0 p-0">Master Jasa</span></h3>
            </div>
            <div class="col-auto">

                <div class="btn-group" role="group">
                    <button class="btn btn-sm btn-falcon-primary dropdown-toggle" id="btnGroupVerticalDrop2" type="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span
                            class="fas fa-align-left me-1" data-fa-transform="shrink-3"></span>Option</button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop2">
                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-barang"
                            id="button-tambah-data-barang" data-code="123"><span class="fab fa-superpowers"></span> Tambah Jasa</button>
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
                    <th>Kode Jasa</th>
                    <th>Nama Jasa</th>
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
                    <td>{{ $datas->m_jasa_code  }}</td>
                    <td>{{ $datas->m_jasa_name }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <button class="btn btn-sm btn-falcon-primary dropdown-toggle" id="btnGroupVerticalDrop2" type="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span
                                    class="fas fa-align-left me-1" data-fa-transform="shrink-3"></span>Option</button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop2">
                                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-suplier-full"
                                    id="button-show-data-penilaian" data-code="{{$datas->m_jasa_code}}"><span class="fab fa-superpowers"></span> Data Penilaian</button>
                                <div class="dropdown-divider"></div>
                                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-barang"
                                    id="button-upload-data-barang" data-code="123"><span
                                        class="fas fa-cloud-upload-alt"></span> Upload Barang</button>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
<div class="modal fade" id="modal-suplier-full" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="max-width: 95%;">
        <div class="modal-content border-0">
            <div class="position-absolute top-0 end-0 mt-3 me-3 z-index-1">
                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="menu-suplier-full"></div>
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
    $(document).on("click", "#button-tambah-data-barang", function(e) {
        e.preventDefault();
        var code = $(this).data("code");
        $('#menu-barang').html(
            '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        $.ajax({
            url: "{{ route('master_jasa_add') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "code": code
            },
            dataType: 'html',
        }).done(function(data) {
            $('#menu-barang').html(data);
        }).fail(function() {
            $('#menu-barang').html('eror');
        });
    });
    $(document).on("click", "#button-upload-data-barang", function(e) {
        e.preventDefault();
        var code = $(this).data("code");
        $('#menu-barang').html(
            '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        $.ajax({
            url: "{{ route('master_barang_import') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "code": code
            },
            dataType: 'html',
        }).done(function(data) {
            $('#menu-barang').html(data);
        }).fail(function() {
            $('#menu-barang').html('eror');
        });
    });
    $(document).on("click", "#button-show-data-penilaian", function(e) {
        e.preventDefault();
        var code = $(this).data("code");
        $('#menu-suplier-full').html(
            '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        $.ajax({
            url: "{{ route('master_jasa_detail_penilaian') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "code": code
            },
            dataType: 'html',
        }).done(function(data) {
            $('#menu-suplier-full').html(data);
        }).fail(function() {
            $('#menu-suplier-full').html('eror');
        });
    });
    $(document).on("click", "#button-remove-log-penilaian-jasa", function(e) {
        e.preventDefault();
        var log = $(this).data("log");
        var supplier = $(this).data("supplier");
        var jasa = $(this).data("jasa");
        var cabang = $(this).data("cabang");
        $('#menu-table-data-penilaian-jasa').html(
            '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        $.ajax({
            url: "{{ route('master_jasa_remove_detail_penilaian') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "log": log,
                "supplier": supplier,
                "cabang": cabang,
                "jasa": jasa
            },
            dataType: 'html',
        }).done(function(data) {
            $('#menu-table-data-penilaian-jasa').html(data);
        }).fail(function() {
            $('#menu-table-data-penilaian-jasa').html('eror');
        });
    });
</script>
@endsection
