<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Validasi Tiket - {{ $laporan->tiket_laporan }} | LogIT System</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('asset/img/icons/shield.png') }}">

    <!-- Bootstrap 5 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Google Fonts (Inter) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #e8f1fc, #ffffff);
            position: relative;
            padding: 40px 0;
        }

        /* === Latar Belakang Animasi === */
        .background-animation {
            position: fixed;
            inset: 0;
            overflow: hidden;
            z-index: 0;
        }

        .bg-shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.4;
            animation: float 12s ease-in-out infinite;
        }

        .bg-shape:nth-child(1) {
            width: 300px;
            height: 300px;
            background: #a0d3ff;
            top: 5%;
            left: 5%;
        }

        .bg-shape:nth-child(2) {
            width: 350px;
            height: 350px;
            background: #f5cba7;
            bottom: 5%;
            right: 5%;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        /* === Container Utama === */
        .main-container {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 720px;
            padding: 20px;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(14px);
            border-radius: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            padding: 2.2rem;
        }

        /* Info Box */
        .ticket-info-box {
            background: #f8fbff;
            border: 2px solid #e0e9f3;
            border-radius: 1rem;
            padding: 1.2rem;
            margin-bottom: 1.5rem;
        }

        /* === Timeline Style Minimalis === */
        .timeline-wrapper {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin: 1.5rem 0 2rem 0;
        }

        .timeline-wrapper::before {
            content: '';
            position: absolute;
            top: 18px;
            left: 10%;
            right: 10%;
            height: 3px;
            background: #e2e8f0;
            z-index: 1;
        }

        .timeline-step {
            position: relative;
            z-index: 2;
            text-align: center;
            flex: 1;
        }

        .timeline-icon {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #ffffff;
            border: 3px solid #cbd5e1;
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 8px auto;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .timeline-step.completed .timeline-icon {
            background: #5a9bd5;
            border-color: #5a9bd5;
            color: #ffffff;
            box-shadow: 0 4px 10px rgba(90, 155, 213, 0.3);
        }

        .timeline-step.verified .timeline-icon {
            background: #10b981;
            border-color: #10b981;
            color: #ffffff;
            box-shadow: 0 4px 10px rgba(16, 185, 129, 0.3);
        }

        .timeline-label {
            font-size: 0.75rem;
            font-weight: 700;
            color: #475569;
            margin-bottom: 2px;
        }

        .timeline-date {
            font-size: 0.68rem;
            color: #94a3b8;
        }

        /* Image Hover & Modal Custom */
        .img-preview-trigger {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            cursor: pointer;
        }

        .img-preview-trigger:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-submit {
            background-color: #5a9bd5;
            border: none;
            border-radius: 0.75rem;
            padding: 0.8rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #4689c4;
            color: white;
        }

        .info-label {
            font-size: 0.72rem;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .info-value {
            font-size: 0.9rem;
            font-weight: 600;
            color: #1e293b;
        }
    </style>
</head>

<body>
    <!-- Background Floating Elements -->
    <div class="background-animation">
        <div class="bg-shape"></div>
        <div class="bg-shape"></div>
    </div>

    <div class="main-container">
        <!-- Top Nav Bar -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ url('/login') }}" class="btn btn-dark btn-sm rounded-pill px-3">
                <i class="bi bi-arrow-left me-1"></i>
            </a>
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-2 fs-6">
                <i class="bi bi-ticket-perforated me-1"></i> #{{ $laporan->tiket_laporan }}
            </span>
        </div>

        <!-- Glass Card Content -->
        <div class="glass-card">

            <!-- Header Ticket Status -->
            <div class="ticket-info-box">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="fw-bold mb-0 text-dark">{{ $laporan->nama_user }}</h5>
                    <span class="badge
                    @if($laporan->status_laporan == '0') bg-danger
                    @elseif($laporan->status_laporan == '1') bg-warning text-dark
                    @elseif($laporan->status_laporan == '2') bg-info text-dark
                    @else bg-success @endif
                    rounded-pill px-3 py-2">

                        <i class="bi
                        @if($laporan->status_laporan == '0') bi-exclamation-circle-fill
                        @elseif($laporan->status_laporan == '1') bi-hourglass-split
                        @elseif($laporan->status_laporan == '2') bi-tools
                        @else bi-check-circle-fill @endif me-1"></i>

                        @if($laporan->status_laporan == '0')
                        Belum Direspon
                        @elseif($laporan->status_laporan == '1')
                        Sedang Diproses
                        @elseif($laporan->status_laporan == '2')
                        Penyelesaian IT
                        @else
                        Tiket Selesai
                        @endif
                    </span>
                </div>

                <!-- Grid Informasi Pelapor -->
                <div class="row g-2 mt-2 pt-2 border-top">
                    <div class="col-6 col-sm-4">
                        <span class="info-label d-block">NIP / ID</span>
                        <span class="info-value">{{ $laporan->nip_user }}</span>
                    </div>
                    <div class="col-6 col-sm-4">
                        <span class="info-label d-block">Divisi</span>
                        <span class="info-value">{{ $laporan->divisi }}</span>
                    </div>
                    <div class="col-6 col-sm-4">
                        <span class="info-label d-block">Cabang</span>
                        <span class="info-value">{{ $laporan->kd_cabang }}</span>
                    </div>
                    <div class="col-6 col-sm-4">
                        <span class="info-label d-block">Kategori</span>
                        <span class="info-value">
                            @if($laporan->kategori_laporan == 'ER-000')
                            Security
                            @elseif($laporan->kategori_laporan == 'ER-001')
                            Software
                            @elseif($laporan->kategori_laporan == 'ER-002')
                            Hardware
                            @else
                            {{ $laporan->kategori_laporan ?? '-' }}
                            @endif
                        </span>
                    </div>
                    <div class="col-6 col-sm-4">
                        <span class="info-label d-block">No. Kontak</span>
                        <span class="info-value">{{ $laporan->no_hp ?? '-' }}</span>
                    </div>
                    <div class="col-6 col-sm-4">
                        <span class="info-label d-block">Tingkat Penanganan</span>
                        <span class="info-value">
                            @if($laporan->tingkat_laporan == 1)
                            <span class="text-success"><i class="bi bi-shield-check me-1"></i> Rendah</span>
                            @elseif($laporan->tingkat_laporan == 2)
                            <span class="text-warning"><i class="bi bi-exclamation-triangle me-1"></i> Sedang</span>
                            @elseif($laporan->tingkat_laporan == 3)
                            <span class="text-danger"><i class="bi bi-exclamation-octagon me-1"></i> Tinggi</span>
                            @else
                            <span class="text-secondary">-</span>
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <!-- VISUAL TIMELINE PENANGANAN -->
            <div class="mb-4">
                <label class="form-label fw-bold small text-secondary">PROGRES LAPORAN</label>
                <div class="timeline-wrapper">

                    <!-- Step 1: Laporan Terbit -->
                    <div class="timeline-step {{ $laporan->tgl_laporan ? 'completed' : '' }}">
                        <div class="timeline-icon">
                            <i class="bi bi-file-earmark-plus"></i>
                        </div>
                        <div class="timeline-label">Terbit</div>
                        <div class="timeline-date">
                            {{ $laporan->tgl_laporan ? \Carbon\Carbon::parse($laporan->tgl_laporan)->format('d/m/y H:i') : '-' }}
                        </div>
                    </div>

                    <!-- Step 2: Respon IT -->
                    <div class="timeline-step {{ $laporan->tgl_respon_laporan ? 'completed' : '' }}">
                        <div class="timeline-icon">
                            <i class="bi bi-chat-left-dots"></i>
                        </div>
                        <div class="timeline-label">Respon IT</div>
                        <div class="timeline-date">
                            {{ $laporan->tgl_respon_laporan ? \Carbon\Carbon::parse($laporan->tgl_respon_laporan)->format('d/m/y H:i') : '-' }}
                        </div>
                    </div>

                    <!-- Step 3: Selesai IT -->
                    <div class="timeline-step {{ $laporan->tgl_selesai_laporan ? 'completed' : '' }}">
                        <div class="timeline-icon">
                            <i class="bi bi-tools"></i>
                        </div>
                        <div class="timeline-label">Selesai IT</div>
                        <div class="timeline-date">
                            {{ $laporan->tgl_selesai_laporan ? \Carbon\Carbon::parse($laporan->tgl_selesai_laporan)->format('d/m/y H:i') : '-' }}
                        </div>
                    </div>

                    <!-- Step 4: Verifikasi Pelapor -->
                    <div class="timeline-step {{ $laporan->tgl_verifikasi_laporan ? 'verified' : '' }}">
                        <div class="timeline-icon">
                            <i class="bi bi-patch-check"></i>
                        </div>
                        <div class="timeline-label">Verifikasi</div>
                        <div class="timeline-date">
                            {{ $laporan->tgl_verifikasi_laporan ? \Carbon\Carbon::parse($laporan->tgl_verifikasi_laporan)->format('d/m/y H:i') : '-' }}
                        </div>
                    </div>

                </div>
            </div>

            <!-- Detail Deskripsi Kendala & Lampiran Bukti Foto -->
            <div class="mb-4">
                <label class="form-label fw-bold small text-secondary">DESKRIPSI KENDALA</label>
                <div class="p-3 bg-white rounded-3 border text-dark fs-6" style="line-height: 1.6;">
                    {{ $laporan->deskripsi_laporan }}
                </div>

                {{-- Tampilkan Image + Trigger Modal Pop-up --}}
                @if($laporan->file)
                <div class="mt-3">
                    <label class="form-label fw-bold small text-secondary d-block">LAMPIRAN BUKTI KASUS</label>
                    <div class="p-2 bg-white rounded-3 border d-inline-block shadow-sm">
                        <img src="{{ asset('storage/bukti_kasus/' . $laporan->file) }}"
                            alt="Bukti Kasus"
                            class="img-fluid rounded-2 img-preview-trigger"
                            style="max-height: 200px; width: auto; object-fit: cover; display: block;"
                            data-bs-toggle="modal"
                            data-bs-target="#imageModal">
                    </div>
                    <small class="d-block text-muted mt-1" style="font-size: 0.75rem;">
                        <i class="bi bi-zoom-in me-1"></i> Klik gambar di atas untuk memperbesar (Pop-Up)
                    </small>
                </div>
                @endif
            </div>

            <!-- Log Pengerjaan IT -->
            <div class="mb-4">
                <label class="form-label fw-bold small text-secondary">RIWAYAT PENGERJAAN IT</label>
                @if(count($logs) > 0)
                <div class="d-flex flex-column gap-2">
                    @foreach($logs as $log)
                    <div class="p-3 rounded-3 {{ $log->id_user === 'PELAPOR' ? 'bg-primary-subtle border-primary-subtle' : 'bg-white border' }}">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="fw-bold small {{ $log->id_user === 'PELAPOR' ? 'text-primary' : 'text-dark' }}">
                                <i class="bi {{ $log->id_user === 'PELAPOR' ? 'bi-person-circle' : 'bi-tools' }} me-1"></i>
                                {{ $log->id_user === 'PELAPOR' ? 'Pembuat Laporan' : 'Petugas IT (ID: '.$log->id_user.')' }}
                            </span>
                            <span class="text-muted" style="font-size: 0.75rem;">
                                {{ \Carbon\Carbon::parse($log->created_at)->format('d M Y, H:i') }}
                            </span>
                        </div>
                        <p class="mb-0 text-secondary small">{{ $log->deskripsi_penyelesaian }}</p>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="p-3 bg-white rounded-3 border text-center text-muted small">
                    <i class="bi bi-info-circle me-1"></i> Belum ada catatan pengerjaan dari Tim IT.
                </div>
                @endif
            </div>

            <!-- SECTION VERIFIKASI PENYELESAIAN OLEH PEMBUAT LAPORAN -->
            {{-- Logika: Hanya Tampil jika tgl_selesai_laporan sudah terisi --}}
            @if($laporan->tgl_selesai_laporan)
            <div class="pt-3 border-top">
                <div class="text-center mb-3">
                    <h6 class="fw-bold text-dark mb-1">
                        <i class="bi bi-patch-check-fill text-primary me-1"></i> Konfirmasi Penyelesaian
                    </h6>
                    <small class="text-muted">Tim IT telah menangani kendala Anda. Apakah masalah sudah tuntas?</small>
                </div>

                {{-- Jika tgl_verifikasi_laporan sudah terisi --}}
                @if($laporan->tgl_verifikasi_laporan)
                <div class="alert alert-success text-center mb-0 border-0 rounded-3 shadow-sm py-2">
                    <i class="bi bi-check-circle-fill me-1"></i> <strong>Laporan Telah Diverifikasi</strong>
                    <div class="small text-muted mt-1">
                        Diverifikasi Pada: {{ \Carbon\Carbon::parse($laporan->tgl_verifikasi_laporan)->format('d M Y, H:i') }} WIB
                    </div>
                </div>
                @else
                {{-- Form Verifikasi --}}
                <form id="formVerifikasi" action="{{ route('v3_verifikasi_penyelesaian', $laporan->tiket_laporan) }}" method="POST">
                    @csrf
                    <input type="hidden" name="status_verifikasi" id="statusVerifikasiVal">

                    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                        <button type="button" class="btn btn-submit px-4" onclick="konfirmasiVerifikasi('selesai')">
                            <i class="bi bi-check-lg me-1"></i> Ya, Sudah Selesai
                        </button>
                        <button type="button" class="btn btn-outline-danger border-2 rounded-3 px-4 fw-semibold" onclick="konfirmasiVerifikasi('belum')">
                            <i class="bi bi-x-lg me-1"></i> Masih Bermasalah
                        </button>
                    </div>
                </form>
                @endif
            </div>
            @else
            {{-- Info jika pengerjaan belum selesai --}}
            <div class="pt-3 border-top text-center text-muted small">
                <i class="bi bi-clock-history me-1"></i> Tombol konfirmasi penyelesaian akan otomatis aktif setelah Tim IT menyelesaikan penanganan laporan ini.
            </div>
            @endif

        </div>

        <div class="text-center mt-3 text-muted small">
            &copy; LogIT System Lapor
        </div>
    </div>

    <!-- MODAL BOOTSTRAP 5 UNTUK POP-UP PREVIEW GAMBAR -->
    @if($laporan->file)
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">
                <div class="modal-header border-0 pb-0">
                    <h6 class="modal-title text-muted" id="imageModalLabel"><i class="bi bi-image me-1"></i> {{ $laporan->file }}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-3">
                    <img src="{{ asset('storage/bukti_kasus/' . $laporan->file) }}"
                        class="img-fluid rounded-3"
                        style="max-height: 75vh; width: auto; object-fit: contain;"
                        alt="Bukti Kasus Full">
                </div>
                <div class="modal-footer border-0 pt-0 justify-content-center">
                    <a href="{{ asset('storage/bukti_kasus/' . $laporan->file) }}" target="_blank" class="btn btn-sm btn-light border text-primary rounded-pill px-3">
                        <i class="bi bi-box-arrow-up-right me-1"></i> Buka Ukuran Asli
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- JS Libraries (Urutan Disesuaikan) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            confirmButtonColor: '#5a9bd5',
            customClass: {
                popup: 'rounded-4'
            }
        });
        @endif

        @if(session('warning'))
        Swal.fire({
            icon: 'warning',
            title: 'Perhatian!',
            text: "{{ session('warning') }}",
            confirmButtonColor: '#5a9bd5',
            customClass: {
                popup: 'rounded-4'
            }
        });
        @endif

        // Function SweetAlert2 Confirm untuk Tombol Verifikasi
        function konfirmasiVerifikasi(status) {
            let titleText = '';
            let bodyText = '';
            let iconType = 'question';
            let btnColor = '#5a9bd5';
            let btnConfirmText = '';

            if (status === 'selesai') {
                titleText = 'Konfirmasi Penyelesaian';
                bodyText = 'Apakah Anda yakin kendala ini sudah tuntas seluruhnya?';
                iconType = 'success';
                btnColor = '#10b981';
                btnConfirmText = 'Ya, Sudah Tuntas!';
            } else {
                titleText = 'Masih Bermasalah?';
                bodyText = 'Laporan akan ditandai belum selesai dan tim IT akan menerima pemberitahuan ulang.';
                iconType = 'warning';
                btnColor = '#ef4444';
                btnConfirmText = 'Ya, Masih Bermasalah';
            }

            Swal.fire({
                title: titleText,
                text: bodyText,
                icon: iconType,
                showCancelButton: true,
                confirmButtonColor: btnColor,
                cancelButtonColor: '#94a3b8',
                confirmButtonText: btnConfirmText,
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-4'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#statusVerifikasiVal').val(status);
                    $('#formVerifikasi').submit();
                }
            });
        }
    </script>
</body>

</html>
