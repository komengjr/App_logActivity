<style>
    .step-card {
        opacity: 1;
        max-height: 1000px;
        overflow: hidden;
        transition:
            opacity 0.0s cubic-bezier(0.4, 0, 0.2, 1),
            transform 0.0s cubic-bezier(0.4, 0, 0.2, 1),
            max-height 0.0s ease,
            padding 0.6s ease,
            margin 0.6s ease;
    }

    .step-card.vanished {
        opacity: 0;
        max-height: 0 !important;
        padding-top: 0 !important;
        padding-bottom: 0 !important;
        margin-bottom: 0 !important;
        border: none !important;
        pointer-events: none;
    }
</style>

<form class="p-2" id="laporanForm" onsubmit="event.preventDefault();">

    <!-- TAHAP 1: REGISTRASI KENDALA -->
    <div class="card shadow-sm mb-4 step-card" id="tahap-1">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <span class="fw-semibold">Tahap 1: Registrasi Kendala</span>
            <span class="badge bg-white text-primary">Baru</span>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="nama" class="form-label fw-bold small">Nama Pelapor</label>
                <div class="input-group flex-nowrap"><span class="input-group-text" id="addon-wrapping"><span class="fas fa-user"></span></span>
                    <input type="text" class="form-control form-control-lg" id="nama" value="{{ $data->laporan_security_user }}" readonly>
                </div>

            </div>
            <div class="mb-3">
                <label for="nama" class="form-label fw-bold small">NIP</label>
                <div class="input-group flex-nowrap"><span class="input-group-text" id="addon-wrapping"><span class="fas fa-user"></span></span>
                    <input type="text" class="form-control form-control-lg" id="nama" value="{{ $data->laporan_security_nip }}" readonly>
                </div>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label fw-bold small">Divisi</label>
                <div class="input-group flex-nowrap"><span class="input-group-text" id="addon-wrapping"><span class="fas fa-user"></span></span>
                    <input type="text" class="form-control form-control-lg" id="nama" value="{{ $data->laporan_security_divisi }}" readonly>
                </div>
            </div>
            <div class="mb-3">
                <label for="kendala" class="form-label fw-bold small">Detail Kendala</label>
                ifelse
                <div class="input-group flex-nowrap"><span class="input-group-text" id="addon-wrapping"><span class="far fa-address-book"></span></span>
                    <textarea class="form-control" id="kendala" rows="3" placeholder="Ceritakan detail kendala atau kerusakan..." readonly>{{ $data->laporan_security_desc }}</textarea>
                </div>
            </div>
            <div class="mb-4">
                <label for="kendala" class="form-label fw-bold small">Detail Bukti</label>
                @if ($data->laporan_security_file != "")
                <div class="image-wrapper mx-auto">
                    <img src="{{ asset('storage/bukti_kasus/'.$data->laporan_security_file) }}"
                        alt="Gambar Dinamis"
                        class="img-fluid rounded shadow dynamic-img">
                </div>
                @else
                <span class="badge bg-warning">Lampiran Tidak di tampilkan</span>
                @endif

            </div>
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-danger me-2 float-start" data-bs-dismiss="modal">Close</button>
                <div id="loading_terima">
                    <button type="button" class="btn btn-primary" onclick="terimaLaporan()">Terima Laporan &rarr;</button>
                </div>
            </div>
        </div>
    </div>

    <!-- TAHAP 2: ALOKASI & PROSES -->
    <div class="card shadow-sm mb-4 step-card d-none" id="tahap-2">
        <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
            <span class="fw-semibold">Tahap 2: Tindakan & Proses</span>
            <span class="badge bg-dark text-white">Diproses</span>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="kendala" class="form-label fw-bold small">Detail Kendala</label>
                    <div class="input-group flex-nowrap"><span class="input-group-text" id="addon-wrapping"><span class="far fa-address-book"></span></span>
                        <textarea class="form-control" id="kendala" rows="3" placeholder="Ceritakan detail kendala atau kerusakan..." readonly>{{ $data->laporan_security_desc }}</textarea>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="petugas" class="form-label fw-bold small">Yang di Lakukan Oleh</label>
                    <div class="input-group flex-nowrap"><span class="input-group-text" id="addon-wrapping"><span class="fas fa-user"></span></span>
                        <select class="form-select form-select-lg" name="petugas" id="petugas" required>
                            <option value="">Pilih</option>
                            <option value="I">Internal</option>
                            <option value="E">Eksternal</option>
                        </select>
                    </div>

                    <input type="text" name="tiket" id="tiket" value="{{ $data->laporan_security_code }}" hidden>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="estimasi" class="form-label fw-bold small">Estimasi Tanggal Pengerjaan</label>
                    <div class="input-group flex-nowrap"><span class="input-group-text" id="addon-wrapping"><span class="fas fa-calendar"></span></span>
                        <input type="date" class="form-control form-control-lg" id="estimasi_tgl" required>
                    </div>

                </div>
                <div class="col-md-6 mb-4">
                    <label for="estimasi" class="form-label fw-bold small">Estimasi Waktu Pengerjaan</label>
                    <div class="input-group flex-nowrap"><span class="input-group-text" id="addon-wrapping"><span class="fas fa-calendar"></span></span>
                        <input type="time" class="form-control form-control-lg" id="estimasi_time" placeholder="Contoh: 2 jam / 1 hari kerja" required>
                    </div>

                </div>
            </div>
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-danger me-2" data-bs-dismiss="modal">Close</button>
                <div id="loading_proses">
                    <button type="button" class="btn btn-warning fw-semibold text-dark" onclick="prosesLaporan()">Simpan & Lanjut &rarr;</button>
                </div>
            </div>
        </div>
    </div>

    <!-- TAHAP 3: SOLUSI & PENYELESAIAN -->
    <div class="card shadow-sm mb-4 step-card d-none" id="tahap-3">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <span class="fw-semibold">Tahap 3: Solusi & Penyelesaian</span>
            <span class="badge bg-white text-success">Resolusi</span>
        </div>
        <div class="card-body">
            <div class="col-md-12 mb-3">
                <label for="kendala" class="form-label fw-bold small">Detail Kendala</label>
                <div class="input-group flex-nowrap"><span class="input-group-text" id="addon-wrapping"><span class="far fa-address-book"></span></span>
                    <textarea class="form-control" id="kendala" rows="3" placeholder="Ceritakan detail kendala atau kerusakan..." readonly>{{ $data->laporan_security_desc }}</textarea>
                </div>
            </div>
            <div class="mb-4">
                <label for="solusi" class="form-label fw-bold small">Tindakan Penyelesaian</label>
                <textarea class="form-control" id="solusi" rows="3" placeholder="Tuliskan perbaikan/solusi yang sudah diterapkan..." required></textarea>
            </div>
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-danger me-2" data-bs-dismiss="modal">Close</button>
                <div id="loading_penyelesaian">
                    <button type="button" class="btn btn-success" onclick="selesaikanLaporan()">Selesaikan Laporan ✓</button>
                </div>
            </div>
        </div>
    </div>

</form>
@php
$ids = mt_rand(100, 999);
@endphp
<script>
    const cardTahap1<?php echo $ids ?> = document.getElementById('tahap-1');
    const cardTahap2<?php echo $ids ?> = document.getElementById('tahap-2');
    const cardTahap3<?php echo $ids ?> = document.getElementById('tahap-3');

    if ("{{ $data->laporan_security_respon }}" != "" && "{{ $data->laporan_security_proses }}" != "") {
        cardTahap1<?php echo $ids ?>.classList.add('d-none'); // Sembunyikan Tahap 1 instant
        cardTahap2<?php echo $ids ?>.classList.add('d-none'); // Sembunyikan Tahap 2 instant
        cardTahap3<?php echo $ids ?>.classList.remove('d-none'); // Langsung tampilkan Tahap 3
    } else if ("{{ $data->laporan_security_respon }}" != "") {
        cardTahap1<?php echo $ids ?>.classList.add('d-none');
        cardTahap2<?php echo $ids ?>.classList.remove('d-none');
    }



    function terimaLaporan() {
        const nama = document.getElementById('nama').value;
        const kendala = document.getElementById('kendala').value;
        const tiket = document.getElementById('tiket').value;
        if (!nama || !kendala) {
            alert('Harap isi nama pelapor dan detail kendala.');
            return;
        } else {
            $('#loading_terima').html(
                '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
            );
            $.ajax({
                url: "{{ route('dashboard_get_message_proses_security_terima') }}",
                type: "POST",
                cache: false,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "code": tiket,
                },
                dataType: 'html',
            }).done(function(data) {
                if (data == 0) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Gagal Melakukan Proses Selanjutnya",
                        footer: "<a href=\"#\">Why do I have this issue?</a>"
                    });
                } else {
                    Swal.fire('Berhasil!', 'Nomor Tiket Telah diterima. Pastikan No Tiket Ini diselesaikan', 'success').then(() => {

                    });
                    // Alur transisi buka Tahap 2
                    const tahap2<?php echo $ids ?> = document.getElementById('tahap-2');
                    tahap2<?php echo $ids ?>.classList.remove('d-none');
                    document.getElementById('tahap-1').classList.add('vanished');
                }
            }).fail(function() {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Gagal Melakukan Proses Selanjutnya",
                    footer: "<a href=\"#\">Why do I have this issue?</a>"
                });
            });
        }
    }

    function prosesLaporan() {
        const petugas = document.getElementById('petugas').value;
        const estimasi_tgl = document.getElementById('estimasi_tgl').value;
        const estimasi_time = document.getElementById('estimasi_time').value;
        const tiket = document.getElementById('tiket').value;

        if (!petugas || !estimasi_tgl || !estimasi_time) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Udah di Pilih Belom tuh",
                footer: "<a href=\"#\">Why do I have this issue?</a>"
            });
            return;
        } else {
            $('#loading_proses').html(
                '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
            );
            $.ajax({
                url: "{{ route('dashboard_get_message_proses_security_tindakan') }}",
                type: "POST",
                cache: false,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "code": tiket,
                    "petugas": petugas,
                    "estimasi_tgl": estimasi_tgl,
                    "estimasi_time": estimasi_time,
                },
                dataType: 'html',
            }).done(function(data) {
                if (data == 0) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Gagal Melakukan Proses Selanjutnya",
                        footer: "<a href=\"#\">Why do I have this issue?</a>"
                    });
                } else {
                    const tahap3<?php echo $ids ?> = document.getElementById('tahap-3');
                    tahap3<?php echo $ids ?>.classList.remove('d-none');
                    document.getElementById('tahap-2').classList.add('vanished');
                }
            }).fail(function() {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Gagal Melakukan Proses Selanjutnya",
                    footer: "<a href=\"#\">Why do I have this issue?</a>"
                });
            });
        }
    }

    function selesaikanLaporan() {
        const solusi = document.getElementById('solusi').value;
        const tiket = document.getElementById('tiket').value;
        if (!solusi) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Ngisi Ape bang ?",
                footer: "<a href=\"#\">Why do I have this issue?</a>"
            });
            return;
        } else {
            $('#loading_penyelesaian').html(
                '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
            );
            $.ajax({
                url: "{{ route('dashboard_get_message_proses_security_finish') }}",
                type: "POST",
                cache: false,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "code": tiket,
                    "solusi": solusi,
                },
                dataType: 'html',
            }).done(function(data) {
                if (data == 0) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Gagal Melakukan Proses Selanjutnya",
                        footer: "<a href=\"#\">Why do I have this issue?</a>"
                    });
                } else {
                    document.getElementById('tahap-3').classList.add('vanished');

                    setTimeout(() => {
                        Swal.fire('Berhasil!', 'Nomor Tiket Telah Selesaikan. Pastikan No Tiket Ini disimpan', 'success').then(() => {
                            location.reload();
                        });
                    }, 500);
                }
            }).fail(function() {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Gagal Melakukan Proses Selanjutnya",
                    footer: "<a href=\"#\">Why do I have this issue?</a>"
                });
            });
        }
    }
</script>
