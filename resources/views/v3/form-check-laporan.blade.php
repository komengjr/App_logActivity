<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Cek Tiket | LogIT System</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('asset/img/icons/shield.png') }}">
    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

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
            position: absolute;
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
            width: 200px;
            height: 200px;
            background: #a0d3ff;
            top: 5%;
            left: 5%;
        }

        .bg-shape:nth-child(2) {
            width: 280px;
            height: 280px;
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
            max-width: 650px;
            padding: 20px;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border-radius: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
            transition: all 0.5s ease;
        }

        /* === Search Section === */
        #searchSection {
            text-align: center;
        }

        .search-input-group {
            background: white;
            border: 2px solid #5a9bd5;
            border-radius: 1rem;
            padding: 5px;
            display: flex;
            margin-top: 2rem;
        }

        .search-input-group input {
            border: none;
            padding: 12px 20px;
            width: 100%;
            border-radius: 0.8rem;
            outline: none;
            font-size: 1.1rem;
        }

        .btn-search {
            background: #5a9bd5;
            color: white;
            border: none;
            padding: 0 25px;
            border-radius: 0.8rem;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-search:hover {
            background: #4689c4;
        }

        /* === Report Form (Hidden initially) === */
        #reportSection {
            display: none;
        }

        /* Info Box */
        .ticket-info-box {
            background: #f8fbff;
            border: 2px solid #e0e9f3;
            border-radius: 1rem;
            padding: 1.2rem;
            margin-bottom: 1.5rem;
        }

        .upload-area {
            border: 2px dashed #ccc;
            border-radius: 1rem;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            background: #fff;
        }

        .upload-area:hover {
            border-color: #5a9bd5;
            background: #f0f7ff;
        }

        .btn-submit {
            background-color: #5a9bd5;
            border: none;
            border-radius: 0.75rem;
            padding: 0.8rem;
            font-weight: 600;
            color: white;
        }
    </style>
</head>

<body>
    <div class="background-animation">
        <div class="bg-shape"></div>
        <div class="bg-shape"></div>
    </div>

    <div class="main-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <!-- <h4 class="mb-0 fw-bold" style="color: #316bb3;">Form Pencarian Tiket Laporan</h4>
                <small class="text-muted">Minggu ke-2 Mei 2026</small> -->
            </div>
            <a href="{{ url('/login') }}" class="btn btn-dark"><i class="bi bi-arrow-left"></i> Back</a>
        </div>
        <!-- SECTION 1: PENCARIAN -->
        <div id="searchSection" class="glass-card">
            <i class="bi bi-search text-primary mb-3" style="font-size: 3rem;"></i>
            <h4 class="fw-bold" style="color: #316bb3;">Cek Tiket Tugas</h4>
            <p class="text-muted">Masukkan nomor tiket untuk memulai laporan pengecekan</p>

            <div class="search-input-group">
                <input type="text" id="ticketNumber" placeholder="Contoh: TK-2026-001" autocomplete="off">
                <button class="btn-search" id="btnSearch">Cari</button>
            </div>
            <div id="searchMessage" class="mt-3 small text-danger" style="display:none;">Tiket tidak ditemukan!</div>
        </div>

        <!-- SECTION 2: FORM LAPORAN (Hidden) -->
        <div id="reportSection" class="glass-card">
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <h4 class="fw-bold mb-1" style="color: #316bb3;">Laporan Pengecekan</h4>
                    <p class="text-muted small mb-0">Lengkapi data laporan di bawah ini</p>
                </div>
                <button class="btn btn-sm btn-outline-secondary border-0" onclick="resetSearch()">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            <div class="ticket-info-box">
                <div class="row align-items-center">
                    <div class="col-9">
                        <span class="badge bg-primary mb-2" id="displayTicketID">#TK-2026-001</span>
                        <h6 class="mb-0 fw-bold">Pengecekan Server Utama</h6>
                        <small class="text-muted">Status: <strong>Dalam Pengerjaan</strong></small>
                    </div>
                    <div class="col-3 text-end text-primary">
                        <i class="bi bi-clipboard2-check" style="font-size: 1.8rem;"></i>
                    </div>
                </div>
            </div>

            <form id="reportForm">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold small">Kondisi Objek</label>
                        <select class="form-select" required>
                            <option value="">Pilih Kondisi...</option>
                            <option value="baik">Normal / Baik</option>
                            <option value="rusak">Rusak / Bermasalah</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold small">Waktu Selesai</label>
                        <input type="datetime-local" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold small">Catatan Temuan</label>
                    <textarea class="form-control" rows="3" placeholder="Apa temuan Anda di lokasi?" required></textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold small">Foto Bukti</label>
                    <div class="upload-area" onclick="document.getElementById('fileUpload').click()">
                        <i class="bi bi-camera text-muted mb-2 d-block" style="font-size: 1.5rem;"></i>
                        <p class="mb-0 small text-muted">Ambil Gambar / Upload Foto</p>
                        <input type="file" hidden id="fileUpload" accept="image/*">
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-submit">Kirim Laporan</button>
                </div>
            </form>
        </div>

    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Logika Pencarian
            $('#btnSearch').click(function() {
                const ticket = $('#ticketNumber').val().trim();

                if (ticket === "") {
                    Swal.fire('Opps', 'Masukkan nomor tiket dulu!', 'warning');
                    return;
                }

                // Efek Loading
                $(this).html('<span class="spinner-border spinner-border-sm"></span>');

                // Simulasi Cek Database (Ticket yang benar adalah TK-2026-001)
                setTimeout(() => {
                    if (ticket.toUpperCase() === "TK-2026-001") {
                        $('#displayTicketID').text('#' + ticket.toUpperCase());
                        $('#searchSection').fadeOut(300, function() {
                            $('#reportSection').fadeIn(500);
                        });
                    } else {
                        $('#btnSearch').html('Cari');
                        $('#searchMessage').show().delay(2000).fadeOut();
                    }
                }, 1200);
            });
        });

        // Balik ke pencarian
        function resetSearch() {
            $('#reportSection').fadeOut(300, function() {
                $('#searchSection').fadeIn(500);
                $('#btnSearch').html('Cari');
                $('#ticketNumber').val('');
            });
        }

        // Submit Form Laporan
        $('#reportForm').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Berhasil!',
                text: 'Laporan pengecekan telah terkirim.',
                icon: 'success',
                confirmButtonColor: '#5a9bd5'
            }).then(() => {
                resetSearch();
            });
        });
    </script>
</body>

</html>
