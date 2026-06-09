@extends('layouts.template')
@section('base.css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.4/css/responsive.bootstrap5.css">
@endsection
@section('content')
<style>
    /* .d-none-filtered {
        display: none;
    } */
</style>
<div class="card mb-3">
    <div class="card-body border-top">
        <div class="d-flex">
            <div class="flex-1">
                <h5 class="fw-bold text-dark"><i class="bi bi-calendar-week text-primary"></i>Monitoring Terintegrasi & Log Sistem</h5>
                <p class="text-muted mb-0">Masukkan rentang tanggal untuk menyajikan visualisasi data berkala.</p>
            </div>
        </div>
    </div>
</div>

<div class="card mb-3 border-start border-primary border-3">
    <div class="card-body">
        <h5 class="card-title h6 fw-bold text-primary mb-3"><i class="fas fa-filter-square me-2"></i>Filter Rentang Tanggal Data</h5>
        <div class="row g-3 align-items-end">
            <div class="col-md-4">
                <label for="tanggalMulai" class="form-label small fw-bold">Tanggal Mulai</label>
                <input type="date" class="form-control" id="tanggalMulai" required>
            </div>
            <div class="col-md-4">
                <label for="tanggalSelesai" class="form-label small fw-bold">Tanggal Selesai</label>
                <input type="date" class="form-control" id="tanggalSelesai" required>
            </div>
            <div class="col-md-4">
                <button type="button" id="btnTerapkanFilter" class="btn btn-primary w-100">
                    <i class="bi bi-search me-1"></i> Tampilkan Data
                </button>
            </div>
        </div>
    </div>
</div>
<span id="hasil-get-data">
    <div id="placeholderAlert" class="alert alert-info text-center py-5">
        <i class="bi bi-calendar-range fs-1 d-block mb-3 text-primary"></i>
        <h5>Silahkan Tentukan Rentang Tanggal</h5>
        <p class="text-muted small mb-0">Pilih rentang tanggal pada panel di atas dan klik tombol "Tampilkan Data" untuk memuat laporan.</p>
    </div>
</span>



@endsection
@section('base.js')
<div class="modal fade" id="modal-log-it" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content border-0">
            <div class="position-absolute top-0 end-0 mt-3 me-3 z-index-1">
                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="menu-log-it"></div>
        </div>
    </div>
</div>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.4/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.4/js/responsive.bootstrap5.js"></script>
<script>
    $(document).on("click", "#btnTerapkanFilter", function(e) {
        e.preventDefault();
        const awal = document.getElementById('tanggalMulai').value;
        const akhir = document.getElementById('tanggalSelesai').value;
        $('#hasil-get-data').html(
            '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        $.ajax({
            url: "{{ route('dashboard_verifikator_get_data') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "awal": awal,
                "akhir": akhir,
            },
            dataType: 'html',
        }).done(function(data) {
            $("#hasil-get-data").html(data);
        }).fail(function() {
            $('#hasil-get-data').html('eror');
        });
    });
    $(document).on("click", "#button-cetak-hasil-maintenance", function(e) {
        e.preventDefault();
        var code = $(this).data("code");
        var petugas = $(this).data("petugas");
        $('#menu-log-it').html(
            '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        $.ajax({
            url: "{{ route('laporan_rencana_maintenance_cetak') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "code": code,
                "petugas": petugas
            },
            dataType: 'html',
        }).done(function(data) {
            $('#menu-log-it').html(data);
        }).fail(function() {
            $('#menu-log-it').html('eror');
        });
    });
</script>
@endsection
