@extends('layouts.template')
@section('base.css')
<style>
    .custom-card {
        background: #ffffff;
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(165, 173, 199, 0.12);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .employee-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(165, 173, 199, 0.2);
    }

    .avatar-container {
        position: relative;
        width: 100px;
        height: 100px;
        margin: 0 auto;
    }

    .avatar-img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #fff;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.08);
    }

    .search-box {
        border: 1.5px solid #E2E8F0;
        border-radius: 12px;
        overflow: hidden;
        background: #fff;
        transition: all 0.2s ease;
    }

    .search-box:focus-within {
        border-color: #4F46E5;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
    }

    .btn-indigo {
        background-color: #4F46E5;
        color: white;
        font-weight: 600;
        border-radius: 10px;
        border: none;
    }

    .btn-indigo:hover {
        background-color: #4338CA;
        color: white;
    }

    .btn-outline-indigo {
        border: 1.5px solid #4F46E5;
        color: #4F46E5;
        font-weight: 600;
        border-radius: 10px;
        background: transparent;
    }

    .btn-outline-indigo:hover {
        background-color: #4F46E5;
        color: white;
    }

    /* Modal Styling */
    .modal-content {
        border-radius: 16px;
        border: none;
    }

    .modal-avatar-container {
        position: relative;
        width: 120px;
        height: 120px;
        margin: 0 auto 15px auto;
    }

    .modal-avatar {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #F1F5F9;
    }

    .btn-edit-photo {
        position: absolute;
        bottom: 2px;
        right: 2px;
        background: #4F46E5;
        color: white;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border: 2px solid #fff;
    }
</style>
@endsection
@section('content')
<!-- HEADER -->
<div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-3 gap-3">
    <div>
        <h3 class="fw-bold mb-1 text-dark">Daftar Direktori Karyawan</h3>
        <p class="text-muted small mb-0">Cari karyawan dan perbarui data langsung via Pop-up Modal.</p>
    </div>
</div>

<!-- PENCARIAN REAL-TIME -->
<div class="card custom-card mb-3">
    <div class="card-body p-3">
        <div class="d-flex align-items-center search-box px-3 py-1">
            <i class="bi bi-search text-muted me-2"></i>
            <input type="text" id="inputPencarian" class="form-control border-0 shadow-none ps-1 bg-transparent" placeholder="Ketik nama karyawan untuk mencari...">
        </div>
    </div>
</div>

<!-- GRID DATA KARYAWAN -->
<div class="row g-3" id="daftarKaryawan">
    @foreach ($data as $datas)
    <!-- Karyawan 1 -->
    <div class="col-xl-3 col-lg-4 col-md-6 employee-item">
        <div class="card custom-card employee-card h-100 text-center p-4">
            <div class="avatar-container mb-3">
                <img src="{{ asset('storage/' . $datas->gambar) }}" class="avatar-img card-foto" alt="Foto">
            </div>
            <span class="badge bg-primary-subtle text-primary rounded-pill mb-2 align-self-center px-3 py-1 fw-semibold small card-status">Aktif</span>
            <h5 class="fw-bold mb-1 text-dark card-nama">{{ $datas->nama_lengkap }}</h5>
            <p class="text-muted small mb-3 card-jabatan">{{ $datas->nip }}</p>
            <div class="border-top pt-3 mt-auto text-start">
                <p class="small mb-1 text-secondary"><i class="bi bi-building me-2"></i><span class="card-dept">Teknologi Informasi</span></p>
                <p class="small mb-3 text-secondary text-truncate"><i class="bi bi-envelope me-2"></i><span class="card-email">{{ $datas->no_hp }}</span></p>
                <button class="btn btn-outline-indigo w-100 btn-sm py-2" onclick="bukaModalEdit(this, 'EMPL-001')">
                    <i class="bi bi-pencil-square me-1"></i>Update Data
                </button>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
@section('base.js')
<div class="modal fade" id="modalEditKaryawan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0 bg-light py-3">
                <h5 class="modal-title fw-bold text-dark"><i class="bi bi-person-gear me-2 text-primary"></i>Edit Data Karyawan</h5>
                <button type="button" class="btn-close" onclick="tutupModal()"></button>
            </div>
            <form id="formUpdateKaryawan">
                <div class="modal-body p-4">

                    <!-- FOTO PROFIL DI ATAS FORM MODAL -->
                    <div class="text-center">
                        <div class="modal-avatar-container">
                            <img src="" id="modalPreviewFoto" class="modal-avatar" alt="Preview">
                            <label for="modalUploadFoto" class="btn-edit-photo" title="Ubah Foto">
                                <i class="bi bi-camera-fill small"></i>
                            </label>
                            <input type="file" id="modalUploadFoto" accept="image/*" class="d-none">
                        </div>
                        <p class="text-muted small">Klik ikon kamera untuk mengganti foto</p>
                    </div>

                    <!-- FORM ISIAN -->
                    <div class="row g-3 mt-2">
                        <div class="col-md-4">
                            <label class="form-label">ID Karyawan</label>
                            <input type="text" id="modalId" class="form-control" readonly bg-light>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" id="modalNama" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jabatan</label>
                            <input type="text" id="modalJabatan" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Departemen</label>
                            <input type="text" id="modalDept" class="form-control" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Email Kantor</label>
                            <input type="email" id="modalEmail" class="form-control" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Status Hubungan Kerja</label>
                            <select id="modalStatus" class="form-select">
                                <option value="Tetap">Karyawan Tetap</option>
                                <option value="Kontrak">Kontrak</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer border-0 bg-light">
                    <button type="button" class="btn btn-secondary px-4" onclick="tutupModal()">Batal</button>
                    <button type="submit" class="btn btn-indigo px-4">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Inisialisasi element modal secara manual tanpa merusak UI Bootstrap
    const modalElement = document.getElementById('modalEditKaryawan');
    let targetCardKaryawan = null; // Menyimpan referensi card yang sedang diedit

    // 1. FITUR PENCARIAN REAL-TIME BERDASARKAN NAMA
    document.getElementById('inputPencarian').addEventListener('input', function(e) {
        const keyword = e.target.value.toLowerCase();
        const items = document.querySelectorAll('.employee-item');

        items.forEach(item => {
            const nama = item.querySelector('.card-nama').textContent.toLowerCase();
            if (nama.includes(keyword)) {
                item.style.setProperty('display', '', 'important'); // Tampilkan jika cocok
            } else {
                item.style.setProperty('display', 'none', 'important'); // Sembunyikan jika tidak cocok
            }
        });
    });

    // 2. FUNGSI UNTUK MEMBUKA MODAL & ISI DATA OTOMATIS DARI CARD
    function bukaModalEdit(button, idKaryawan) {
        // Cari Elemen Card Induk terdekat
        targetCardKaryawan = button.closest('.employee-card');

        // Tarik data dari card yang diklik
        const nama = targetCardKaryawan.querySelector('.card-nama').textContent;
        const jabatan = targetCardKaryawan.querySelector('.card-jabatan').textContent;
        const dept = targetCardKaryawan.querySelector('.card-dept').textContent;
        const email = targetCardKaryawan.querySelector('.card-email').textContent;
        const status = targetCardKaryawan.querySelector('.card-status').textContent;
        const fotoSrc = targetCardKaryawan.querySelector('.card-foto').src;

        // Tembuskan data ke input dalam Modal
        document.getElementById('modalId').value = idKaryawan;
        document.getElementById('modalNama').value = nama;
        document.getElementById('modalJabatan').value = jabatan;
        document.getElementById('modalDept').value = dept;
        document.getElementById('modalEmail').value = email;
        document.getElementById('modalStatus').value = status;
        document.getElementById('modalPreviewFoto').src = fotoSrc;

        // Tampilkan Modal secara manual lewat class Bootstrap
        modalElement.classList.add('show');
        modalElement.style.display = 'block';
        document.body.classList.add('modal-open');

        // Tambahkan backdrop gelap di belakang modal
        const backdrop = document.createElement('div');
        backdrop.className = 'modal-backdrop fade show';
        backdrop.id = 'modalBackdropId';
        document.body.appendChild(backdrop);
    }

    // 3. FUNGSI UNTUK MENUTUP MODAL
    function tutupModal() {
        modalElement.classList.remove('show');
        modalElement.style.display = 'none';
        document.body.classList.remove('modal-open');

        const backdrop = document.getElementById('modalBackdropId');
        if (backdrop) backdrop.remove();
    }

    // 4. LIVE PREVIEW FOTO DI DALAM MODAL
    document.getElementById('modalUploadFoto').addEventListener('change', function(event) {
        const [file] = event.target.files;
        if (file && file.type.startsWith('image/')) {
            document.getElementById('modalPreviewFoto').src = URL.createObjectURL(file);
        }
    });

    // 5. SIMULASI UPDATE DATA (Mengubah konten Card secara real-time saat disubmit)
    document.getElementById('formUpdateKaryawan').addEventListener('submit', function(e) {
        e.preventDefault();

        if (targetCardKaryawan) {
            // Ambil data baru dari input modal
            const namaBaru = document.getElementById('modalNama').value;
            const jabatanBaru = document.getElementById('modalJabatan').value;
            const deptBaru = document.getElementById('modalDept').value;
            const emailBaru = document.getElementById('modalEmail').value;
            const statusBaru = document.getElementById('modalStatus').value;
            const fotoBaruSrc = document.getElementById('modalPreviewFoto').src;

            // Update konten di card asal secara instan
            targetCardKaryawan.querySelector('.card-nama').textContent = namaBaru;
            targetCardKaryawan.querySelector('.card-jabatan').textContent = jabatanBaru;
            targetCardKaryawan.querySelector('.card-dept').textContent = deptBaru;
            targetCardKaryawan.querySelector('.card-email').textContent = emailBaru;
            targetCardKaryawan.querySelector('.card-foto').src = fotoBaruSrc;

            // Update Badge Status warna dinamis
            const badge = targetCardKaryawan.querySelector('.card-status');
            badge.textContent = statusBaru;
            if (statusBaru === 'Tetap') {
                badge.className = "badge bg-primary-subtle text-primary rounded-pill mb-2 align-self-center px-3 py-1 fw-semibold small card-status";
            } else {
                badge.className = "badge bg-warning-subtle text-warning rounded-pill mb-2 align-self-center px-3 py-1 fw-semibold small card-status";
            }

            alert('Data Karyawan Berhasil Diperbarui!');
            tutupModal();
        }
    });
</script>
@endsection
