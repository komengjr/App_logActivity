@extends('layouts.template')
@section('base.css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.4/css/responsive.bootstrap5.css">
@endsection
@section('content')
<style>
    .card-profile {

        /* Ketebalan dan warna dasar border (Ganti #00f2fe dengan warna pilihanmu) */
        border: 1px solid #fe0000;

        /* Animasi bercahaya halus */
        animation: simple-glow 0.5s ease-in-out infinite alternate;
    }

    /* Animasi Cahaya Redup-Terang */
    @keyframes simple-glow {
        0% {
            box-shadow: 0 0 5px rgba(0, 242, 254, 0.2);
        }

        100% {
            box-shadow: 0 0 15px rgba(253, 3, 3, 0.6);
        }
    }
</style>
<div class="row g-0">
    <div class="col-lg-8 pe-lg-2 ">
        <div class="card mb-3 card-profile">
            <div class="card-header position-relative min-vh-25 mb-7 ">
                <div class="bg-holder rounded-3 rounded-bottom-0" style="background-image:url(../../asset/img/generic/4.jpg);">
                </div>
                <!--/.bg-holder-->

                <div class="avatar avatar-5xl avatar-profile"><img class="rounded-circle img-thumbnail shadow-sm" src="{{ asset('storage/' . $bio->gambar) }}" width="200" alt="" /></div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="mb-1"> {{ Auth::user()->name }} <span data-bs-toggle="tooltip" data-bs-placement="right" title="Verified"><small class="fa fa-check-circle text-primary" data-fa-transform="shrink-4 down-2"></small></span>
                        </h4>
                        <h5 class="fs-0 fw-normal">IT Support & Developer - {{ $bio->nip }}</h5>
                        <p class="text-500">{{ $bio->alamat }}</p>
                        <h5 class="fs-0 fw-normal">Handle :
                            @foreach ($handle as $hand)
                            <strong class="text-primary">{{ $hand->nama_cabang }}</strong> ,
                            @endforeach
                        </h5>
                        <div class="btn-group mt-2">
                            <button class="btn dropdown-toggle btn-primary btn-sm px-3" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fas fa-file-signature"></span> Check In Daily
                            </button>

                            <div class="dropdown-menu">
                                @foreach ($handle as $hand)
                                <a class="dropdown-item" href="#" id="button-proses-check-in" data-bs-toggle="modal" data-bs-target="#modal-template" data-code="{{ $hand->kd_cabang }}">{{ $hand->nama_cabang }}</a>
                                @endforeach
                                <!-- <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Separated link</a> -->
                            </div>
                        </div>
                        <div class="btn-group mt-2">
                            <button class="btn dropdown-toggle btn-warning btn-sm px-3" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="far fa-chart-bar"></span> Log Daily
                            </button>

                            <div class="dropdown-menu">
                                @foreach ($handle as $hand)
                                <a class="dropdown-item" href="#" id="button-history-daily" data-bs-toggle="modal" data-bs-target="#modal-template" data-code="{{ $hand->kd_cabang }}">{{ $hand->nama_cabang }}</a>
                                @endforeach
                                <!-- <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Separated link</a> -->
                            </div>
                        </div>
                        <!-- <div class="border-dashed-bottom my-4 d-lg-none"></div> -->
                    </div>
                    <div class="col ps-2 ps-lg-3">

                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary py-3 d-flex justify-content-between align-items-center border-0">
                <h5 class="mb-0 fw-bold text-white"><i class="bi bi-list-stars me-2"></i>Log Tugas</h5>
                <span class="badge bg-primary" id="totalTugasPetugas">0 Tugas</span>
            </div>

            <div class="card-body p-3 bg-light-subtle">
                <div id="listTugasPetugas" class="vstack gap-3">
                    <div id="emptyStatePetugas" class="text-center py-5 text-muted bg-white rounded border">
                        <i class="bi bi-check2-circle display-4 text-success"></i>
                        <p class="mt-2 mb-0 fw-semibold">Belum ada data tugas di dalam database.</p>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="col-lg-4 ps-lg-2">
        <div class="sticky-sidebar">
            <div class="card mb-3 mb-lg-0">
                <div class="card-header bg-300">
                    <h5 class="mb-0">Rekap Laporan</h5>
                </div>
                <div class="card-body fs--1">
                    <div class="d-flex btn-reveal-trigger">
                        <div class="calendar"><span class="calendar-month bg-success">Doc</span><span class="calendar-day"><span class="fas fa-file-pdf"></span></span></div>
                        <div class="flex-1 position-relative ps-3">
                            <h6 class="fs-0 mb-0"><a href="#" data-bs-toggle="modal" data-bs-target="#modal-template" id="button-monitoring-harian">Monitoring Back Up Harian</a></h6>
                            <p class="mb-1">User by <a href="#!" class="text-700">{{ Auth::user()->name }}</a></p>
                            <p class="text-success mb-0">Ready</p>
                            Note : Backup Harian & Kritis
                            <div class="border-dashed-bottom my-3"></div>
                        </div>
                    </div>
                    <div class="d-flex btn-reveal-trigger">
                        <div class="calendar"><span class="calendar-month bg-info">Doc</span><span class="calendar-day"><span class="fas fa-file-pdf"></span></span></div>
                        <div class="flex-1 position-relative ps-3">
                            <h6 class="fs-0 mb-0"><a href="#">Monitoring Back Up Bulanan</a></h6>
                            <p class="mb-1">User by <a href="#!" class="text-700">{{ Auth::user()->name }}</a></p>
                            <p class="text-danger mb-0">Coming Soon</p>
                            Note : Backup Bulanan
                            <div class="border-dashed-bottom my-3"></div>
                        </div>
                    </div>
                    <div class="d-flex btn-reveal-trigger">
                        <div class="calendar"><span class="calendar-month">Doc</span><span class="calendar-day"><span class="fas fa-file-pdf"></span></span></div>
                        <div class="flex-1 position-relative ps-3">
                            <h6 class="fs-0 mb-0"><a href="#">Monitoring Laporan User</a></h6>
                            <p class="mb-1">User by <a href="#!" class="text-700">{{ Auth::user()->name }}</a></p>
                            <p class="text-danger mb-0">Coming Soon</p>
                            Note : Catatan Laporan User
                            <div class="border-dashed-bottom my-3"></div>
                        </div>
                    </div>
                    <div class="d-flex btn-reveal-trigger">
                        <div class="calendar"><span class="calendar-month bg-primary">Doc</span><span class="calendar-day"><span class="fas fa-file-pdf"></span></span></div>
                        <div class="flex-1 position-relative ps-3">
                            <h6 class="fs-0 mb-0"><a href="#">Rencana Maintenance Bulanan</a></h6>
                            <p class="mb-1">User by <a href="#!" class="text-700">{{ Auth::user()->name }}</a></p>
                            <p class="text-danger mb-0">Coming Soon</p>
                            Note : Pastikan Jadwal Bulanan Sudah di setting
                            <div class="border-dashed-bottom my-3"></div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light p-0 border-top"><a class="btn btn-link d-block w-100" href="#">All Feature<span class="fas fa-chevron-right ms-1 fs--2"></span></a></div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('base.js')
<div class="modal fade" id="modalAlihkan" tabindex="-1" aria-labelledby="modalAlihkanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title fw-bold" id="modalAlihkanLabel"><i class="bi bi-arrow-left-right me-2"></i>Alihkan Tugas Ini</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="alihkanTugasId">

                <div class="mb-3">
                    <label for="selectPetugasBaru" class="form-label fw-semibold">Pilih Petugas Pengganti</label>
                    <select class="form-select" id="selectPetugasBaru" required>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="alasanAlihkan" class="form-label fw-semibold">Alasan Pengalihan / Disposisi</label>
                    <textarea class="form-control" id="alasanAlihkan" rows="3" placeholder="Sebutkan alasan penundaan atau pengalihan tugas..." required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-warning fw-bold" onclick="eksekusiAlihkanTugas()">Konfirmasi Alihkan</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.4/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.4/js/responsive.bootstrap5.js"></script>
<script>
    $(document).on("click", "#button-proses-check-in", function(e) {
        e.preventDefault();
        var code = $(this).data("code");
        $('#menu-template').html(
            '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        $.ajax({
            url: "{{ route('dashboard_check_in_proses') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "code": code
            },
            dataType: 'html',
        }).done(function(data) {
            $('#menu-template').html(data);
        }).fail(function() {
            $('#menu-template').html('eror');
        });
    });

    $(document).on("click", "#button-monitoring-harian", function(e) {
        e.preventDefault();
        $('#menu-template').html(
            '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        $.ajax({
            url: "{{ route('dashboard_monitoring_harian_kritis') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "code": 2123
            },
            dataType: 'html',
        }).done(function(data) {
            $('#menu-template').html(data);
        }).fail(function() {
            $('#menu-template').html('eror');
        });
    });
    $(document).on("click", "#button-preview-backup-harian-kritis", function(e) {
        e.preventDefault();
        const tanggal = document.getElementById('tanggal_monitoring_harian').value;
        $('#report-backup-harian').html(
            '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        console.log(tanggal);

        $.ajax({
            url: "{{ route('dashboard_monitoring_harian_backup_kritis') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "date": tanggal
            },
            dataType: 'html',
        }).done(function(data) {
            $("#report-backup-harian").html(
                '<iframe src="data:application/pdf;base64, ' +
                data +
                '" style="width:100%;; height:500px;" frameborder="0"></iframe>'
            );
        }).fail(function() {
            $('#report-backup-harian').html('eror');
        });
    });
    $(document).on("click", "#button-preview-backup-harian", function(e) {
        e.preventDefault();
        const tanggal = document.getElementById('tanggal_monitoring_harian').value;
        $('#report-backup-harian').html(
            '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        console.log(tanggal);

        $.ajax({
            url: "{{ route('dashboard_monitoring_harian_backup_report') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "date": tanggal
            },
            dataType: 'html',
        }).done(function(data) {
            $("#report-backup-harian").html(
                '<iframe src="data:application/pdf;base64, ' +
                data +
                '" style="width:100%;; height:500px;" frameborder="0"></iframe>'
            );
        }).fail(function() {
            $('#report-backup-harian').html('eror');
        });
    });

    // DATA LOG
    $(document).on("click", "#button-history-daily", function(e) {
        e.preventDefault();
        var code = $(this).data("code");
        $('#menu-template').html(
            '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        $.ajax({
            url: "{{ route('dashboard_log_daily') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "code": code
            },
            dataType: 'html',
        }).done(function(data) {
            $('#menu-template').html(data);
        }).fail(function() {
            $('#menu-template').html('eror');
        });
    });
    $(document).on("click", "#button-remove-daily", function(e) {
        e.preventDefault();
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: true
        });
        swalWithBootstrapButtons.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                var code = $(this).data("code");
                $.ajax({
                    url: "{{ route('dashboard_log_daily_remove') }}",
                    type: "POST",
                    cache: false,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "code": code
                    },
                    dataType: 'html',
                }).done(function(data) {
                    Swal.fire('Berhasil!', 'Data Log Berhasil di Hapus', 'success').then(() => {
                        location.reload();
                    });
                }).fail(function() {
                    Swal.fire('Gagal!', 'Data Log Gagal di Hapus', 'error').then(() => {
                        location.reload();
                    });
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                /* Read more about handling dismissals below */
                swalWithBootstrapButtons.fire({
                    title: "Cancelled",
                    text: "Your imaginary file is safe :)",
                    icon: "error"
                });

            }
        });

    });
</script>
<script>
    const API_URL = '/app/dashboard_home';
</script>
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Deklarasi Variabel Global DOM Elemen (Tanpa Select Login)
    let selectPetugasBaru;
    let listTugasPetugas;
    let emptyStatePetugas;
    let totalTugasPetugas;
    let formAlihkanTugas;

    let dataTugasGlobal = [];
    let dataUserGlobal = [];
    let modalAlihkanBs;

    // Inisialisasi DOM setelah halaman siap
    document.addEventListener("DOMContentLoaded", () => {
        selectPetugasBaru = document.getElementById('selectPetugasBaru');
        listTugasPetugas = document.getElementById('listTugasPetugas');
        emptyStatePetugas = document.getElementById('emptyStatePetugas');
        totalTugasPetugas = document.getElementById('totalTugasPetugas');
        formAlihkanTugas = document.getElementById('formAlihkanTugas');

        const modalElement = document.getElementById('modalAlihkan');
        if (modalElement) {
            modalAlihkanBs = new bootstrap.Modal(modalElement);
        }

        initPage();
    });

    async function initPage() {
        await fetchUsers(); // Mengambil daftar user untuk opsi modal pengalihan
        await fetchTugas(); // Langsung tarik data semua tugas
    }

    // 1. Mengambil data Petugas dari Database (Hanya untuk Dropdown Modal Pengalihan)
    async function fetchUsers() {
        try {
            const response = await fetch(`${API_URL}/users`);
            dataUserGlobal = await response.json();
        } catch (error) {
            console.error('Gagal mengambil data user:', error);
        }
    }

    // Update target delegasi pada modal (Bisa dialihkan ke siapa saja yang terdaftar)
    function updateDropdownPengganti(petugasAktif = '') {
        if (!selectPetugasBaru) return;

        // Definisikan fallback string kosong jika petugasAktif bernilai null/undefined
        const pjAktif = (petugasAktif || '').toLowerCase().trim();

        selectPetugasBaru.innerHTML = '<option value="" disabled selected>Pilih petugas...</option>';

        dataUserGlobal.forEach(user => {
            // Safe-guard: ambil nama user, jika null ganti dengan string kosong
            const namaUser = (user.nama_lengkap || '').trim();

            if (namaUser === '') return; // Lewati jika data user tidak punya nama

            // Bandingkan secara aman untuk mengecualikan PJ aktif saat ini
            if (namaUser.toLowerCase() !== pjAktif) {
                selectPetugasBaru.innerHTML += `<option value="${user.id_user}">${namaUser} ss(${user.id_user || 'Umum'})</option>`;
            }
        });
    }

    // 2. Mengambil Semua Tugas tanpa Filter Login
    async function fetchTugas() {
        try {
            const response = await fetch(`${API_URL}/tugas`);
            dataTugasGlobal = await response.json();
            renderSemuaTugas();
        } catch (error) {
            console.error('Gagal memuat tugas:', error);
        }
    }

    // 3. Render Seluruh Tugas Tanpa Pengecekan User Login
    function renderSemuaTugas() {
        if (!listTugasPetugas) return;

        // Batasi tampilan list maksimal 10 data teratas sesuai request sebelumnya
        let listTampil = dataTugasGlobal.slice(0, 10);

        listTugasPetugas.innerHTML = '';
        listTugasPetugas.appendChild(emptyStatePetugas);

        if (listTampil.length === 0) {
            emptyStatePetugas.style.display = 'block';
            totalTugasPetugas.textContent = '0 Tugas';
            return;
        }

        emptyStatePetugas.style.display = 'none';
        totalTugasPetugas.textContent = `${listTampil.length} dari ${dataTugasGlobal.length} Tugas`;

        listTampil.forEach(tugas => {
            const opsiTgl = {
                day: 'numeric',
                month: 'short',
                year: 'numeric'
            };
            const fmtMulai = tugas.tgl_mulai ? new Date(tugas.tgl_mulai).toLocaleDateString('id-ID', opsiTgl) : '-';
            const fmtSelesai = tugas.tgl_selesai ? new Date(tugas.tgl_selesai).toLocaleDateString('id-ID', opsiTgl) : '-';

            let badgeClass = "bg-danger";
            if (tugas.status === "Dalam Pengerjaan") badgeClass = "bg-warning text-dark";
            if (tugas.status === "Dalam Peninjauan") badgeClass = "bg-info text-dark";
            if (tugas.status === "Selesai") badgeClass = "bg-success";

            let tombolAksiHtml = '';
            if (tugas.status === 'Belum Dimulai') {
                tombolAksiHtml = `
                        <button class="btn btn-sm btn-success fw-bold px-3 my-2" onclick="terimaTugas(${tugas.id})">
                            <i class="fas fa-check-lg me-1"></i> Terima Tugas
                        </button>
                        <button class="btn btn-sm btn-outline-warning text-dark fw-bold" onclick="bukaModalAlihkan(${tugas.id}, '${tugas.target_user}')">
                            <i class="fas fa-arrow-left-right me-1"></i> Alihkan
                        </button>
                    `;
            } else if (tugas.status !== 'Selesai') {
                tombolAksiHtml = `
                        <button class="btn btn-sm btn-primary fw-bold my-2" onclick="ajukanPeninjauan(${tugas.id})">
                            <i class="fas fa-send me-1"></i> Ajukan Peninjauan
                        </button>
                        <button class="btn btn-sm btn-outline-warning text-dark fw-bold" onclick="bukaModalAlihkan(${tugas.id}, '${tugas.target_user}')">
                            <i class="fas fa-arrow-left-right me-1"></i> Alihkan
                        </button>
                    `;
            } else {
                tombolAksiHtml = `<span class="text-success small fw-bold"><i class="bi bi-check-all me-1"></i> Selesai Dikerjakan</span>`;
            }

            let linkSurat = tugas.url_surat ? `<a href="${tugas.url_surat}" target="_blank" class="text-decoration-none small ms-2"><i class="fas fa-file-earmark-pdf text-danger me-1"></i>Surat Tugas</a>` : '';

            const card = document.createElement('div');
            card.className = "card border-0 shadow-sm mb-2 bg-white";
            card.innerHTML = `
                    <div class="card p-4 border border-primary">
                        <div class="row">
                            <div class="col-12 ">
                                <div class="d-flex gap-2 align-items-center mb-2 flex-wrap">
                                    <span class="badge bg-info text-white small">${tugas.tipe || 'Tugas'}</span>
                                    <span class="badge bg-dark text-white small"><i class="bi bi-person me-1"></i> PJ: ${tugas.target_user || 'Tanpa PJ'}</span>
                                    <span class="badge ${badgeClass} small">${tugas.status}</span>
                                    ${linkSurat}
                                </div>
                                <h5 class="fw-bold text-dark mb-1">${tugas.nama || 'Tanpa Judul'}</h5>
                                <p class="text-muted small mb-2"><i class="bi bi-calendar-event me-1"></i> Batas Waktu: ${fmtMulai} - ${fmtSelesai}</p>
                                <div class="bg-light p-2 rounded text-secondary small border" style="white-space: pre-line;">${tugas.deskripsi || 'Tidak ada deskripsi.'}</div>
                            </div>
                            <div class="col-12">
                                ${tombolAksiHtml}
                            </div>
                        </div>
                    </div>
                `;
            listTugasPetugas.appendChild(card);
        });
    }

    // 4. Submit Terima Tugas
    async function terimaTugas(id) {
        try {
            const response = await fetch(`${API_URL}/tugas/${id}/terima`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });
            if (response.ok) fetchTugas();
        } catch (error) {
            console.error(error);
        }
    }

    // Submit Ajukan Peninjauan
    async function ajukanPeninjauan(id) {
        try {
            const response = await fetch(`${API_URL}/tugas/${id}/status`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    status: 'Dalam Peninjauan'
                })
            });
            if (response.ok) fetchTugas();
        } catch (error) {
            console.error(error);
        }
    }

    // 5. Buka Modal Alihkan (Menangkap ID tugas & nama penanggung jawab saat ini)
    function bukaModalAlihkan(id, petugasAktif) {
        console.log("Membuka modal alihkan untuk Tugas ID:", id, "PJ Aktif saat ini:", petugasAktif);

        const hiddenInputId = document.getElementById('alihkanTugasId');
        const txtAlasan = document.getElementById('alasanAlihkan');

        if (!hiddenInputId || !txtAlasan) {
            console.error("Elemen form modal tidak ditemukan di DOM HTML!");
            return;
        }

        hiddenInputId.value = id;
        txtAlasan.value = '';

        // Perbarui dropdown pilihan karyawan pengganti
        updateDropdownPengganti(petugasAktif);

        // Tampilkan modal secara eksplisit
        if (modalAlihkanBs) {
            modalAlihkanBs.show();
        } else {
            // Fallback jika instansiasi bootstrap modal gagal bermasalah
            const backupModal = new bootstrap.Modal(document.getElementById('modalAlihkan'));
            backupModal.show();
        }
    }

    // Event Listener Submit Pemindahan Tugas Petugas
    // Fungsi Eksekusi Pengalihan Tugas secara Real-Time tanpa Reload Page
    async function eksekusiAlihkanTugas() {
        const id = document.getElementById('alihkanTugasId').value;
        const selectPetugas = document.getElementById('selectPetugasBaru');
        const txtAlasan = document.getElementById('alasanAlihkan');

        const petugasBaru = selectPetugas ? selectPetugas.value : '';
        const alasan = txtAlasan ? txtAlasan.value.trim() : '';

        // Validasi manual sebelum dikirim ke Laravel
        if (!petugasBaru) {
            alert('Silakan pilih petugas pengganti terlebih dahulu!');
            return;
        }
        if (!alasan) {
            alert('Silakan isi alasan pengalihan tugas!');
            return;
        }

        try {
            const response = await fetch(`${API_URL}/tugas/${id}/alihkan`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    petugas_baru: petugasBaru,
                    alasan: alasan
                })
            });

            const result = await response.json();

            if (response.ok) {
                // 1. Sembunyikan Modal secara aman lewat Bootstrap API
                const modalElement = document.getElementById('modalAlihkan');
                const modalInstance = bootstrap.Modal.getInstance(modalElement);
                if (modalInstance) {
                    modalInstance.hide();
                }

                // 2. Refresh data list tugas secara asinkronus (tanpa reload halaman)
                await fetchTugas();

                // 3. Tampilkan pesan sukses berupa log kecil / alert opsional
                console.log('Sukses dialihkan:', result.message);
            } else {
                alert('Gagal mengalihkan tugas: ' + (result.message || 'Terjadi kesalahan server.'));
            }
        } catch (error) {
            console.error('Error saat eksekusi alihkan:', error);
            alert('Gagal terhubung ke server. Periksa koneksi jaringan Anda.');
        }
    }
</script>
@endsection
