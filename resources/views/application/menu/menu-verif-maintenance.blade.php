@extends('layouts.template')
@section('base.css')
<style>
    * GAYA REVIEW DOKUMEN Sederhana */ .document-preview {
        background-color: #ffffff;
        border: 1px solid #000;
        padding: 30px;
        font-family: Arial, Helvetica, sans-serif;
        color: #000;
        font-size: 12px;
    }

    .doc-title-box {
        border: 2px solid #000;
        padding: 10px;
        text-align: center;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .table-doc {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .table-doc th,
    .table-doc td {
        border: 1px solid #000 !important;
        padding: 6px 10px !important;
        vertical-align: middle;
    }

    .table-doc th {
        text-align: center;
        background-color: #f8f9fa;
        font-weight: bold;
        text-transform: uppercase;
    }

    .bg-category {
        background-color: #e9ecef;
        font-weight: bold;
    }

    .indent-item {
        padding-left: 20px !important;
    }

    /* GAYA KANVAS TANDA TANGAN */
    .signature-container {
        position: relative;
        width: 100%;
        height: 120px;
        border: 1px dashed #6c757d;
        background-color: #fff;
        margin-top: 5px;
    }

    .signature-pad {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        cursor: crosshair;
    }

    .table-clickable tbody tr {
        cursor: pointer;
        transition: background 0.2s;
    }

    .table-clickable tbody tr:hover {
        background-color: #f1f3f5;
    }

    pre {
        background-color: #212529;
        color: #f8f9fa;
        padding: 15px;
        border-radius: 6px;
        max-height: 250px;
        overflow-y: auto;
    }
</style>
@endsection
@section('content')
<div class="card mb-3">

    <div class="card-body border-top">
        <div class="d-flex">
            <div class="flex-1">
                <h5 class="fw-bold text-dark"><i class="bi bi-calendar-week text-primary"></i>Verifikasi Hasil Data Maintenance</h5>
                <p class="text-muted mb-0">Tahap 3: Verifikasi Hasil.</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3 text-secondary"><i class="bi bi-filter-left me-2"></i>Filter Laporan</h6>
                <form id="filterForm" class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <select id="filterBulan" class="form-select">
                            <option value="">-- Semua Bulan --</option>
                            <option value="Juni">Juni</option>
                            <option value="Mei">Mei</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select id="filterTahun" class="form-select">
                            <option value="">-- Semua Tahun --</option>
                            <option value="2026">2026</option>
                        </select>
                    </div>
                    <div class="col-md-4 d-flex gap-2">
                        <button type="button" class="btn btn-primary flex-fill" onclick="cariDataMaintenance()"><i class="bi bi-search me-1"></i> Cari</button>
                        <button type="button" class="btn btn-outline-secondary" onclick="resetFilter()">Reset</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-clickable align-middle mb-0" id="tabelMaintenance">
                        <thead class="table-light text-secondary text-uppercase">
                            <tr>
                                <th class="ps-4">Kode Form</th>
                                <th>Nama Komputer / Lokasi</th>
                                <th>Petugas</th>
                                <th>Tanggal Selesai</th>
                                <th class="pe-4 text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr onclick="bukaFormVerifikasi('SDM-03-FRM-PP', 'PC-LAB-01 / LAB KLINIK PRAMITA (MATRAMAN)', 'Jhone Doe', '01 Juni 2026')">
                                <td class="ps-4 fw-bold text-primary">SDM-03-FRM-PP</td>
                                <td>
                                    <div class="fw-semibold">PC-LAB-01</div>
                                    <small class="text-muted">Laboratorium Klinik Pramita - Cabang Matraman</small>
                                </td>
                                <td>Jhone Doe</td>
                                <td class="kolom-tanggal">01 Juni 2026</td>
                                <td class="pe-4 text-end">
                                    <button class="btn btn-sm btn-primary px-3 rounded-pill">Verifikasi Dokumen <i class="bi bi-file-earmark-ruled ms-1"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div id="jsonOutputContainer" class="card shadow-sm border-0 d-none">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <span class="fw-semibold"><i class="bi bi-code-slash me-2"></i>Data JSON Hasil Kiriman Form</span>
                <button class="btn btn-sm btn-outline-light" onclick="document.getElementById('jsonOutputContainer').classList.add('d-none')">Sembunyikan</button>
            </div>
            <div class="card-body">
                <pre><code id="jsonRaw"></code></pre>
            </div>
        </div>

    </div>
</div>
@endsection
@section('base.js')
<div class="modal fade" id="modalVerifikasi" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content border-0 shadow">

            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title"><i class="bi bi-shield-check me-2"></i>Sistem Peninjauan Laporan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div id="pageForm1" class="modal-body p-4">
                <h6 class="text-secondary text-uppercase fw-bold mb-3">Halaman 1: Verifikasi Penanggung Jawab</h6>

                <div class="mb-3">
                    <label class="form-label text-muted mb-1">Nama Komputer / Unit Target</label>
                    <input type="text" id="modalNamaBarang" class="form-control bg-light fw-bold" readonly>
                </div>

                <div class="mb-3">
                    <label for="ownerName" class="form-label fw-semibold">Nama Penanggung Jawab / Atasan Klinik <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="ownerName" placeholder="Masukkan nama Anda (Contoh: Is Suryani)">
                </div>

                <div class="mb-3">
                    <label for="ownerJabatan" class="form-label fw-semibold">Jabatan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="ownerJabatan" placeholder="Contoh: Manager SDM & Umum">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Status Kelayakan Pemeliharaan <span class="text-danger">*</span></label>
                    <div>
                        <div class="form-check form-check-inline me-4">
                            <input class="form-check-input" type="radio" name="statusKerja" id="statusSesuai" value="Disetujui / Layak" checked>
                            <label class="form-check-label text-success fw-semibold" for="statusSesuai">Selesai Layak Guna</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="statusKerja" id="statusPerbaikan" value="Butuh Tindakan Lanjutan">
                            <label class="form-check-label text-danger fw-semibold" for="statusPerbaikan">Terdapat Komplain / Kendala</label>
                        </div>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="button" class="btn btn-dark px-4" onclick="kePageDua()">Buka Dokumen Laporan <i class="bi bi-arrow-right ms-1"></i></button>
                </div>
            </div>

            <div id="pageForm2" class="modal-body p-4 d-none">
                <h6 class="text-secondary text-uppercase fw-bold mb-3">Halaman 2: Lembar Review Berita Acara & Tanda Tangan</h6>

                <div class="document-preview">
                    <div class="text-end text-muted small mb-1" id="docKodeForm">SDM-03-FRM-PP.10/04</div>

                    <div class="doc-title-box">
                        CHECKLIST PEMELIHARAAN SOFTWARE & PERALATAN IT PENDUKUNG BISONE<br>
                        LABORATORIUM KLINIK PRAMITA<br>
                        CABANG: MATRAMAN
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">LOKASI / CABANG : <strong>MATRAMAN</strong></div>
                        <div class="col-6 text-end">NAMA KOMPUTER : <strong id="docNamaKomputer"></strong></div>
                    </div>

                    <table class="table table-doc">
                        <thead>
                            <tr>
                                <th style="width: 45%;">Maintenance Item</th>
                                <th style="width: 55%;">Catatan Hasil Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-category">
                                <td colspan="2">HARDWARE</td>
                            </tr>
                            <tr>
                                <td class="indent-item">I. CPU (Fan, Processor, Power Supply, Ruang CPU)</td>
                                <td>Selesai dibersihkan dari debu, thermal pasta diganti baru, putaran kipas lancar.</td>
                            </tr>
                            <tr>
                                <td class="indent-item">II. KABEL (Kabel LAN, Kabel Power)</td>
                                <td>Kondisi fisik kokoh, penguncian RJ45 normal, koneksi stabil.</td>
                            </tr>
                            <tr>
                                <td class="indent-item">III. MONITOR (Fungsi dasar & kecerahan)</td>
                                <td>Layar jernih, pengaturan tingkat kecerahan dikalibrasi ulang agar nyaman di mata.</td>
                            </tr>
                            <tr>
                                <td class="indent-item">IV. KEYBOARD & MOUSE (Label & Fungsi)</td>
                                <td>Semua tombol keyboard berfungsi empuk dan mouse optik merespons cepat.</td>
                            </tr>

                            <tr class="bg-category">
                                <td colspan="2">SOFTWARE</td>
                            </tr>
                            <tr>
                                <td class="indent-item">I. OPERATING SYSTEM (Windows/Linux)</td>
                                <td>OS Windows 11 Pro ter-aktivasi resmi, pengecekan registry aman.</td>
                            </tr>
                            <tr>
                                <td class="indent-item">II. SOFTWARE (Office, Adobe Reader, Apps Internal)</td>
                                <td>Microsoft Office & Aplikasi internal Bisone diperbarui ke versi stabil teranyar.</td>
                            </tr>
                            <tr>
                                <td class="indent-item">III. VIRUS DAN SEJENISNYA (Update Data Antivirus)</td>
                                <td>Proses Full Scan tuntas, database definisi virus terbaru berhasil diunduh.</td>
                            </tr>
                        </tbody>
                    </table>

                    <p class="mb-4">Status Akhir Konfirmasi Manager: <strong id="docStatusReview"></strong></p>

                    <div class="row pt-2 text-center">
                        <div class="col-6">
                            <small class="d-block mb-1 text-muted">Pelaksana Maintenance,</small>
                            <div class="my-4 text-primary fw-bold" style="font-size: 11px;">[ VERIFIED BY IT SYSTEM ]</div>
                            <p class="fw-bold m-0 border-top pt-1 d-inline-block" style="min-width: 150px;" id="docSignTeknisi"></p>
                            <div class="small text-muted">Staff IT Support</div>
                        </div>
                        <div class="col-6">
                            <small class="d-block mb-1 text-muted">Jakarta, 01 Juni 2026</small>
                            <small class="d-block mb-1">Mengetahui,</small>

                            <div class="signature-container mx-auto" style="max-width: 190px;">
                                <canvas id="signaturePad" class="signature-pad"></canvas>
                            </div>
                            <button type="button" class="btn btn-sm btn-link text-danger p-0 m-0 text-decoration-none" style="font-size: 10px;" onclick="signaturePad.clear()">
                                <i class="bi bi-arrow-counterclockwise"></i> Bersihkan Ttd
                            </button>

                            <p class="fw-bold m-0 border-top pt-1 d-inline-block" style="min-width: 150px;" id="docSignOwnerName"></p>
                            <div class="small text-muted" id="docSignOwnerJabatan"></div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-outline-secondary" onclick="kePageSatu()"><i class="bi bi-arrow-left"></i> Kembali</button>
                    <button type="button" class="btn btn-success px-4" onclick="prosesSimpanFinal()"><i class="bi bi-cloud-check-fill"></i> Simpan & Kirim Form</button>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
<script>
    let signaturePad;
    let modalFormInstance;

    document.addEventListener("DOMContentLoaded", function() {
        modalFormInstance = new bootstrap.Modal(document.getElementById('modalVerifikasi'));
        const canvas = document.getElementById('signaturePad');
        signaturePad = new SignaturePad(canvas, {
            backgroundColor: 'rgba(255, 255, 255, 0)'
        });
    });

    function bukaFormVerifikasi(kode, nama, petugas, tanggal) {
        document.getElementById('modalNamaBarang').value = nama;
        document.getElementById('ownerName').value = "";
        document.getElementById('ownerJabatan').value = "";
        document.getElementById('statusSesuai').checked = true;

        const modalEl = document.getElementById('modalVerifikasi');
        modalEl.setAttribute('data-kode', kode);
        modalEl.setAttribute('data-petugas', petugas);
        modalEl.setAttribute('data-tanggal', tanggal);

        kePageSatu();
        modalFormInstance.show();
    }

    function kePageSatu() {
        document.getElementById('pageForm1').classList.remove('d-none');
        document.getElementById('pageForm2').classList.add('d-none');
    }

    function kePageDua() {
        const name = document.getElementById('ownerName').value.trim();
        const jabatan = document.getElementById('ownerJabatan').value.trim();

        if (name === "" || jabatan === "") {
            alert("Nama Atasan/Pemilik dan Jabatan wajib diisi sebelum melanjutkan!");
            return;
        }

        const modalEl = document.getElementById('modalVerifikasi');

        document.getElementById('docNamaKomputer').textContent = document.getElementById('modalNamaBarang').value;
        document.getElementById('docKodeForm').textContent = modalEl.getAttribute('data-kode') + ".10/04";
        document.getElementById('docSignTeknisi').textContent = modalEl.getAttribute('data-petugas');
        document.getElementById('docSignOwnerName').textContent = name;
        document.getElementById('docSignOwnerJabatan').textContent = jabatan;

        const statusVal = document.querySelector('input[name="statusKerja"]:checked').value;
        document.getElementById('docStatusReview').textContent = statusVal;

        document.getElementById('pageForm1').classList.add('d-none');
        document.getElementById('pageForm2').classList.remove('d-none');

        // Render ulang canvas agar ttd presisi setelah display d-none dilepas
        setTimeout(() => {
            const canvas = document.getElementById('signaturePad');
            const ratio = Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext("2d").scale(ratio, ratio);
            signaturePad.clear();
        }, 150);
    }

    function prosesSimpanFinal() {
        if (signaturePad.isEmpty()) {
            alert("Silakan bubuhkan tanda tangan terlebih dahulu untuk memverifikasi dokumen.");
            return;
        }

        const signatureBase64 = signaturePad.toDataURL("image/png");
        const modalEl = document.getElementById('modalVerifikasi');

        const resultJson = {
            nomor_dokumen: "DOK-PRAMITA-" + Math.floor(Math.random() * 9000 + 1000),
            tipe_form: modalEl.getAttribute('data-kode'),
            nama_komputer: document.getElementById('modalNamaBarang').value,
            petugas_it: modalEl.getAttribute('data-petugas'),
            tanggal_maintenance: modalEl.getAttribute('data-tanggal'),
            penandatangan_dokumen: {
                nama: document.getElementById('ownerName').value,
                jabatan: document.getElementById('ownerJabatan').value,
                status_checklist: document.querySelector('input[name="statusKerja"]:checked').value,
                string_tanda_tangan_base64: signatureBase64
            }
        };

        document.getElementById('jsonRaw').textContent = JSON.stringify(resultJson, null, 2);
        document.getElementById('jsonOutputContainer').classList.remove('d-none');

        alert("Dokumen Laporan Berhasil Ditandatangani!");
        modalFormInstance.hide();
    }

    function cariDataMaintenance() {
        const bulan = document.getElementById('filterBulan').value.toLowerCase();
        const tahun = document.getElementById('filterTahun').value;
        const tabel = document.getElementById('tabelMaintenance');
        const barisData = tabel.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
        let ditemukan = false;

        for (let i = 0; i < barisData.length; i++) {
            const textTanggal = barisData[i].querySelector('.kolom-tanggal').textContent.toLowerCase();
            if ((bulan === "" || textTanggal.includes(bulan)) && (tahun === "" || textTanggal.includes(tahun))) {
                barisData[i].style.display = "";
                diterupakan = ditemukan = true;
            } else {
                barisData[i].style.display = "none";
            }
        }
    }

    function resetFilter() {
        document.getElementById('filterBulan').value = "";
        document.getElementById('filterTahun').value = "";
        cariDataMaintenance();
    }
</script>
@endsection
