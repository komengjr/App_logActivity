@extends('layouts.template')
@section('content')
<div class="card shadow-sm border-0 mb-3">
    <div class="card-body">
        <h3 class="card-title mb-1 fw-bold">Daftar Laporan Tugas</h3>
        <p class="text-muted mb-0">Manajemen dan pemantauan status laporan terkini</p>
    </div>
</div>

<div class="card shadow-sm border-0 mb-3">
    <div class="card-body">
        <div class="row justify-content-between align-items-center g-3">
            <div class="col-12 col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" id="searchInput" class="form-control border-start-0" placeholder="Cari laporan, pembuat, status, atau pelaksana...">
                </div>
            </div>
            <div class="col-12 col-md-auto text-muted small">
                Total Data: <span class="fw-bold text-dark" id="totalDataInfo">20 Laporan</span>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 fs--2" id="reportTable">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">Kategori Laporan</th>
                        <th scope="col">Pembuat Laporan</th>
                        <th scope="col">Deskripsi Laporan</th>
                        <th scope="col">Tanggal Laporan</th>
                        <th scope="col">Tanggal Diterima</th>
                        <th scope="col">Tanggal Selesai</th>
                        <th scope=" col">Pelaksana Tugas</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $datas)
                    <tr>
                        <td class="ps-4 fw-bold text-dark">
                            @if ($datas->kategori_laporan == 'ER-001')
                            Hardware
                            @elseif($datas->kategori_laporan == 'ER-002')
                            Software
                            @else
                            Lain Lain
                            @endif
                        </td>
                        <td>{{ $datas->nama_user }}</td>
                        <td>{{ $datas->deskripsi_laporan }}</td>
                        <td>{{ $datas->tgl_laporan }}</td>
                        <td>{{ $datas->tgl_respon_laporan }}</td>
                        <td>{{ $datas->tgl_selesai_laporan }}</td>
                        <td><span class="badge bg-light text-dark border">IT - Dani</span></td>
                        <td class="text-center">
                            @if ($datas->status_laporan == '0')
                            <span class="badge bg-danger text-white px-3 py-2 rounded-pill">Belum</span>
                            @elseif ($datas->status_laporan == '1')
                            <span class="badge bg-warning text-white px-3 py-2 rounded-pill">Proses</span>
                            @elseif ($datas->status_laporan == '2')
                            <span class="badge bg-success text-white px-3 py-2 rounded-pill">Selesai</span>
                            @endif
                        </td>
                        <td class="text-center pe-4"><button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalDetail1"><i class="fas fa-eye-fill me-1"></i> Detail</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white border-0 py-3 d-flex justify-content-between align-items-center">
        <span class="text-muted small" id="paginationInfo">Menampilkan 1-10 dari 20 data</span>
        <nav aria-label="Page navigation">
            <ul class="pagination pagination-sm mb-0" id="paginationButtons">
                <li class="page-item" id="prevPageBtn"><a class="page-link" href="#" onclick="changePage(-1); return false;">Sebelumnya</a></li>
                <li class="page-item" id="nextPageBtn"><a class="page-link" href="#" onclick="changePage(1); return false;">Selanjutnya</a></li>
            </ul>
        </nav>
    </div>
</div>
@endsection

@section('base.js')
<div class="modal fade" id="modalDetail1" tabindex="-1" aria-labelledby="modalDetail1Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold text-dark" id="modalDetail1Label"><i class="bi bi-file-earmark-text text-primary me-2"></i>Detail Laporan Tugas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-3 d-flex justify-content-between align-items-center border-bottom pb-2">
                    <span class="text-muted small">Status Laporan</span>
                    <span class="badge bg-success-subtle text-success px-3 py-1 rounded-pill">Selesai</span>
                </div>
                <div class="mb-3">
                    <label class="text-muted small d-block">Nama Laporan</label>
                    <span class="fw-bold text-dark fs-5">Kerusakan Server Utama</span>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-6">
                        <label class="text-muted small d-block">Pembuat Laporan</label>
                        <span class="fw-semibold">Rian Andriana</span>
                    </div>
                    <div class="col-6">
                        <label class="text-muted small d-block">Pelaksana Tugas</label>
                        <span class="fw-semibold">IT - Dani</span>
                    </div>
                </div>
                <hr class="text-muted opacity-25">
                <div class="row g-3 mb-3">
                    <div class="col-4">
                        <label class="text-muted small d-block">Tgl Laporan</label>
                        <span class="small fw-semibold">10 Mei 2026</span>
                    </div>
                    <div class="col-4">
                        <label class="text-muted small d-block">Tgl Diterima</label>
                        <span class="small fw-semibold">10 Mei 2026</span>
                    </div>
                    <div class="col-4">
                        <label class="text-muted small d-block">Tgl Selesai</label>
                        <span class="small fw-semibold text-success">11 Mei 2026</span>
                    </div>
                </div>
                <div class="mb-0 bg-light p-3 rounded border">
                    <label class="text-muted small d-block fw-bold mb-1">Solusi & Tindakan:</label>
                    <p class="mb-0 text-secondary small-85">Melakukan penanganan kritis berupa migrasi database utama ke server cadangan sementara, mengisolasi hardware yang mengalami korsleting, dan mengganti komponen power supply cadangan yang rusak.</p>
                </div>
            </div>
            <div class="modal-footer border-0 bg-light-subtle">
                <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDetail2" tabindex="-1" aria-labelledby="modalDetail2Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold text-dark" id="modalDetail2Label"><i class="bi bi-file-earmark-text text-primary me-2"></i>Detail Laporan Tugas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-3 d-flex justify-content-between align-items-center border-bottom pb-2">
                    <span class="text-muted small">Status Laporan</span>
                    <span class="badge bg-warning-subtle text-warning px-3 py-1 rounded-pill">Proses</span>
                </div>
                <div class="mb-3">
                    <label class="text-muted small d-block">Nama Laporan</label>
                    <span class="fw-bold text-dark fs-5">Bug Aplikasi Kasir</span>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-6">
                        <label class="text-muted small d-block">Pembuat Laporan</label>
                        <span class="fw-semibold">Siti Aminah</span>
                    </div>
                    <div class="col-6">
                        <label class="text-muted small d-block">Pelaksana Tugas</label>
                        <span class="fw-semibold">Dev - Dimas</span>
                    </div>
                </div>
                <hr class="text-muted opacity-25">
                <div class="row g-3 mb-3">
                    <div class="col-4">
                        <label class="text-muted small d-block">Tgl Laporan</label>
                        <span class="small fw-semibold">12 Mei 2026</span>
                    </div>
                    <div class="col-4">
                        <label class="text-muted small d-block">Tgl Diterima</label>
                        <span class="small fw-semibold">13 Mei 2026</span>
                    </div>
                    <div class="col-4">
                        <label class="text-muted small d-block">Tgl Selesai</label>
                        <span class="small text-muted italic">-</span>
                    </div>
                </div>
                <div class="mb-0 bg-light p-3 rounded border">
                    <label class="text-muted small d-block fw-bold mb-1">Solusi & Tindakan:</label>
                    <p class="mb-0 text-muted small-85 italic">Laporan saat ini sedang dianalisis pada environment staging guna mereproduksi bug keranjang belanja kosong sebelum di-deploy perbaikannya ke production server.</p>
                </div>
            </div>
            <div class="modal-footer border-0 bg-light-subtle">
                <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<script>
    const rowsPerPage = 10;
    let currentPage = 1;
    let filteredRows = [];

    const tableRows = Array.from(document.querySelectorAll('#reportTable tbody tr'));
    const searchInput = document.getElementById('searchInput');

    function filterAndPaginate() {
        const query = searchInput.value.toLowerCase();

        // 1. Proses mem-filter data berdasarkan keyword pencarian
        filteredRows = tableRows.filter(row => {
            return row.innerText.toLowerCase().includes(query);
        });

        // Update indikator jumlah total data di atas
        document.getElementById('totalDataInfo').innerText = filteredRows.length + " Laporan";

        // Hitung total halaman yang dibutuhkan
        const totalPages = Math.ceil(filteredRows.length / rowsPerPage) || 1;
        if (currentPage > totalPages) currentPage = totalPages;

        // 2. Sembunyikan semua baris terlebih dahulu
        tableRows.forEach(row => row.style.display = 'none');

        // 3. Tampilkan hanya 10 baris data sesuai halaman yang aktif
        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        const activeRows = filteredRows.slice(start, end);

        activeRows.forEach(row => row.style.display = '');

        // 4. Perbarui Teks Info Paginasi (di pojok kiri bawah)
        const displayStart = filteredRows.length === 0 ? 0 : start + 1;
        const displayEnd = end > filteredRows.length ? filteredRows.length : end;
        document.getElementById('paginationInfo').innerText = `Menampilkan ${displayStart}-${displayEnd} dari ${filteredRows.length} data`;

        // 5. Atur Status tombol Tombol Sebelumnya / Selanjutnya
        document.getElementById('prevPageBtn').classList.toggle('disabled', currentPage === 1);
        document.getElementById('nextPageBtn').classList.toggle('disabled', currentPage === totalPages || filteredRows.length === 0);

        // Bersihkan & gambar ulang nomor halaman dinamis (1, 2, dst)
        renderPageNumbers(totalPages);
    }

    function changePage(direction) {
        currentPage += direction;
        filterAndPaginate();
    }

    function goToPage(pageNumber) {
        currentPage = pageNumber;
        filterAndPaginate();
    }

    function renderPageNumbers(totalPages) {
        // Cari element tombol angka dinamis lama, lalu hapus
        const paginationList = document.getElementById('paginationButtons');
        const numItems = paginationList.querySelectorAll('.page-num-item');
        numItems.forEach(item => item.remove());

        const nextBtn = document.getElementById('nextPageBtn');

        // Buat elemen tombol halaman baru secara berurutan
        for (let i = 1; i <= totalPages; i++) {
            const li = document.createElement('li');
            li.className = `page-item page-num-item ${i === currentPage ? 'active' : ''}`;
            li.innerHTML = `<a class="page-link" href="#" onclick="goToPage(${i}); return false;">${i}</a>`;
            paginationList.insertBefore(li, nextBtn);
        }
    }

    // Event Listener untuk memicu filter saat user mengetik di search bar
    searchInput.addEventListener('keyup', () => {
        currentPage = 1; // Reset ke halaman 1 setiap kali mengetik pencarian baru
        filterAndPaginate();
    });

    // Inisialisasi awal saat halaman pertama kali dibuka
    filterAndPaginate();
</script>
@endsection
