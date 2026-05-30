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
                <h5 class="card-title mb-0"><i class="bi bi-plus-circle me-2"></i>Buat Tugas Baru</h5>
            </div>
            <div class="card-body p-4">
                <form id="formTugas" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="namaTugas" class="form-label fw-semibold">Nama Tugas</label>
                        <input type="text" class="form-control" id="namaTugas" name="nama" placeholder="Contoh: Revisi Desain Landing Page" required>
                    </div>

                    <div class="mb-3">
                        <label for="tipeTugas" class="form-label fw-semibold">Tipe Tugas</label>
                        <select class="form-select" id="tipeTugas" name="tipe" required>
                            <option value="" disabled selected>Pilih tipe tugas...</option>
                            <option value="Update Bisone">Update Bisone</option>
                            <option value="Program Development">Program Development</option>
                            <option value="Content Writing">Content Writing</option>
                            <option value="QA Testing">QA Testing</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tujuan / User Terdaftar (Bisa > 1)</label>
                        <div id="userChecklistContainer" class="border rounded p-3 bg-white" style="max-height: 170px; overflow-y: auto;">
                            <span class="text-muted small">Memuat data petugas...</span>
                        </div>
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
                        <label for="suratTugas" class="form-label fw-semibold">Upload File Tugas <span class="text-muted fw-normal small">(Opsional)</span></label>
                        <input class="form-control" type="file" id="suratTugas" name="surat_tugas" accept=".pdf,.doc,.docx,.jpg,.png">
                    </div>

                    <div class="mb-4">
                        <label for="deskripsi" class="form-label fw-semibold">Deskripsi Singkat</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Tambahkan catatan detail tugas..."></textarea>
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
                    <span class="input-group-text bg-light border-0 text-muted"><i class="fas fa-search text-primary"></i></span>
                    <input type="text" id="searchTugas" class="form-control border-0" placeholder="Cari tugas, nama user, atau tanggal (YYYY-MM-DD)...">
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
    const API_URL = '/menu/app/menu/create-task';
</script>
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    let dataTugas = [];

    const formTugas = document.getElementById('formTugas');
    const listTugas = document.getElementById('listTugas');
    const emptyState = document.getElementById('emptyState');
    const totalTugasBadge = document.getElementById('totalTugas');
    const userChecklistContainer = document.getElementById('userChecklistContainer');
    const searchInput = document.getElementById('searchTugas');

    // 1. Ambil Data Petugas Database ke Checkbox HTML
    async function fetchUserChecklist() {
        try {
            const response = await fetch(`${API_URL}/users`);
            const daftarUser = await response.json();

            userChecklistContainer.innerHTML = '';
            if (daftarUser.length === 0) {
                userChecklistContainer.innerHTML = '<span class="text-muted small">Tidak ada petugas di database.</span>';
                return;
            }

            daftarUser.forEach(user => {
                const div = document.createElement('div');
                div.className = 'form-check mb-1';
                div.innerHTML = `
                        <input class="form-check-input user-checkbox" type="checkbox" name="target_user[]" value="${user.id_user}" id="user_${user.id_user}">
                        <label class="form-check-label small" for="user_${user.id_user}">
                            ${user.nama_lengkap} <span class="text-muted">(${user.nip})</span>
                        </label>
                    `;
                userChecklistContainer.appendChild(div);
            });
        } catch (error) {
            console.error('Gagal mengambil data user:', error);
            userChecklistContainer.innerHTML = '<span class="text-danger small">Gagal memuat petugas.</span>';
        }
    }

    // 2. Ambil Data List Tugas dari Database
    async function fetchTugas() {
        try {
            const response = await fetch(`${API_URL}/tugas`);
            dataTugas = await response.json();
            renderListTugas(searchInput.value);
        } catch (error) {
            console.error('Gagal memuat list tugas:', error);
        }
    }

    // 3. Render Komponen Tugas ke Layar (Fitur Filter Tanggal & Limit Maksimal 10)
    function renderListTugas(kataKunci = '') {
        const query = kataKunci.toLowerCase().trim();

        // Filter data dengan aman (anti-crash jika ada data null/undefined)
        let tugasDifilter = dataTugas.filter(tugas => {
            // Gunakan || '' agar jika data di database NULL, JavaScript membacanya sebagai teks kosong
            const namaTugas = (tugas.nama || '').toLowerCase();
            const tipeTugas = (tugas.tipe || '').toLowerCase();
            const targetUser = (tugas.target_user || '').toLowerCase();
            const tglMulai = (tugas.tgl_mulai || '');
            const tglSelesai = (tugas.tgl_selesai || '');

            const matchNama = namaTugas.includes(query);
            const matchTipe = tipeTugas.includes(query);
            const matchUser = targetUser.includes(query);
            const matchTglMulai = tglMulai.includes(query);
            const matchTglSelesai = tglSelesai.includes(query);

            return matchNama || matchTipe || matchUser || matchTglMulai || matchTglSelesai;
        });

        // Urutkan status 'Selesai' ke paling bawah, tugas terbaru di atas
        tugasDifilter.sort((a, b) => {
            if (a.status === 'Selesai' && b.status !== 'Selesai') return 1;
            if (a.status !== 'Selesai' && b.status === 'Selesai') return -1;
            return b.id - a.id;
        });

        // Batasi hasil pencarian/pementasan maksimal hanya 10 item saja
        let tugasDitampilkan = tugasDifilter.slice(0, 10);

        // Bersihkan kontainer list kecuali state kosong
        listTugas.innerHTML = '';
        listTugas.appendChild(emptyState);

        if (tugasDitampilkan.length === 0) {
            emptyState.style.display = 'block';
            totalTugasBadge.textContent = `0 Tugas`;
            return;
        }

        emptyState.style.display = 'none';
        totalTugasBadge.textContent = `${tugasDitampilkan.length} dari ${tugasDifilter.length} Tugas`;

        tugasDitampilkan.forEach(tugas => {
            const opsiTgl = {
                day: 'numeric',
                month: 'short',
                year: 'numeric'
            };
            // Pastikan tanggal valid sebelum di-parse
            const fmtMulai = tugas.tgl_mulai ? new Date(tugas.tgl_mulai).toLocaleDateString('id-ID', opsiTgl) : '-';
            const fmtSelesai = tugas.tgl_selesai ? new Date(tugas.tgl_selesai).toLocaleDateString('id-ID', opsiTgl) : '-';

            let selectClass = "border-danger text-danger";
            if (tugas.status === "Dalam Pengerjaan") selectClass = "border-warning text-warning-emphasis";
            if (tugas.status === "Dalam Peninjauan") selectClass = "border-info text-info-emphasis";
            if (tugas.status === "Selesai") selectClass = "border-success text-success bg-success-subtle";

            let komponenSurat = '';
            if (tugas.nama_surat && tugas.url_surat) {
                komponenSurat = `
                        <div class="mt-2 pt-2 border-top border-light">
                            <a href="${tugas.url_surat}" target="_blank" class="btn btn-sm btn-outline-secondary py-1 text-truncate max-w-100">
                                <i class="bi bi-file-earmark-text-fill text-danger me-1"></i> Lihat File: ${tugas.nama_surat}
                            </a>
                        </div>
                    `;
            }

            const tugasCard = document.createElement('div');
            tugasCard.className = `card border border-primary mb-3 shadow-sm ${tugas.status === 'Selesai' ? 'opacity-75 bg-light' : ''}`;
            tugasCard.innerHTML = `
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <div class="d-flex gap-2 mb-2 align-items-center flex-wrap">
                                    <span class="badge bg-info text-dark">${tugas.tipe || 'No Type'}</span>
                                    <span class="badge bg-secondary-subtle text-secondary-emphasis">
                                        <i class="bi bi-person-fill me-1"></i> Petugas: ${tugas.target_user || 'Tanpa Nama'}
                                    </span>
                                </div>
                                <h6 class="card-title mb-1 fw-bold ${tugas.status === 'Selesai' ? 'text-decoration-line-through text-muted' : 'text-dark'}">${tugas.nama || 'Tanpa Judul'}</h6>
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

    // 4. Kirim Form Submit Tugas Baru
    formTugas.addEventListener('submit', async function(e) {
        e.preventDefault();

        const checkedBoxes = document.querySelectorAll('.user-checkbox:checked');
        if (checkedBoxes.length === 0) {
            alert('Pilih setidaknya satu petugas!');
            return;
        }

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
                fetchTugas();
            } else {
                alert('Gagal menambahkan tugas ke server.');
            }
        } catch (error) {
            console.error('Error post data:', error);
        }
    });

    // 5. Ubah Status Tugas via Dropdown Select
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
                fetchTugas();
            }
        } catch (error) {
            console.error('Error update status:', error);
        }
    }

    searchInput.addEventListener('input', function() {
        renderListTugas(this.value);
    });

    // Jalankan saat load halaman pertama kali
    document.addEventListener("DOMContentLoaded", () => {
        fetchUserChecklist();
        fetchTugas();
    });
</script>
@endsection
