@extends('layouts.template')
@section('base.css')

@endsection
@section('content')
<div class="card mb-3">
    <div class="card-body border-top">
        <div class="d-flex">
            <div class="flex-1">
                <h5 class="fw-bold text-dark"><i class="bi bi-calendar-week text-primary"></i>Validasi System Bisone</h5>
                <p class="text-muted mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae veritatis ut repellat error fuga fugit ea facere, id quia dolorum delectus illo optio? Dignissimos velit, libero et aliquam veritatis cum..</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-xl-4">
        <div class="card">
            <div class="card-header bg-primary btn-reveal-trigger d-flex flex-between-center">
                <h5 class="mb-0 text-white">Create Rencana Validasi</h5>
                <!-- <button class="btn btn-dark btn-sm"><span class="fas fa-plus"></span></button> -->
            </div>
            <div class="card-body">
                <form id="form-validasi-bisone" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    <div class="mb-3">
                        <label for="cabang" class="form-label fw-semibold">Cabang Perusahaan</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-building"></i></span>
                            <select class="form-select form-select-lg" id="cabang" name="cabang" required>
                                <option value="" selected disabled>Pilih Cabang Terlebih Dahulu...</option>
                                @foreach ($cabang as $cab)
                                <option value="{{ $cab->kd_cabang }}">{{ $cab->nama_cabang }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Silakan pilih cabang terlebih dahulu.</div>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-sm-6">
                            <label for="bulan" class="form-label fw-semibold">Bulan</label>
                            <select class="form-select" id="bulan" name="bulan" required>
                                <option value="" selected disabled>Pilih Bulan...</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <label for="tahun" class="form-label fw-semibold">Tahun</label>
                            <select class="form-select" id="tahun" name="tahun" required>
                                <option value="" selected disabled>Pilih Tahun...</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer d-flex justify-content-between bg-300">
                <button type="reset" class="btn btn-danger px-3 text-white me-md-2">Reset</button>
                <button type="submit" class="btn btn-primary px-3" id="button-save-validasi">Simapn Data Validasi</button>
            </div>
        </div>
    </div>
    <div class="col-xl-8">
        <div class="card mb-3">
            <div class="card-header bg-primary">
                <div class="row flex-between-center">
                    <div class="col-sm-auto">
                        <h5 class="mb-2 mb-sm-0 text-white"><span class="fas fa-pdf"></span> Data Rekap</h5>
                    </div>
                    <div class="col-sm-auto">

                    </div>
                </div>
            </div>
            <div class="card-body" id="menu-validasi-bisone">

            </div>
        </div>

    </div>
</div>
@endsection
@section('base.js')
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>

<script>
    $(document).on("click", "#button-save-validasi", function(e) {
        e.preventDefault();
        var data = $("#form-validasi-bisone").serialize();
        $('#menu-validasi-bisone').html(
            '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        $.ajax({
            url: "{{ route('menu_validasi_sistem_save') }}",
            type: "POST",
            cache: false,
            data: data,
            dataType: 'html',
        }).done(function(data) {
            $('#menu-validasi-bisone').html(data);
        }).fail(function() {
            $('#menu-validasi-bisone').html('eror');
        });
    });
    document.getElementById('cabang').addEventListener('change', function() {
        const cabang = document.getElementById('cabang').value;
        $.ajax({
            url: "{{ route('menu_validasi_sistem_get') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "cabang": cabang
            },
            dataType: 'html',
        }).done(function(data) {
            $('#menu-validasi-bisone').html(data);
        }).fail(function() {
            $('#menu-validasi-bisone').html('eror');
        });
    });
    $(document).on("click", "#button-proses-validasi-bisone", function(e) {
        e.preventDefault();
        var code = $(this).data("code");
        $('#menu-template').html(
            '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        $.ajax({
            url: "{{ route('menu_validasi_sistem_proses') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "code": code
            },
            dataType: 'html',
        }).done(function(data) {
            $('#menu-template').html(data);
        }).fail(function() {
            $('#menu-template').html('eror');
        });
    });
</script>
@endsection
