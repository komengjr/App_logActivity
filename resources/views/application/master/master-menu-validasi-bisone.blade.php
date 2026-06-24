@extends('layouts.template')
@section('base.css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.4/css/responsive.bootstrap5.css">
@endsection
@section('content')

<div class="card mb-3">
    <div class="card-body border-top">
        <div class="d-flex">
            <div class="flex-1">
                <h5 class="fw-bold text-dark"><i class="bi bi-calendar-week text-primary"></i>Master Menu Validasi</h5>
                <p class="text-muted mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit voluptatibus, ducimus ea ut ipsam laborum error doloribus consectetur! Quibusdam repudiandae animi atque consequuntur cum in? Necessitatibus deserunt quod sequi laudantium!</p>
            </div>
        </div>
    </div>
</div>
<div class="card mb-3 border border-success">
    <div class="card-header bg-primary">
        <div class="d-flex justify-content-between">
            <div>
                <a class="btn btn-falcon-default btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#modal-template" id="button-add-data-kategori">
                    <span class="fas fa-plus me-2"></span> Create Kategori
                </a>
                <!-- <span class="mx-1 mx-sm-2 text-300">|</span>
                <button class="btn btn-falcon-default btn-sm" type="button" data-bs-toggle="tooltip"
                    data-bs-placement="top" title="" data-bs-original-title="Archive" aria-label="Archive"><span
                        class="fas fa-print"></span></button> -->

            </div>
            <div class="d-flex">

            </div>
        </div>
    </div>
    <div class="card-body">
        <table id="example" class="table table-striped" style="width:100%">
            <thead class="bg-300 fs--1">
                <tr>
                    <th>No</th>
                    <th>Kategori Menu</th>
                    <th>Sub Menu</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="fs--1">
                @php
                $no = 1;
                @endphp
                @foreach ($data as $datas)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $datas->b_menus_kategori }} </td>
                    <td>{{ $datas->b_menus_code }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <button class="btn btn-sm btn-falcon-primary dropdown-toggle" id="btnGroupVerticalDrop2"
                                type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span
                                    class="fas fa-align-left me-1" data-fa-transform="shrink-3"></span>Menu</button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop2">
                                <button class="dropdown-item text-dark" data-bs-toggle="modal" data-bs-target="#modal-cabang"
                                    id="button-update-data-cabang" data-code="{{$datas->b_menus_code}}"><span
                                        class="fas fa-edit me-2"></span> Update Cabang</button>
                                <button class="dropdown-item text-primary" data-bs-toggle="modal" data-bs-target="#modal-cabang"
                                    id="button-add-data-petugas" data-code="{{$datas->b_menus_code}}"><span
                                        class="fas fa-user-check me-2"></span> Add Petugas</button>
                                <button class="dropdown-item text-info" data-bs-toggle="modal" data-bs-target="#modal-cabang"
                                    id="button-proses-tagihan-bulanan" data-code="{{$datas->b_menus_code}}"><span
                                        class="fas fa-user-cog me-2"> </span> Add Verifikator</button>
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
<div class="modal fade" id="modal-cabang" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content border-0">
            <div class="position-absolute top-0 end-0 mt-3 me-3 z-index-1">
                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="menu-cabang"></div>
        </div>
    </div>
</div>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.4/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.4/js/responsive.bootstrap5.js"></script>
<script>
    new DataTable('#example', {
        responsive: true
    });
</script>
<script>
    $(document).on("click", "#button-add-data-kategori", function(e) {
        e.preventDefault();
        var code = $(this).data("code");
        $('#menu-template').html(
            '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        $.ajax({
            url: "{{ route('master_data_menu_validasi_add') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "code": 123
            },
            dataType: 'html',
        }).done(function(data) {
            $('#menu-template').html(data);
        }).fail(function() {
            $('#menu-template').html('eror');
        });
    });
    $(document).on("click", "#button-simpan-update-cabang", function(e) {
        e.preventDefault();
        var data = $("#form-update-cabang").serialize();
        $('#menu-update-data-cabang').html(
            '<div class="spinner-border my-0" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        $.ajax({
            url: "{{ route('master_data_cabang_update_save') }}",
            type: "POST",
            cache: false,
            data: data,
            dataType: 'html',
        }).done(function(data) {
            if (data == 0) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong!",
                    footer: '<a href="#">Why do I have this issue?</a>'
                });
                $('#menu-update-data-cabang').html('<button class="btn btn-success float-end" id="button-simpan-update-cabang">Simpan Data</button>');
            } else {
                Swal.fire('Berhasil!', 'Data Cabang Berhasil di Update', 'success').then(() => {
                    location.reload();
                });
            }
        }).fail(function() {
            $('#menu-update-data-cabang').html('eror');
        });
    });
    $(document).on("click", "#button-add-data-petugas", function(e) {
        e.preventDefault();
        var code = $(this).data("code");
        $('#menu-cabang').html(
            '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        $.ajax({
            url: "{{ route('master_data_cabang_add_petugas') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "code": code
            },
            dataType: 'html',
        }).done(function(data) {
            $('#menu-cabang').html(data);
        }).fail(function() {
            $('#menu-cabang').html('eror');
        });
    });
    $(document).on("click", "#button-simpan-data-petugas", function(e) {
        e.preventDefault();
        var data = $("#form-add-petugas-cabang").serialize();
        $('#menu-add-data-petugas').html(
            '<div class="spinner-border my-0" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        $.ajax({
            url: "{{ route('master_data_cabang_save_petugas') }}",
            type: "POST",
            cache: false,
            data: data,
            dataType: 'html',
        }).done(function(data) {
            if (data == 0) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong!",
                    footer: '<a href="#">Why do I have this issue?</a>'
                });
                $('#menu-add-data-petugas').html('<button class="btn btn-success float-end" id="button-simpan-data-petugas">Simpan Data</button>');
            } else {
                Swal.fire('Berhasil!', 'Data Cabang Berhasil di Update', 'success').then(() => {
                    location.reload();
                });
            }
        }).fail(function() {
            $('#menu-add-data-petugas').html('eror');
        });
    });
</script>
@endsection
