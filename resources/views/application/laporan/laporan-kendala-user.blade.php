@extends('layouts.template')

@section('content')
<style>
    .bg-gradient-primary-dark {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
    }

    .ticket-badge {
        font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, monospace;
        font-size: 0.75rem;
        background-color: #f1f5f9;
        color: #334155;
        border: 1px dashed #cbd5e1;
        padding: 2px 6px;
        border-radius: 4px;
    }

    .table-custom tbody tr {
        transition: all 0.2s ease;
    }

    .table-custom tbody tr:hover {
        background-color: #f8fafc !important;
    }

    .status-dot {
        height: 6px;
        width: 6px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 4px;
    }

    /* CSS Khusus Cetak / Print */
    @media print {
        body * {
            visibility: hidden;
        }

        #printArea,
        #printArea * {
            visibility: visible;
        }

        #printArea {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }

        .no-print {
            display: none !important;
        }

        table {
            width: 100% !important;
            border-collapse: collapse !important;
        }

        th,
        td {
            border: 1px solid #dee2e6 !important;
            padding: 6px !important;
            font-size: 10px !important;
        }
    }
</style>

<!-- Banner Header Tema Helpdesk -->
<div class="card bg-gradient-primary-dark text-white shadow-sm border-0 mb-3 rounded-3 overflow-hidden no-print">
    <div class="card-body p-3 position-relative">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="d-flex align-items-center">
                    <div class="bg-white bg-opacity-20 p-2 rounded-3 me-3">
                        <i class="fas fa-headset fs-2 text-dark"></i>
                    </div>
                    <div>
                        <h3 class="card-title mb-0 fw-bold text-white fs-2">Pusat Laporan Kendala & Security</h3>
                        <p class="text-white-50 mb-0 fs--2">Monitoring gabungan kendala sistem dan keamanan secara real-time</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-md-end mt-2 mt-md-0">
                <span class="badge bg-white bg-opacity-10 text-dark px-2 py-1 rounded-pill border border-white border-opacity-25 fs--2">
                    <i class="fas fa-circle text-success me-1" style="font-size: 8px;"></i> System Online
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Card Filter, Range Tanggal & Cetak -->
<div class="card shadow-sm border-0 mb-3 rounded-3 no-print">
    <div class="card-body p-3">
        <div class="row g-2 align-items-end">
            <!-- Input Pencarian Teks -->
            <div class="col-12 col-md-3">
                <label class="form-label fs--2 fw-semibold text-secondary mb-1">Cari Kata Kunci</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted ps-2.5">
                        <i class="fas fa-search fs--2"></i>
                    </span>
                    <input type="text" id="searchInput" class="form-control bg-light border-start-0 ps-0 fs--2" placeholder="Kode, kendala, nama...">
                </div>
            </div>

            <!-- Filter Sumber Laporan -->
            <div class="col-12 col-md-2">
                <label class="form-label fs--2 fw-semibold text-secondary mb-1">Tipe Laporan</label>
                <select id="sourceFilter" class="form-select bg-light fs--2">
                    <option value="">Semua Tipe</option>
                    <option value="USER">Hardware & Software</option>
                    <option value="SECURITY">Security</option>
                </select>
            </div>

            <!-- Filter Range Tanggal -->
            <div class="col-6 col-md-2">
                <label class="form-label fs--2 fw-semibold text-secondary mb-1">Dari Tanggal</label>
                <input type="date" id="startDate" class="form-control bg-light fs--2">
            </div>
            <div class="col-6 col-md-2">
                <label class="form-label fs--2 fw-semibold text-secondary mb-1">Sampai Tanggal</label>
                <input type="date" id="endDate" class="form-control bg-light fs--2">
            </div>

            <!-- Tombol Reset & Print -->
            <div class="col-12 col-md-3 d-flex gap-2 justify-content-md-end">
                <button type="button" id="btnResetFilter" class="btn btn-sm btn-light border text-secondary fs--2 w-100 w-md-auto">
                    <i class="fas fa-undo me-1"></i> Reset
                </button>
                <button type="button" onclick="printTableData()" class="btn btn-sm btn-success fs--2 w-100 w-md-auto">
                    <i class="fas fa-print me-1"></i> Cetak / Print
                </button>
            </div>
        </div>

        <hr class="my-2 text-border opacity-25">

        <div class="d-flex justify-content-between align-items-center">
            <div class="text-muted fs--2">
                <i class="fas fa-info-circle me-1"></i> Menyaring gabungan data <strong>Laporan User & Security</strong>.
            </div>
            <div class="bg-primary bg-opacity-10 px-2 py-1 rounded-2 text-primary border border-primary border-opacity-10 fs--2">
                <span class="me-1 text-white">Total:</span>
                <span class="fw-bold text-white" id="totalDataInfo">0 Laporan</span>
            </div>
        </div>
    </div>
</div>

<!-- Card Data Tabel -->
<div class="card shadow-sm border-0 rounded-3 overflow-hidden" id="printArea">
    <!-- Judul Header Cetak -->
    <div class="d-none d-print-block p-3 text-center border-bottom">
        <h4 class="fw-bold mb-1">Laporan Gabungan User & Security</h4>
        <p class="mb-0 fs--2 text-muted">Dicetak pada: {{ date('d-m-Y H:i') }}</p>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table align-middle table-hover table-custom mb-0 fs--2" id="reportTable">
                <thead class="bg-light text-uppercase text-secondary fw-bold border-bottom fs--2">
                    <tr>
                        <th scope="col" class="ps-3 py-2">Sumber & Tiket</th>
                        <th scope="col" class="py-2">Pelapor / Cabang</th>
                        <th scope="col" class="py-2">Kategori</th>
                        <th scope="col" class="py-2" style="min-width: 180px;">Deskripsi</th>
                        <th scope="col" class="py-2">Tgl Laporan</th>
                        <th scope="col" class="py-2">Tgl Respon</th>
                        <th scope="col" class="py-2">Tgl Selesai</th>
                        <th scope="col" class="py-2">Pelaksana (IT)</th>
                        <th scope="col" class="py-2 text-center">Status</th>
                        <th scope="col" class="py-2 text-center">Verifikasi</th>
                        <th scope="col" class="py-2 text-center pe-3 no-print">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <tr>
                        <td colspan="10" class="text-center py-4 text-muted fs--2">
                            <div class="spinner-border spinner-border-sm text-primary me-2" role="status"></div>
                            Memuat gabungan data laporan...
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Footer & Paginasi -->
    <div class="card-footer bg-light border-0 py-2 d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2 no-print">
        <span class="text-muted fs--2" id="paginationInfo">Menampilkan 0 dari 0 data</span>
        <nav aria-label="Page navigation">
            <ul class="pagination pagination-sm mb-0" id="paginationButtons">
                <!-- Button Paginasi JS -->
            </ul>
        </nav>
    </div>
</div>
@endsection

@section('base.js')
<!-- Modal Detail Laporan -->
<div class="modal fade" id="modalDetail1" tabindex="-1" aria-labelledby="modalDetail1Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-3">
            <div class="modal-header bg-gradient-primary-dark text-white p-3">
                <h5 class="modal-title fw-bold text-white fs-2" id="modalDetail1Label">
                    <i class="fas fa-shield-alt me-2"></i>Detail Laporan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3 fs--2" id="menu-modal-kendala">
                <!-- Content Loaded via Ajax -->
            </div>
            <div class="modal-footer border-0 bg-light p-2">
                <button type="button" class="btn btn-sm btn-secondary px-3 rounded-2 fs--2" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    let currentPage = 1;
    let searchTimeout = null;

    $(document).ready(function() {
        fetchTableData();
    });

    $('#searchInput').on('keyup', function() {
        triggerSearch();
    });
    $('#startDate, #endDate, #sourceFilter').on('change', function() {
        triggerSearch();
    });

    $('#btnResetFilter').on('click', function() {
        $('#searchInput').val('');
        $('#startDate').val('');
        $('#endDate').val('');
        $('#sourceFilter').val('');
        currentPage = 1;
        fetchTableData();
    });

    function triggerSearch() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(function() {
            currentPage = 1;
            fetchTableData();
        }, 300);
    }

    function fetchTableData(page = currentPage) {
        currentPage = page;

        $('#tableBody').html(`
            <tr>
                <td colspan="10" class="text-center py-4 text-muted fs--2">
                    <div class="spinner-border spinner-border-sm text-primary me-2" role="status"></div>
                    Memuat gabungan data laporan...
                </td>
            </tr>
        `);

        $.ajax({
            url: "{{ route('laporan_kendala_get_data') }}",
            type: "GET",
            data: {
                page: currentPage,
                search: $('#searchInput').val(),
                source: $('#sourceFilter').val(),
                start_date: $('#startDate').val(),
                end_date: $('#endDate').val()
            },
            dataType: 'json',
            success: function(response) {
                renderTable(response.data);
                renderPagination(response);
                $('#totalDataInfo').text(response.total + " Laporan");
            },
            error: function() {
                $('#tableBody').html(`
                    <tr>
                        <td colspan="10" class="text-center text-danger py-3 fs--2">
                            <i class="fas fa-exclamation-triangle me-1"></i> Gagal mengambil data gabungan.
                        </td>
                    </tr>
                `);
            }
        });
    }

    function renderTable(dataList) {
        if (!dataList || dataList.length === 0) {
            $('#tableBody').html(`
                <tr>
                    <td colspan="10" class="text-center text-muted py-4 fs--2">
                        <i class="fas fa-inbox fa-2x mb-2 d-block opacity-50"></i>
                        Tidak ada data laporan ditemukan.
                    </td>
                </tr>
            `);
            return;
        }

        let html = '';
        dataList.forEach(function(row) {
            // Mapping Kategori (ER-000 = Security, ER-001 = Hardware, ER-002 = Software)
            let kategoriNama = '-';
            if (row.kategori_laporan === 'ER-000') {
                kategoriNama = 'Security';
            } else if (row.kategori_laporan === 'ER-001') {
                kategoriNama = 'Hardware';
            } else if (row.kategori_laporan === 'ER-002') {
                kategoriNama = 'Software';
            } else {
                kategoriNama = row.kategori_laporan ?? '-'; // Menampilkan kode/nama asli jika ada kategori lain
            }

            // Badge Tipe Sumber (USER vs SECURITY)
            let tipeBadge = row.sumber_laporan === 'SECURITY' ?
                '<span class="badge bg-warning bg-opacity-20 text-dark border border-warning px-1.5 py-0-5 fs--2"><i class="fas fa-shield-alt me-1 text-dark"></i>SECURITY</span>' :
                '<span class="badge bg-primary bg-opacity-10 text-white border border-primary border-opacity-25 px-1.5 py-0-5 fs--2"><i class="fas fa-user me-1"></i>USER</span>';

            // Status Badge
            let statusBadge = '';
            if (row.status_laporan == '0' || row.status_laporan == 'Belum') {
                statusBadge = '<span class="badge bg-danger bg-opacity-10 text-white border border-danger border-opacity-25 px-2 py-1 rounded-pill fs--2"><span class="status-dot bg-danger"></span>Belum Diproses</span>';
            } else if (row.status_laporan == '1' || row.status_laporan == 'Proses') {
                statusBadge = '<span class="badge bg-warning bg-opacity-10 text-white border border-warning border-opacity-25 px-2 py-1 rounded-pill fs--2"><span class="status-dot bg-warning"></span>Sedang Diproses</span>';
            } else {
                statusBadge = '<span class="badge bg-success bg-opacity-10 text-white border border-success border-opacity-25 px-2 py-1 rounded-pill fs--2"><span class="status-dot bg-success"></span>Selesai</span>';
            }
            // Status verifikasi
            let statusverifikasi = '';
            if (row.verifikasi_laporan == '' || row.verifikasi_laporan == null) {
                statusverifikasi = '<span class="badge bg-danger bg-opacity-10 text-white border border-danger border-opacity-25 px-2 py-1 rounded-pill fs--2"><span class="status-dot bg-danger"></span>Belum Verifikasi</span>';
            } else {
                statusverifikasi = '<span class="badge bg-success bg-opacity-10 text-white border border-success border-opacity-25 px-2 py-1 rounded-pill fs--2"><span class="status-dot bg-success"></span>Sudah Veifikasi</span>';
            }

            let pelaksana = row.nama_pelaksana ?
                `<span class="badge bg-white text-dark border shadow-xs px-2 py-1 fs--2"><i class="fas fa-user-gear text-primary me-1"></i>${row.nama_pelaksana}</span>` :
                '<span class="text-muted fs--2 italic">-</span>';

            let deskripsi = row.deskripsi_laporan ?
                (row.deskripsi_laporan.length > 40 ? row.deskripsi_laporan.substring(0, 40) + '...' : row.deskripsi_laporan) : '-';

            html += `
                    <tr class="fs--2">
                        <td class="ps-3 py-2">
                            <div class="mb-1">${tipeBadge}</div>
                            <div><span class="ticket-badge">${row.tiket_laporan ?? '-'}</span></div>
                        </td>
                        <td class="py-2">
                            <div class="fw-semibold text-dark">${row.nama_user ?? '-'}</div>
                            <div class="text-muted fs--2">${row.cabang ?? ''}</div>
                        </td>
                        <td class="py-2"><span class="badge bg-light text-dark border fs--2">${kategoriNama}</span></td>
                        <td class="py-2"><span class="text-secondary">${deskripsi}</span></td>
                        <td class="py-2 text-muted"><i class="far fa-calendar-alt me-1"></i>${row.tgl_laporan ?? '-'}</td>
                        <td class="py-2 text-muted"><i class="far fa-clock me-1"></i>${row.tgl_respon_laporan ?? '-'}</td>
                        <td class="py-2 text-muted"><i class="far fa-check-circle me-1"></i>${row.tgl_selesai_laporan ?? '-'}</td>
                        <td class="py-2">${pelaksana}</td>
                        <td class="py-2 text-center">${statusBadge}</td>
                        <td class="py-2 text-center">${statusverifikasi}</td>
                        <td class="py-2 text-center pe-3 no-print">
                            <button class="btn btn-xs btn-outline-primary rounded-2 shadow-xs button-show-laporan fs--2 px-2 py-1" data-bs-toggle="modal" data-bs-target="#modalDetail1" data-code="${row.tiket_laporan}" data-source="${row.sumber_laporan}">
                                <i class="fas fa-eye me-1"></i> Detail
                            </button>
                        </td>
                    </tr>
                `;
        });

        $('#tableBody').html(html);
    }

    function renderPagination(res) {
        let paginationHtml = '';

        let prevClass = res.current_page === 1 ? 'disabled' : '';
        paginationHtml += `<li class="page-item ${prevClass}"><a class="page-link fs--2" href="#" onclick="fetchTableData(${res.current_page - 1}); return false;"><i class="fas fa-chevron-left"></i></a></li>`;

        for (let i = 1; i <= res.last_page; i++) {
            let activeClass = i === res.current_page ? 'active' : '';
            paginationHtml += `<li class="page-item ${activeClass}"><a class="page-link fs--2" href="#" onclick="fetchTableData(${i}); return false;">${i}</a></li>`;
        }

        let nextClass = res.current_page === res.last_page || res.total === 0 ? 'disabled' : '';
        paginationHtml += `<li class="page-item ${nextClass}"><a class="page-link fs--2" href="#" onclick="fetchTableData(${res.current_page + 1}); return false;"><i class="fas fa-chevron-right"></i></a></li>`;

        $('#paginationButtons').html(paginationHtml);

        let from = res.from ? res.from : 0;
        let to = res.to ? res.to : 0;
        $('#paginationInfo').text(`Menampilkan ${from}-${to} dari ${res.total} data`);
    }

    function printTableData() {
        window.print();
    }

    $(document).on("click", ".button-show-laporan", function(e) {
        e.preventDefault();
        var code = $(this).data("code");
        var source = $(this).data("source");

        $('#menu-modal-kendala').html('<div class="py-4 text-center fs--2"><div class="spinner-border spinner-border-sm text-primary" role="status"></div><p class="text-muted mt-2 mb-0">Memuat detail...</p></div>');

        $.ajax({
            url: "{{ route('laporan_kendala_user_detail') }}",
            type: "GET",
            data: {
                "code": code,
                "source": source
            },
            dataType: 'html',
        }).done(function(data) {
            $('#menu-modal-kendala').html(data);
        }).fail(function() {
            $('#menu-modal-kendala').html('<div class="alert alert-danger text-center m-2 fs--2"><i class="fas fa-exclamation-circle me-1"></i> Gagal memuat data.</div>');
        });
    });
</script>
@endsection
