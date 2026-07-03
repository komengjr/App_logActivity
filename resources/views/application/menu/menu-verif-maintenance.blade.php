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
                <h5 class="fw-bold text-dark"><i class="bi bi-calendar-week text-primary"></i>Sistem Verifikasi Hasil Maintenance IT</h5>
                <p class="text-muted mb-0">Tahap 3: Verifikasi Hasil.</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-header bg-primary pb-1">
                <h4 class="fw-bold text-white"><i class="fas fa-funnel-fill me-2"></i>Filter Pencarian</h4>
            </div>
            <div class="card-body p-4">
                <form id="filterForm" class="row g-3">
                    <div class="col-md-3">
                        <label for="filterCabang" class="form-label text-muted small fw-semibold">1. Cabang</label>
                        <select id="filterCabang" class="form-select" onchange="loadOpsiTahun()">
                            <option value="">-- Semua Cabang --</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="filterTahun" class="form-label text-muted small fw-semibold">2. Tahun</label>
                        <select id="filterTahun" class="form-select" onchange="loadOpsiBulan()" disabled>
                            <option value="">-- Pilih Tahun --</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="filterBulan" class="form-label text-muted small fw-semibold">3. Bulan</label>
                        <select id="filterBulan" class="form-select" disabled>
                            <option value="">-- Pilih Bulan --</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="filterStatus" class="form-label text-muted small fw-semibold">4. Status Validasi Atasan</label>
                        <select id="filterStatus" class="form-select">
                            <option value="">-- Semua Status --</option>
                            <option value="belum" selected>Belum Diverifikasi</option>
                            <option value="sudah">Sudah Diverifikasi</option>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end gap-2">
                        <button type="button" class="btn btn-primary flex-fill" onclick="fetchDataTabel()"><i class="fas fa-search"></i> Cari</button>
                        <button type="button" class="btn btn-outline-secondary" onclick="resetSemuaFilter()"><i class="fas fa-undo"></i></button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-clickable align-middle mb-0" id="tabelMaintenance">
                        <thead class="table-primary text-secondary text-uppercase fs--1">
                            <tr>
                                <th class="ps-4">Cabang</th>
                                <th>Nama Komputer / Unit Barang</th>
                                <th>Petugas IT (User)</th>
                                <th>Tanggal Input</th>
                                <th>Status</th>
                                <th class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tabelBodyData"></tbody>
                    </table>
                </div>
                <div id="loadingIndicator" class="text-center p-5 d-none">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>
                <div id="noDataAlert" class="p-5 text-center text-muted">
                    <i class="bi bi-folder-x fs-1 d-block mb-2"></i> Data kosong atau tentukan parameter filter.
                </div>
            </div>
        </div>

        <div id="jsonOutputContainer" class="card shadow-sm border-0 d-none">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center py-3">
                <span class="fw-semibold"><i class="bi bi-code-slash me-2 text-warning"></i>Data Payload JSON Berhasil Di-update</span>
                <button class="btn btn-sm btn-outline-light px-3" onclick="document.getElementById('jsonOutputContainer').classList.add('d-none')">Sembunyikan</button>
            </div>
            <div class="card-body bg-light">
                <pre><code id="jsonRaw"></code></pre>
            </div>
        </div>

    </div>
</div>
@endsection
@section('base.js')
<div class="modal fade" id="modalVerifikasi" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title"><i class="bi bi-shield-check me-2"></i>Lembar Verifikasi Berita Acara</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div id="pageForm1" class="modal-body p-4">
                <div class="mb-3">
                    <label class="form-label text-muted mb-1">Nama Perangkat (m_rencana_detail_nama_brg)</label>
                    <input type="text" id="modalNamaBarang" class="form-control bg-light fw-bold" readonly>
                </div>
                <div class="mb-3">
                    <label for="ownerName" class="form-label fw-semibold">Nama Atasan Klinik (m_rencana_detail_verif) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="ownerName" placeholder="Contoh: Agus Raharjo">
                </div>

                <input type="hidden" id="hiddenIdDetail">
                <input type="hidden" id="hiddenCabang">
                <input type="hidden" id="hiddenPetugas">
                <input type="hidden" id="hiddenTanggal">

                <div class="text-end mt-4">
                    <button type="button" class="btn btn-dark px-4" onclick="kePageDua()">Buka Lembar Review & Ttd <i class="bi bi-arrow-right ms-1"></i></button>
                </div>
            </div>

            <div id="pageForm2" class="modal-body p-4 d-none">
                <div class="document-preview">
                    <div class="doc-title-box">
                        CHECKLIST PEMELIHARAAN SOFTWARE & PERALATAN IT PENDUKUNG BISONE<br>
                        LABORATORIUM KLINIK PRAMITA<br>
                        CABANG: <span id="docCabang" class="text-uppercase"></span>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">LOKASI / CABANG : <strong id="docCabangLabel"></strong></div>
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
                                <td colspan="2">HARDWARE & SOFTWARE</td>
                            </tr>
                            <tr>
                                <td>I. Pemeliharaan CPU Fisik & Sistem Operasi</td>
                                <td>Selesai dibersihkan, optimasi lancar.</td>
                            </tr>
                            <tr>
                                <td>II. Update Sistem Internal Bisone</td>
                                <td>Aplikasi internal berjalan stabil pada versi terbaru.</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="row text-center mt-4">
                        <div class="col-6">
                            <small class="text-muted d-block mb-1">Pelaksana Maintenance,</small>
                            <div class="my-4 text-primary fw-bold">[ VERIFIED BY IT SYSTEM ]</div>
                            <p class="fw-bold m-0 border-top pt-1 d-inline-block" style="min-width: 150px;" id="docSignTeknisi"></p>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block mb-1" id="docDateLabel"></small>
                            <small class="d-block mb-1">Mengetahui,</small>
                            <div class="signature-container mx-auto"><canvas id="signaturePad" class="signature-pad"></canvas></div>
                            <button type="button" class="btn btn-sm btn-link text-danger p-0 m-0 text-decoration-none" style="font-size: 10px;" onclick="signaturePad.clear()">Clear</button>
                            <br><strong class="border-top pt-1 d-inline-block" style="min-width: 150px;" id="docSignOwnerName"></strong>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-outline-secondary" onclick="kePageSatu()"><i class="bi bi-arrow-left"></i> Kembali</button>
                    <button type="button" class="btn btn-success px-4" onclick="prosesSimpanFinalKeLaravel()"><i class="bi bi-cloud-arrow-up-fill me-1"></i> Simpan & Tampilkan JSON</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    let signaturePad;
    let modalFormInstance;

    document.addEventListener("DOMContentLoaded", function() {
        modalFormInstance = new bootstrap.Modal(document.getElementById('modalVerifikasi'));
        signaturePad = new SignaturePad(document.getElementById('signaturePad'), {
            backgroundColor: 'rgba(255, 255, 255, 0)'
        });
        loadOpsiCabang();
        fetchDataTabel();
    });

    function loadOpsiCabang() {
        axios.get("{{ route('menu_verifikasi_maintenance_list_cabang') }}").then(res => {
            const select = document.getElementById('filterCabang');
            res.data.forEach(item => {
                select.innerHTML += `<option value="${item.cabang}">${item.cabang}</option>`;
            });
        });
    }

    function loadOpsiTahun() {
        const cabang = document.getElementById('filterCabang').value;
        const selectTahun = document.getElementById('filterTahun');
        const selectBulan = document.getElementById('filterBulan');
        selectTahun.innerHTML = '<option value="">-- Pilih Tahun --</option>';
        selectBulan.innerHTML = '<option value="">-- Pilih Bulan --</option>';
        selectBulan.disabled = true;

        if (!cabang) {
            selectTahun.disabled = true;
            return;
        }
        axios.get(`/menu/app/menu/verifikasi-maintenance/list-tahun?cabang=${cabang}`).then(res => {
            res.data.forEach(item => {
                selectTahun.innerHTML += `<option value="${item.tahun}">${item.tahun}</option>`;
            });
            selectTahun.disabled = false;
        });
    }

    function loadOpsiBulan() {
        const cabang = document.getElementById('filterCabang').value;
        const tahun = document.getElementById('filterTahun').value;
        const selectBulan = document.getElementById('filterBulan');
        selectBulan.innerHTML = '<option value="">-- Pilih Bulan --</option>';

        if (!tahun) {
            selectBulan.disabled = true;
            return;
        }
        axios.get(`/menu/app/menu/verifikasi-maintenance/list-bulan?cabang=${cabang}&tahun=${tahun}`).then(res => {
            res.data.forEach(item => {
                selectBulan.innerHTML += `<option value="${item.bulan_nama}">${item.bulan_nama}</option>`;
            });
            selectBulan.disabled = false;
        });
    }

    function fetchDataTabel() {
        document.getElementById('tabelBodyData').innerHTML = '';
        document.getElementById('noDataAlert').classList.add('d-none');
        document.getElementById('loadingIndicator').classList.remove('d-none');

        const cabang = document.getElementById('filterCabang').value;
        const tahun = document.getElementById('filterTahun').value;
        const bulan = document.getElementById('filterBulan').value;
        const status = document.getElementById('filterStatus').value;

        axios.get(`/menu/app/menu/verifikasi-maintenance/data-perangkat?cabang=LA&tahun=${tahun}&bulan=${bulan}&status=${status}`)
            .then(res => {
                document.getElementById('loadingIndicator').classList.add('d-none');
                if (res.data.data.length === 0) {
                    document.getElementById('noDataAlert').classList.remove('d-none');
                    return;
                }

                res.data.data.forEach(row => {
                    const badgeStatus = row.signature_base64 ?
                        `<span class="badge bg-success-subtle text-success border border-success px-2">Sudah Validasi</span>` :
                        `<span class="badge bg-warning-subtle text-warning border border-warning px-2">Belum Validasi</span>`;

                    const tombolAksi = row.signature_base64 ?
                        `<button class="btn btn-sm btn-outline-secondary disabled rounded-pill px-3">Selesai</button>` :
                        `<button class="btn btn-sm btn-dark rounded-pill px-3" onclick="event.stopPropagation(); bukaFormVerifikasi(${row.id}, '${row.nama_komputer}', '${row.cabang}', '${row.petugas_it}', '${row.tanggal_selesai}')">Verifikasi</button>`;

                    document.getElementById('tabelBodyData').innerHTML += `
                        <tr onclick="if(!${row.signature_base64 ? true : false}) bukaFormVerifikasi(${row.id}, '${row.nama_komputer}', '${row.cabang}', '${row.petugas_it}', '${row.tanggal_selesai}')">
                            <td class="ps-4 fw-semibold">${row.cabang}</td>
                            <td><div class="fw-bold text-dark">${row.nama_komputer}</div></td>
                            <td>${row.petugas_it}</td>
                            <td>${row.tanggal_selesai}</td>
                            <td>${badgeStatus}</td>
                            <td class="text-end pe-4">${tombolAksi}</td>
                        </tr>
                    `;
                });
            });
    }

    function resetSemuaFilter() {
        document.getElementById('filterForm').reset();
        document.getElementById('filterTahun').disabled = true;
        document.getElementById('filterBulan').disabled = true;
        fetchDataTabel();
    }

    function bukaFormVerifikasi(id, nama, cabang, petugas, tanggal) {
        document.getElementById('hiddenIdDetail').value = id;
        document.getElementById('modalNamaBarang').value = nama;
        document.getElementById('ownerName').value = "";
        document.getElementById('hiddenCabang').value = cabang;
        document.getElementById('hiddenPetugas').value = petugas;
        document.getElementById('hiddenTanggal').value = tanggal;
        kePageSatu();
        modalFormInstance.show();
    }

    function kePageSatu() {
        document.getElementById('pageForm1').classList.remove('d-none');
        document.getElementById('pageForm2').classList.add('d-none');
    }

    function kePageDua() {
        const name = document.getElementById('ownerName').value.trim();
        if (name === "") {
            alert("Nama validator wajib diisi!");
            return;
        }

        document.getElementById('docCabang').textContent = document.getElementById('hiddenCabang').value;
        document.getElementById('docCabangLabel').textContent = document.getElementById('hiddenCabang').value;
        document.getElementById('docNamaKomputer').textContent = document.getElementById('modalNamaBarang').value;
        document.getElementById('docSignTeknisi').textContent = document.getElementById('hiddenPetugas').value;
        document.getElementById('docSignOwnerName').textContent = name;
        document.getElementById('docDateLabel').textContent = "Tanggal: " + document.getElementById('hiddenTanggal').value;

        document.getElementById('pageForm1').classList.add('d-none');
        document.getElementById('pageForm2').classList.remove('d-none');

        setTimeout(() => {
            const canvas = document.getElementById('signaturePad');
            const r = Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * r;
            canvas.height = canvas.offsetHeight * r;
            canvas.getContext("2d").scale(r, r);
            signaturePad.clear();
        }, 150);
    }

    function prosesSimpanFinalKeLaravel() {
        if (signaturePad.isEmpty()) {
            alert("Silakan berikan tanda tangan terlebih dahulu!");
            return;
        }

        const payloadData = {
            id_detail: document.getElementById('hiddenIdDetail').value,
            nama_atasan: document.getElementById('ownerName').value,
            signature_base64: signaturePad.toDataURL("image/png")
        };

        axios.post('/menu/app/menu/verifikasi-maintenance/simpan-verifikasi', payloadData)
            .then(res => {
                document.getElementById('jsonRaw').textContent = JSON.stringify(payloadData, null, 2);
                document.getElementById('jsonOutputContainer').classList.remove('d-none');
                modalFormInstance.hide();
                alert(res.data.message);
                fetchDataTabel();
                Swal.fire('Berhasil!', 'Data Jadwal Sudah dibuat', 'success').then(() => {
                    location.reload();
                });
            });
    }
</script>
@endsection
