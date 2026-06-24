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
                <h5 class="fw-bold text-dark"><i class="bi bi-calendar-week text-primary"></i>Master Tools IT</h5>
                <p class="text-muted mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit voluptatibus, ducimus ea ut ipsam laborum error doloribus consectetur! Quibusdam repudiandae animi atque consequuntur cum in? Necessitatibus deserunt quod sequi laudantium!</p>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center mb-4">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="card-title mb-0" style="color: white;">Data Kritis</h5>
            </div>
            <div class="card-body p-4">

                <div id="alertContainer"></div>

                <form id="filterForm">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Tanggal Mulai</label>
                            <input type="date" id="tgl_mulai" name="tgl_mulai" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Tanggal Selesai</label>
                            <input type="date" id="tgl_selesai" name="tgl_selesai" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Pilih Cabang</label>
                            <select id="kd_cabang" name="kd_cabang" class="form-select" required>
                                <option value="">-- Pilih Cabang --</option>
                                @foreach ($cabang as $cab)
                                <option value="{{ $cab->kd_cabang }}">{{ $cab->nama_cabang }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row text-center">
                        <div class="col-md-4 mb-2">
                            <button type="button" onclick="aksiData('{{ route('master_data_tools_show') }}', 'GET')" class="btn btn-secondary w-100 py-2 fw-bold">
                                🔍 Tampilkan Data Kritis
                            </button>
                        </div>
                        <div class="col-md-4 mb-2">
                            <button type="button" onclick="aksiData('{{ route('master_data_tools_proses') }}', 'POST')" class="btn btn-primary w-100 py-2 fw-bold">
                                ⚡ Proses Data Kritis
                            </button>
                        </div>
                        <div class="col-md-4 mb-2">
                            <button type="button" onclick="aksiData('{{ route('master_data_tools_proses_backup') }}', 'POST')" class="btn btn-primary w-100 py-2 fw-bold">
                                💾 Proses Backup Harian
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center d-none" id="tableContainer">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center py-3">
                <h5 class="card-title mb-0 text-white" id="tableTitle">Hasil Data Log</h5>
                <span class="badge bg-primary fs-2" id="rowCountBadge">0 Baris</span>
            </div>

            <div class="card-body p-0">
                <form id="updateForm">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="tgl_mulai" id="hid_tgl_mulai">
                    <input type="hidden" name="tgl_selesai" id="hid_tgl_selesai">
                    <input type="hidden" name="kd_cabang" id="hid_kd_cabang">

                    <div class="table-responsive">
                        <table id="myDataTable" class="table table-striped table-hover mb-0 align-middle">
                            <thead class="table-secondary">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="15%">Tanggal</th>
                                    <th width="15%">Kode Kinerja</th>
                                    <th width="10%">Cabang</th>
                                    <th width="10%">Status</th>
                                    <th width="45%">Keterangan Kinerja (Bisa Diedit)</th>
                                </tr>
                            </thead>
                            <tbody id="logTableBody">
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer d-flex justify-content-end bg-light py-3">
                        <button type="button" onclick="simpanKeterangan()" class="btn btn-success px-4 fw-bold">
                            💾 Simpan Perubahan Keterangan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center d-none" id="backupContainer">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header bg-success text-white py-3">
                <h5 class="card-title mb-0 text-white" id="backupTitle">Hasil Data Backup Harian</h5>
            </div>
            <div class="card-body p-4">
                <form id="backupUpdateForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="tgl_mulai" id="hid_tgl_mulai">
                    <input type="hidden" name="tgl_selesai" id="hid_tgl_selesai">
                    <input type="hidden" name="kd_cabang" id="hid_kd_cabang">

                    <div class="table-responsive">
                        <table id="backupDataTable" class="table table-striped table-hover align-middle w-100">
                            <thead class="table-success">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="15%">Tanggal Backup</th>
                                    <th width="20%">Kode Backup</th>
                                    <th width="15%">Sistem / Proses</th>
                                    <th width="10%">File</th>
                                    <th width="10%">Status</th>
                                    <th width="25%">Deskripsi Backup (Dapat Diedit)</th>
                                </tr>
                            </thead>
                            <tbody id="backupTableBody">
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end bg-light py-3 mt-3 px-2">
                        <button type="button" onclick="simpanKeteranganBackup()" class="btn btn-success px-4 fw-bold">
                            💾 Simpan Deskripsi Backup
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
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
    let dataTableInstance = null; // Menyimpan instansi DataTable agar bisa di-reset
    let backupTableInstance = null;

    async function aksiData(url, method) {
        const tgl_mulai = document.getElementById('tgl_mulai').value;
        const tgl_selesai = document.getElementById('tgl_selesai').value;
        const kd_cabang = document.getElementById('kd_cabang').value;

        if (!tgl_mulai || !tgl_selesai || !kd_cabang) {
            alert('Semua filter wajib diisi!');
            return;
        }

        // Set filter hidden data
        document.getElementById('hid_tgl_mulai').value = tgl_mulai;
        document.getElementById('hid_tgl_selesai').value = tgl_selesai;
        document.getElementById('hid_kd_cabang').value = kd_cabang;

        let fetchUrl = url;
        let options = {
            method: method,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        };

        if (method === 'GET') {
            fetchUrl += `?tgl_mulai=${tgl_mulai}&tgl_selesai=${tgl_selesai}&kd_cabang=${kd_cabang}`;
        } else {
            const formData = new FormData();
            formData.append('tgl_mulai', tgl_mulai);
            formData.append('tgl_selesai', tgl_selesai);
            formData.append('kd_cabang', kd_cabang);
            options.body = formData;
        }

        try {
            const response = await fetch(fetchUrl, options);
            const resData = await response.json();

            if (!response.ok) throw new Error(resData.message || 'Terjadi kesalahan sistem.');

            if (resData.success) {
                showAlert('success', resData.message);
            }

            // Ganti baris pemindahan classList lama Anda dengan blok kondisional yang aman ini:
            const backupCont = document.getElementById('backupContainer');
            const kinerjaCont = document.getElementById('kinerjaContainer');

            if (url.includes('proses-backup') || url.includes('backup')) {
                // Jalur untuk tabel Backup
                if (backupCont) backupCont.classList.remove('d-none');
                if (kinerjaCont) kinerjaCont.classList.add('d-none');

                renderBackupTable(resData.data, kd_cabang, tgl_mulai, tgl_selesai);
            } else {
                // Jalur untuk tabel Kinerja Log
                if (kinerjaCont) kinerjaCont.classList.remove('d-none');
                if (backupCont) backupCont.classList.add('d-none');

                // Pastikan Anda sudah memiliki fungsi renderKinerjaTable sebelumnya
                renderKinerjaTable(resData.data, kd_cabang, tgl_mulai, tgl_selesai);
            }

        } catch (error) {
            showAlert('danger', error.message);
        }
    }

    function renderKinerjaTable(data, cabang, mulai, selesai) {
        // 🟢 Hancurkan DataTable jika sebelumnya sudah pernah terisi data lain
        if (dataTableInstance) {
            dataTableInstance.destroy();
        }

        const tbody = document.getElementById('logTableBody');
        const container = document.getElementById('tableContainer');
        tbody.innerHTML = '';

        document.getElementById('tableTitle').innerText = `Hasil Data Log (Cabang: ${cabang} | Periode: ${mulai} s/d ${selesai})`;

        data.forEach((log, index) => {
            const statusBadge = log.status_kinerja_sub == 0 ? 'bg-warning text-dark' : 'bg-success';
            tbody.innerHTML += `
                <tr>
                    <td>${index + 1}</td>
                    <td><span class="badge bg-white text-dark border">${log.tgl_record}</span></td>
                    <td><code>${log.kd_kinerja_sub}</code> - ${log.kinerja_sub}</td>
                    <td>${log.kd_cabang}</td>
                    <td><span class="badge ${statusBadge}">${log.status_kinerja_sub}</span></td>
                    <td>
                        <input type="hidden" name="logs[${index}][id]" value="${log.id}">
                        <input type="text" name="logs[${index}][text_ket]" value="${log.ket_kinerja_sub ?? ''}" class="form-control form-control-sm">
                    </td>
                </tr>
            `;
        });

        container.classList.remove('d-none');

        // 🟢 Inisialisasi ulang DataTables setelah HTML selesai di-render
        dataTableInstance = $('#myDataTable').DataTable({
            "pageLength": 10, // Menampilkan 10 baris per halaman default
            "lengthMenu": [5, 10, 25, 50],
            "language": {
                "search": "Cari data cepat:",
                "lengthMenu": "Tampilkan _MENU_ baris",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "paginate": {
                    "next": "Berikutnya",
                    "previous": "Sebelumnya"
                }
            }
        });
    }

    async function simpanKeterangan() {
        // 🟢 Catatan Penting: Karena menggunakan Pagination DataTables, data input teks di halaman 2, 3, dst
        // tidak akan terbaca jika hanya menggunakan `new FormData(form)`.
        // Solusinya kita menggunakan API internal jQuery DataTables untuk mengambil semua baris input (termasuk yang tersembunyi).

        let formData = new FormData();
        formData.append('_token', document.querySelector('input[name="_token"]').value);
        formData.append('_method', 'PUT');
        formData.append('tgl_mulai', document.getElementById('hid_tgl_mulai').value);
        formData.append('tgl_selesai', document.getElementById('hid_tgl_selesai').value);
        formData.append('kd_cabang', document.getElementById('hid_kd_cabang').value);

        // Ambil data input dari semua baris di semua page DataTable
        dataTableInstance.$('input').each(function() {
            formData.append($(this).attr('name'), $(this).val());
        });

        try {
            const response = await fetch('{{ route("master_data_tools_update") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            const resData = await response.json();

            if (response.ok) {
                showAlert('success', resData.message);
                renderTable(resData.data, document.getElementById('hid_kd_cabang').value, document.getElementById('hid_tgl_mulai').value, document.getElementById('hid_tgl_selesai').value);
            } else {
                throw new Error(resData.message || 'Gagal menyimpan.');
            }
        } catch (error) {
            showAlert('danger', error.message);
        }
    }

    // ==========================================
    // RENDER TABEL KHUSUS BACKUP HARIAN
    // ==========================================
    function renderBackupTable(data, cabang, mulai, selesai) {
        if (backupTableInstance) {
            backupTableInstance.destroy();
        }

        const tbody = document.getElementById('backupTableBody');
        tbody.innerHTML = '';

        document.getElementById('backupTitle').innerText = `Data Backup Harian (Cabang: ${cabang} | Periode: ${mulai} s/d ${selesai})`;

        data.forEach((log, index) => {
            const statusBadge = log.status_backup_harian == 0 ? 'bg-warning text-dark' : 'bg-success';

            // Cek status file untuk tampilan tombol/indikator
            let fileDisplay = '';
            if (log.file_backup_harian && log.file_backup_harian !== '-') {
                fileDisplay = `
                <div class="mb-1">
                    <a href="/storage/${log.file_backup_harian}" target="_blank" class="btn btn-xs btn-info p-1 py-0 fs--1 text-white text-decoration-none rounded">📄 Lihat File</a>
                </div>
            `;
            } else {
                fileDisplay = `<span class="text-danger d-block mb-1 fs--1">Belum ada file</span>`;
            }

            tbody.innerHTML += `
            <tr>
                <td>${index + 1}</td>
                <td><span class="badge bg-white text-dark border">${log.tgl_backup_harian}</span></td>
                <td><code>${log.kd_users_backup_harian}</code></td>
                <td>
                    <strong>${log.sistem_backup_harian}</strong><br>
                    <small class="text-muted">Proses: ${log.proses_backup_harian}</small>
                </td>
                <td>
                    ${fileDisplay}
                    <input type="file"
                           id="file_${log.id_users_backup_harian}"
                           onchange="uploadFileOtomatis(${log.id_users_backup_harian})"
                           class="form-control form-control-sm"
                           accept=".zip,.rar,.sql,.pdf,.jpg,.png">
                </td>
                <td><span class="badge ${statusBadge}">${log.status_backup_harian}</span></td>
                <td>
                    <input type="hidden" name="logs[${index}][id]" value="${log.id_users_backup_harian}">
                    <input type="text" name="logs[${index}][text_ket]" value="${log.deskripsi_backup_harian ?? ''}" class="form-control form-control-sm">
                </td>
            </tr>
        `;
        });

        backupTableInstance = $('#backupDataTable').DataTable({
            "pageLength": 10,
            "lengthMenu": [5, 10, 25, 50],
            "language": {
                "search": "Cari data cepat:",
                "paginate": {
                    "next": ">>",
                    "previous": "<<"
                }
            }
        });
    }

    // ==========================================
    // PROSES UPDATE DESKRIPSI BACKUP VIA AJAX
    // ==========================================
    async function simpanKeteranganBackup() {
        let formData = new FormData();
        formData.append('_token', document.querySelector('input[name="_token"]').value);
        formData.append('_method', 'PUT');
        formData.append('tgl_mulai', document.getElementById('hid_tgl_mulai').value);
        formData.append('tgl_selesai', document.getElementById('hid_tgl_selesai').value);
        formData.append('kd_cabang', document.getElementById('hid_kd_cabang').value);

        // Ambil input dari seluruh baris halaman DataTables backup harian
        backupTableInstance.$('input').each(function() {
            formData.append($(this).attr('name'), $(this).val());
        });

        try {
            const response = await fetch('{{ route("master_data_tools_proses_backup_update") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            const resData = await response.json();

            if (response.ok) {
                showAlert('success', resData.message);
                renderBackupTable(resData.data, document.getElementById('hid_kd_cabang').value, document.getElementById('hid_tgl_mulai').value, document.getElementById('hid_tgl_selesai').value);
            } else {
                throw new Error(resData.message || 'Gagal menyimpan.');
            }
        } catch (error) {
            showAlert('danger', error.message);
        }
    }
    async function uploadFileOtomatis(id) {
        const fileInput = document.getElementById(`file_${id}`);
        const file = fileInput.files[0];

        if (!file) return;

        // Persiapkan FormData khusus upload file
        let formData = new FormData();
        formData.append('_token', document.querySelector('input[name="_token"]').value);
        formData.append('id_backup', id);
        formData.append('file_backup', file);

        // Ambil data filter untuk keperluan reload tabel otomatis setelah upload
        formData.append('tgl_mulai', document.getElementById('hid_tgl_mulai').value);
        formData.append('tgl_selesai', document.getElementById('hid_tgl_selesai').value);
        formData.append('kd_cabang', document.getElementById('hid_kd_cabang').value);

        try {
            showAlert('info', 'Sedang mengunggah file, mohon tunggu...');

            const response = await fetch('{{ route("master_data_tools_proses_backup_update_file") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const resData = await response.json();

            if (response.ok) {
                showAlert('success', resData.message);
                // Render ulang tabel backup agar tombol "Lihat File" dan status langsung terupdate
                renderBackupTable(resData.data, document.getElementById('hid_kd_cabang').value, document.getElementById('hid_tgl_mulai').value, document.getElementById('hid_tgl_selesai').value);
            } else {
                throw new Error(resData.message || 'Gagal mengunggah file.');
            }
        } catch (error) {
            showAlert('danger', error.message);
        }
    }
    // Pembantu UI Alert
    function showAlert(type, message) {
        document.getElementById('alertContainer').innerHTML = `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;
    }
</script>

@endsection
