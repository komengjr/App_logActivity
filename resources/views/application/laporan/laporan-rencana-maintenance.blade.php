@extends('layouts.template')
@section('content')
<div class="card shadow-sm border-0 mb-3">
    <div class="card-body">
        <h3 class="card-title mb-1 fw-bold">Daftar Laporan Tugas</h3>
        <p class="text-muted mb-0">Manajemen dan pemantauan status laporan terkini</p>
    </div>
</div>

<div class="card shadow-sm mb-4 no-print">
    <div class="card-header bg-dark text-white fw-semibold">
        <i class="bi bi-filter-square me-2"></i>Parameter Laporan
    </div>
    <div class="card-body">
        <form id="formFilter" class="row g-3">
            <div class="col-md-5">
                <label for="filterPetugas" class="form-label fw-bold">Petugas IT Penanggung Jawab</label>
                <select id="filterPetugas" class="form-select" required>
                    <option value="" selected disabled>-- Pilih Petugas --</option>
                    @foreach ($user as $users)
                    <option value="{{ $users->id_user }}">{{ $users->nama_lengkap }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="filterTahun" class="form-label fw-bold">Tahun Pelaksanaan</label>
                <select id="filterTahun" class="form-select" required>
                    <option value="" selected disabled>-- Pilih Tahun --</option>
                    <option value="2026">2026</option>
                    <option value="2025">2025</option>
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="button" class="btn btn-primary w-100 fw-semibold shadow-sm" onclick="tampilkanJadwalBulan()">
                    <i class="bi bi-arrow-right-circle me-2"></i>Generasikan Jadwal
                </button>
            </div>
        </form>
    </div>
</div>

<div id="areaJadwal">


</div>
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
<script>
    function tampilkanJadwalBulan() {
        const petugas = document.getElementById('filterPetugas').value;
        const tahun = document.getElementById('filterTahun').value;
        $('#areaJadwal').html(
            '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        if (!petugas || !tahun) {
            alert('Peringatan: Harap pilih Nama Petugas dan Tahun Anggaran terlebih dahulu!');
            return;
        }

        $.ajax({
            url: "{{ route('laporan_rencana_maintenance_detail') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "petugas": petugas,
                "tahun": tahun,
            },
            dataType: 'html',
        }).done(function(data) {
            $('#areaJadwal').html(data);
        }).fail(function() {
            console.log('eror');
        });


    }

    const options = {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    };
    document.getElementById('printDate').innerText = new Date().toLocaleDateString('id-ID', options);
</script>
@endsection
