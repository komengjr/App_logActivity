@extends('layouts.template')
@section('content')
<div class="card mb-3">
    <div class="card-body border-top">
        <div class="d-flex">
            <div class="flex-1">
                <h5 class="fw-bold text-dark"><i class="bi bi-calendar-week text-primary"></i>Pengaturan Pembuatan Tugas User</h5>
                <p class="text-muted mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae veritatis ut repellat error fuga fugit ea facere, id quia dolorum delectus illo optio? Dignissimos velit, libero et aliquam veritatis cum..</p>
            </div>
        </div>
    </div>
</div>
<div class="row g-3">

    <div class="col-md-5">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="card-title mb-0 text-white"><i class="fas fa-plus-circle me-2"></i>Buat Tugas Baru</h5>
            </div>
            <div class="card-body p-4">
                <form id="formTugas" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="namaTugas" class="form-label fw-semibold">Nama Tugas</label>
                        <input type="text" class="form-control" id="namaTugas" name="nama" placeholder="Contoh: Revisi Desain Landing Page" required>
                    </div>

                    <div class="mb-3">
                        <label for="tipeTugas" class="form-label fw-semibold">Tipe Tugas</label>
                        <select class="form-select" id="tipeTugas" name="tipe" required>
                            <option value="" disabled selected>Pilih tipe tugas...</option>
                            <option value="Update Bisone">Update Bisone</option>
                            <option value="Perjalanan Dinas">Perjalanan Dinas</option>
                            <option value="Program Development">Program Development</option>
                            <option value="Content Writing">Content Writing</option>
                            <option value="QA Testing">QA Testing</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="targetUser" class="form-label fw-semibold">Tujuan / User Terdaftar</label>
                        <select class="form-select" id="targetUser" name="target_user" required>
                            <option value="" disabled selected>Memuat data petugas...</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="tglMulai" class="form-label fw-semibold">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="tglMulai" name="tgl_mulai" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="tglSelesai" class="form-label fw-semibold">Tenggat Waktu</label>
                            <input type="date" class="form-control" id="tglSelesai" name="tgl_selesai" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="suratTugas" class="form-label fw-semibold">Upload Surat Tugas <span class="text-muted fw-normal small">(Opsional)</span></label>
                        <input class="form-control" type="file" id="suratTugas" name="surat_tugas" accept=".pdf,.doc,.docx,.jpg,.png">
                        <div class="form-text text-muted small">Format yang didukung: PDF, Word, atau Gambar.</div>
                    </div>

                    <div class="mb-4">
                        <label for="deskripsi" class="form-label fw-semibold">Deskripsi Singkat</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Tambahkan catatan atau detail tugas..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
                        <i class="bi bi-file-earmark-plus me-1"></i> Tambahkan Tugas
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-7">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-dark text-white py-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0 text-white"><i class="fas fa-list-task me-2"></i>Daftar Proses Tugas</h5>
                    <span class="badge bg-secondary" id="totalTugas">0 Tugas</span>
                </div>
                <div class="input-group">
                    <span class="input-group-text bg-light border-0 text-muted"><i class="fa fa-search text-danger"></i></span>
                    <input type="text" id="searchTugas" class="form-control border-0" placeholder="Cari nama tugas, tipe, atau nama user...">
                </div>
            </div>
            <div class="card-body p-4">

                <div id="listTugas" class="vstack gap-3">
                    <div id="emptyState" class="text-center py-5 text-muted">
                        <i class="bi bi-clipboard-x display-4"></i>
                        <p class="mt-2 mb-0">Belum ada tugas yang dibuat atau tidak ditemukan.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection

@section('base.js')
<script>
    // Konfigurasi Base URL API Laravel (Sesuaikan jika Anda menggunakan prefix /api/)
    const API_URL = '/menu/app/menu/create-task';

    // Setup CSRF Token untuk Fetch API (Keperluan Laravel)
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    let dataTugas = [];

    const formTugas = document.getElementById('formTugas');
    const listTugas = document.getElementById('listTugas');
    const emptyState = document.getElementById('emptyState');
    const totalTugasBadge = document.getElementById('totalTugas');
    const selectTargetUser = document.getElementById('targetUser');
    const searchInput = document.getElementById('searchTugas');

    // 1. AMBIL DATA USER DARI DATABASE LARAVEL
    async function fetchUserDropdown() {
        try {
            const response = await fetch(`${API_URL}/users`);
            const daftarUser = await response.json();

            selectTargetUser.innerHTML = '<option value="" disabled selected>Pilih user terdaftar...</option>';
            daftarUser.forEach(user => {
                const option = document.createElement('option');
                option.value = user.id_user; // atau user.id tergantung kebutuhan backend
                option.textContent = `${user.nama_lengkap} (${user.nip})`;
                selectTargetUser.appendChild(option);
            });
        } catch (error) {
            console.error('Gagal memuat data user:', error);
            selectTargetUser.innerHTML = '<option value="" disabled>Gagal memuat data</option>';
        }
    }

    // 2. AMBIL DATA TUGAS DARI DATABASE LARAVEL
    async function fetchTugas() {
        try {
            const response = await fetch(`${API_URL}/tugas`);
            dataTugas = await response.json();
            renderListTugas(searchInput.value);
        } catch (error) {
            console.error('Gagal memuat data tugas:', error);
        }
    }

    // 3. RENDER DATA KE LIST TUGAS HTML
    function renderListTugas(kataKunci = '') {
        let tugasDifilter = dataTugas.filter(tugas => {
            const matchNama = tugas.nama.toLowerCase().includes(kataKunci.toLowerCase());
            const matchTipe = tugas.tipe.toLowerCase().includes(kataKunci.toLowerCase());
            const matchUser = tugas.target_user.toLowerCase().includes(kataKunci.toLowerCase());
            return matchNama || matchTipe || matchUser;
        });

        // Urutkan: Selesai di paling bawah
        tugasDifilter.sort((a, b) => {
            if (a.status === 'Selesai' && b.status !== 'Selesai') return 1;
            if (a.status !== 'Selesai' && b.status === 'Selesai') return -1;
            return b.id - a.id;
        });

        listTugas.innerHTML = '';
        listTugas.appendChild(emptyState);

        if (tugasDifilter.length === 0) {
            emptyState.style.display = 'block';
            totalTugasBadge.textContent = `0 Tugas`;
            return;
        }

        emptyState.style.display = 'none';
        totalTugasBadge.textContent = `${tugasDifilter.length} Tugas`;

        tugasDifilter.forEach(tugas => {
            const opsiTgl = {
                day: 'numeric',
                month: 'short',
                year: 'numeric'
            };
            const fmtMulai = new Date(tugas.tgl_mulai).toLocaleDateString('id-ID', opsiTgl);
            const fmtSelesai = new Date(tugas.tgl_selesai).toLocaleDateString('id-ID', opsiTgl);

            let selectClass = "border-danger text-danger";
            if (tugas.status === "Dalam Pengerjaan") selectClass = "border-warning text-warning-emphasis";
            if (tugas.status === "Dalam Peninjauan") selectClass = "border-info text-info-emphasis";
            if (tugas.status === "Selesai") selectClass = "border-success text-success bg-success-subtle";

            let komponenSurat = '';
            if (tugas.nama_surat && tugas.url_surat) {
                komponenSurat = `
                        <div class="mt-2 pt-2 border-top border-light">
                            <a href="${tugas.url_surat}" target="_blank" class="btn btn-sm btn-outline-secondary py-1 text-truncate max-w-100">
                                <i class="bi bi-file-earmark-text-fill text-danger me-1"></i> Lihat Surat: ${tugas.nama_surat}
                            </a>
                        </div>
                    `;
            }

            const tugasCard = document.createElement('div');
            tugasCard.className = `mb-3 card border border-primary shadow-sm ${tugas.status === 'Selesai' ? 'opacity-75 bg-light' : ''}`;
            tugasCard.innerHTML = `
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <div class="d-flex gap-2 mb-2 align-items-center flex-wrap">
                                    <span class="badge bg-info text-dark">${tugas.tipe}</span>
                                    <span class="badge bg-secondary-subtle text-secondary-emphasis">
                                        <i class="bi bi-person-check-fill me-1"></i> Kepada: ${tugas.nama_lengkap}
                                    </span>
                                </div>
                                <h6 class="card-title mb-1 fw-bold ${tugas.status === 'Selesai' ? 'text-decoration-line-through text-muted' : 'text-dark'}">${tugas.nama}</h6>
                                <small class="text-muted d-block">
                                    <i class="bi bi-calendar-range me-1"></i> ${fmtMulai} s/d ${fmtSelesai}
                                </small>
                            </div>
                            <div>
                                <select class="form-select form-select-sm fw-semibold ${selectClass}" onchange="ubahStatusTugas(${tugas.id}, this.value)">
                                    <option value="Belum Dimulai" ${tugas.status === 'Belum Dimulai' ? 'selected' : ''}>🔴 Belum Dimulai</option>
                                    <option value="Dalam Pengerjaan" ${tugas.status === 'Dalam Pengerjaan' ? 'selected' : ''}>🟡 Dalam Pengerjaan</option>
                                    <option value="Dalam Peninjauan" ${tugas.status === 'Dalam Peninjauan' ? 'selected' : ''}>🔵 Dalam Peninjauan</option>
                                    <option value="Selesai" ${tugas.status === 'Selesai' ? 'selected' : ''}>🟢 Selesai</option>
                                </select>
                            </div>
                        </div>
                        <p class="card-text small text-secondary mt-3 bg-white p-2 rounded border mb-2">${tugas.deskripsi || 'Tidak ada deskripsi.'}</p>
                        ${komponenSurat}
                    </div>
                `;
            listTugas.appendChild(tugasCard);
        });
    }

    // 4. SIMPAN TUGAS BARU KE BACKEND LARAVEL
    formTugas.addEventListener('submit', async function(e) {
        e.preventDefault();

        // Menggunakan FormData karena ada proses upload file (surat tugas)
        const formData = new FormData(this);

        try {
            const response = await fetch(`${API_URL}/save`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                body: formData
            });

            if (response.ok) {
                formTugas.reset();
                searchInput.value = '';
                fetchTugas(); // Ambil ulang data terbaru dari server
            } else {
                alert('Gagal menambahkan tugas. Cek validasi server.');
            }
        } catch (error) {
            console.error('Error saat menyimpan tugas:', error);
        }
    });

    // 5. UPDATE STATUS TUGAS KE DATABASE LARAVEL
    async function ubahStatusTugas(id, statusBaru) {
        try {
            const response = await fetch(`${API_URL}/tugas/${id}/status`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    status: statusBaru
                })
            });

            if (response.ok) {
                fetchTugas(); // Refresh data setelah sukses update status
            } else {
                alert('Gagal mengubah status tugas.');
            }
        } catch (error) {
            console.error('Error saat update status:', error);
        }
    }

    // Event Listener untuk fitur Pencarian lokal
    searchInput.addEventListener('input', function() {
        renderListTugas(this.value);
    });

    // Inisialisasi awal saat halaman dibuka
    document.addEventListener("DOMContentLoaded", () => {
        fetchUserDropdown();
        fetchTugas();
    });
</script>
@endsection
