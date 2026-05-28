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
            <div class="card-header bg-primary py-3">
                <h5 class="card-title mb-0 text-white"><i class="fas fa-plus-circle me-2"></i>Buat Tugas Baru</h5>
            </div>
            <div class="card-body p-4">
                <form id="formTugas">
                    <div class="mb-3">
                        <label for="namaTugas" class="form-label fw-semibold">Nama Tugas</label>
                        <input type="text" class="form-control" id="namaTugas" placeholder="Contoh: Revisi Desain Landing Page" required>
                    </div>

                    <div class="mb-3">
                        <label for="tipeTugas" class="form-label fw-semibold">Tipe Tugas</label>
                        <select class="form-select" id="tipeTugas" required>
                            <option value="" disabled selected>Pilih tipe tugas...</option>
                            <option value="UI/UX Design">UI/UX Design</option>
                            <option value="Frontend Development">Frontend Development</option>
                            <option value="Backend Development">Backend Development</option>
                            <option value="Content Writing">Content Writing</option>
                            <option value="QA Testing">QA Testing</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="targetUser" class="form-label fw-semibold">Tujuan / User Terdaftar</label>
                        <select class="form-select" id="targetUser" required>
                            <option value="" disabled selected>Pilih user terdaftar...</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="tglMulai" class="form-label fw-semibold">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="tglMulai" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="tglSelesai" class="form-label fw-semibold">Tenggat Waktu</label>
                            <input type="date" class="form-control" id="tglSelesai" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="suratTugas" class="form-label fw-semibold">Upload Surat Tugas <span class="text-muted fw-normal small">(Opsional)</span></label>
                        <input class="form-control" type="file" id="suratTugas" accept=".pdf,.doc,.docx,.jpg,.png">
                        <div class="form-text text-muted small">Format yang didukung: PDF, Word, atau Gambar.</div>
                    </div>

                    <div class="mb-4">
                        <label for="deskripsi" class="form-label fw-semibold">Deskripsi Singkat</label>
                        <textarea class="form-control" id="deskripsi" rows="3" placeholder="Tambahkan catatan atau detail tugas..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
                        <i class="fas fa-file-earmark-plus me-1"></i> Tambahkan Tugas
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
                    <span class="input-group-text bg-light border-0"><i class="fas fa-search"></i></span>
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
    // Data Simulasi User Terdaftar
    const daftarUser = [{
            id: 1,
            nama: "Ahmad Dhani",
            divisi: "Marketing"
        },
        {
            id: 2,
            nama: "Siti Rahma",
            divisi: "Client / Owner"
        },
        {
            id: 3,
            nama: "Budi Utomo",
            divisi: "Frontend Team"
        },
        {
            id: 4,
            nama: "Diana Lestari",
            divisi: "UI/UX Team"
        },
        {
            id: 5,
            nama: "Kevin Sanjaya",
            divisi: "QA Tester"
        }
    ];

    let dataTugas = [];

    const formTugas = document.getElementById('formTugas');
    const listTugas = document.getElementById('listTugas');
    const emptyState = document.getElementById('emptyState');
    const totalTugasBadge = document.getElementById('totalTugas');
    const selectTargetUser = document.getElementById('targetUser');
    const searchInput = document.getElementById('searchTugas');

    // Isi dropdown target user
    function renderUserDropdown() {
        daftarUser.forEach(user => {
            const option = document.createElement('option');
            option.value = user.nama;
            option.textContent = `${user.nama} (${user.divisi})`;
            selectTargetUser.appendChild(option);
        });
    }
    renderUserDropdown();

    // FUNGSI UTAMA: Merender list tugas
    function renderListTugas(kataKunci = '') {
        let tugasDifilter = dataTugas.filter(tugas => {
            const matchNama = tugas.nama.toLowerCase().includes(kataKunci.toLowerCase());
            const matchTipe = tugas.tipe.toLowerCase().includes(kataKunci.toLowerCase());
            const matchUser = tugas.targetUser.toLowerCase().includes(kataKunci.toLowerCase());
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
            const fmtMulai = new Date(tugas.tglMulai).toLocaleDateString('id-ID', opsiTgl);
            const fmtSelesai = new Date(tugas.tglSelesai).toLocaleDateString('id-ID', opsiTgl);

            let selectClass = "border-danger text-danger";
            if (tugas.status === "Dalam Pengerjaan") selectClass = "border-warning text-warning-emphasis";
            if (tugas.status === "Dalam Peninjauan") selectClass = "border-info text-info-emphasis";
            if (tugas.status === "Selesai") selectClass = "border-success text-success bg-success-subtle";

            // Logika komponen attachment surat tugas jika ada
            let komponenSurat = '';
            if (tugas.namaSurat && tugas.urlSurat) {
                komponenSurat = `
                        <div class="mt-2 pt-2 border-top border-light">
                            <a href="${tugas.urlSurat}" target="_blank" class="btn btn-sm btn-outline-secondary py-1 text-truncate max-w-100">
                                <i class="bi bi-file-earmark-text-fill text-danger me-1"></i> Lihat Surat: ${tugas.namaSurat}
                            </a>
                        </div>
                    `;
            }

            const tugasCard = document.createElement('div');
            tugasCard.className = `card border shadow-sm ${tugas.status === 'Selesai' ? 'opacity-75 bg-light' : ''}`;
            tugasCard.innerHTML = `
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <div class="d-flex gap-2 mb-2 align-items-center flex-wrap">
                                    <span class="badge bg-info text-dark">${tugas.tipe}</span>
                                    <span class="badge bg-secondary-subtle text-secondary-emphasis">
                                        <i class="bi bi-person-check-fill me-1"></i> Kepada: ${tugas.targetUser}
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
                        <p class="card-text small text-secondary mt-3 bg-white p-2 rounded border mb-2">${tugas.deskripsi}</p>
                        ${komponenSurat}
                    </div>
                `;
            listTugas.appendChild(tugasCard);
        });
    }

    // LOGIKA: Form Submit
    formTugas.addEventListener('submit', function(e) {
        e.preventDefault();

        const fileInput = document.getElementById('suratTugas');
        let namaSurat = null;
        let urlSurat = null;

        // Jika user memilih file, ekstrak informasi filenya
        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];
            namaSurat = file.name;
            urlSurat = URL.createObjectURL(file); // Membuat link lokal sementara agar file bisa diklik/diakses
        }

        const tugasBaru = {
            id: Date.now(),
            nama: document.getElementById('namaTugas').value,
            tipe: document.getElementById('tipeTugas').value,
            targetUser: selectTargetUser.value,
            tglMulai: document.getElementById('tglMulai').value,
            tglSelesai: document.getElementById('tglSelesai').value,
            deskripsi: document.getElementById('deskripsi').value || 'Tidak ada deskripsi.',
            status: 'Belum Dimulai',
            namaSurat: namaSurat,
            urlSurat: urlSurat
        };

        dataTugas.push(tugasBaru);

        searchInput.value = '';
        renderListTugas();

        formTugas.reset();
    });

    // FUNGSI: Mengubah status tugas
    function ubahStatusTugas(id, statusBaru) {
        const index = dataTugas.findIndex(tugas => tugas.id === id);
        if (index !== -1) {
            dataTugas[index].status = statusBaru;
        }
        renderListTugas(searchInput.value);
    }

    // EVENT LISTENER: Pencarian
    searchInput.addEventListener('input', function() {
        renderListTugas(this.value);
    });
</script>
@endsection
