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
                <h5 class="fw-bold text-dark"><i class="bi bi-calendar-week text-primary"></i>Master Data Log Bisone</h5>
                <p class="text-muted mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit voluptatibus, ducimus ea ut ipsam laborum error doloribus consectetur! Quibusdam repudiandae animi atque consequuntur cum in? Necessitatibus deserunt quod sequi laudantium!</p>
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-xl-12">

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0 text-white"><i class="bi bi-filter-square me-2"></i>Filter Log Data & Tabel</h5>
            </div>
            <div class="card-body">
                <form id="formFilter">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label for="cabang" class="form-label fw-semibold">Pilih Cabang</label>
                            <select class="form-select" id="cabang" required>
                                <option value="" selected disabled>-- Pilih Cabang --</option>
                                @foreach ($cabang as $cab)
                                <option value="{{ $cab->kd_cabang }}">{{ $cab->nama_cabang }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="namaTabel" class="form-label fw-semibold">Pilih Tabel Database</label>
                            <select class="form-select" id="namaTabel" required>
                                <option value="" selected disabled>-- Pilih Tabel --</option>
                                <option value="log_login">Log Login</option>
                                <option value="result_handoveremail_log">Email Log</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="waktuMulai" class="form-label fw-semibold">Dari (Tanggal & Waktu)</label>
                            <input type="datetime-local" class="form-control" id="waktuMulai" required>
                        </div>

                        <div class="col-md-3">
                            <label for="waktuSelesai" class="form-label fw-semibold">Sampai (Tanggal & Waktu)</label>
                            <input type="datetime-local" class="form-control" id="waktuSelesai" required>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12 text-end">
                            <button type="reset" class="btn btn-outline-secondary me-2">
                                <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-primary" id>
                                <i class="bi bi-search me-1"></i> Tampilkan Data
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm d-none" id="cardLog">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0"><i class="bi bi-journal-text me-2"></i>Hasil Log Aktivitas</h5>
                <span class="badge bg-success" id="infoFilter">Detail Filter: -</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tanggal & Waktu</th>
                                <th scope="col">Cabang</th>
                                <th scope="col">Nama Tabel</th>
                                <th scope="col">Aktivitas / Query</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody id="tabelDataLog">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
<div id="data-table-log"></div>
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
    document.getElementById('formFilter').addEventListener('submit', function(event) {
        event.preventDefault();

        // Ambil seluruh data dari form
        const cabang = document.getElementById('cabang').value;
        const namaTabel = document.getElementById('namaTabel').value;
        const waktuMulai = document.getElementById('waktuMulai').value;
        const waktuSelesai = document.getElementById('waktuSelesai').value;
        $('#data-table-log').html(
            '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        $.ajax({
            url: "{{ route('master_data_log_get_data') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "cabang": cabang,
                "table": namaTabel,
                "start": waktuMulai,
                "end": waktuSelesai,
            },
            dataType: 'html',
        }).done(function(data) {
            if (data == 0) {
                alert('eror');
            } else {
                $('#data-table-log').html(data);
            }
        }).fail(function() {
            $('#data-table-log').html('eror');
        });
    });

    // Sembunyikan tabel kembali saat tombol reset diklik
    document.getElementById('formFilter').addEventListener('reset', function() {
        document.getElementById('cardLog').classList.add('d-none');
    });
</script>
@endsection
