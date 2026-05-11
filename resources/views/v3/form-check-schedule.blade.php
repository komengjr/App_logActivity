<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Jadwal Piket | Inventaris Management System</title>
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
            overflow-x: hidden;
            position: relative;
            padding: 40px 0;
        }

        /* === Latar Belakang Animasi (Sama dengan Sebelumnya) === */
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
            animation-delay: 2s;
        }

        .bg-shape:nth-child(3) {
            width: 220px;
            height: 220px;
            background: #c8e6c9;
            top: 40%;
            left: 80%;
            animation-delay: 4s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) scale(1);
            }

            50% {
                transform: translateY(-20px) scale(1.05);
            }
        }

        /* === Container Utama === */
        .piket-container {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 600px;
            padding: 20px;
        }

        .main-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border-radius: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        /* === Item Kartu Jadwal dengan Border === */
        .piket-item {
            background: #ffffff;
            border-radius: 1rem;
            padding: 15px;
            margin-bottom: 15px;
            /* Border Tegas */
            border: 2px solid #eef2f7;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }

        .piket-item:hover {
            transform: scale(1.02);
            border-color: #5a9bd5;
            /* Border berubah warna saat hover */
            box-shadow: 0 5px 15px rgba(90, 155, 213, 0.1);
        }

        /* Border khusus untuk yang sedang bertugas hari ini */
        .piket-today {
            border-color: #5a9bd5;
            background: #f8fbff;
        }

        .profile-img {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
            border: 2px solid #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .piket-info h6 {
            margin: 0;
            font-weight: 600;
            color: #333;
        }

        .piket-info p {
            margin: 0;
            font-size: 0.85rem;
            color: #777;
        }

        .status-badge {
            margin-left: auto;
            padding: 5px 12px;
            border-radius: 30px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .bg-success-light {
            background: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #c8e6c9;
        }

        .bg-warning-light {
            background: #fffde7;
            color: #f9a825;
            border: 1px solid #fff9c4;
        }

        .btn-add {
            background: #5a9bd5;
            color: white;
            border: none;
            border-radius: 0.75rem;
            padding: 10px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-add:hover {
            background: #4689c4;
            transform: translateY(-2px);
        }
    </style>
</head>

<body>
    <!-- Latar Belakang Animasi -->
    <div class="background-animation">
        <div class="bg-shape"></div>
        <div class="bg-shape"></div>
        <div class="bg-shape"></div>
    </div>

    <div class="piket-container">
        <div class="main-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="mb-0 fw-bold" style="color: #316bb3;">Jadwal Piket</h4>
                    <small class="text-muted">{{ date('d-m-Y H:i:s') }}</small>
                </div>
                <a href="{{ url('/login') }}" class="btn btn-dark" ><i class="bi bi-arrow-left"></i> Back</a>
            </div>

            <!-- List Piket -->
            <div class="piket-list">
                <!-- User 1 -->
                <div class="piket-item piket-today">
                    <img src="https://i.pravatar.cc/150?u=1" class="profile-img" alt="User">
                    <div class="piket-info">
                        <h6>Siti Aminah</h6>
                        <p><i class="bi bi-calendar-event me-1"></i> Hari ini, 08 Mei</p>
                    </div>
                    <span class="status-badge bg-success-light">Aktif</span>
                </div>

                <!-- User 2 -->
                <div class="piket-item">
                    <img src="https://i.pravatar.cc/150?u=2" class="profile-img" alt="User">
                    <div class="piket-info">
                        <h6>Budi Santoso</h6>
                        <p><i class="bi bi-calendar-event me-1"></i> Besok, 09 Mei</p>
                    </div>
                    <span class="status-badge bg-warning-light">Mendatang</span>
                </div>

                <!-- User 3 -->
                <div class="piket-item">
                    <img src="https://i.pravatar.cc/150?u=3" class="profile-img" alt="User">
                    <div class="piket-info">
                        <h6>Intan Wijaya</h6>
                        <p><i class="bi bi-calendar-event me-1"></i> Minggu, 10 Mei</p>
                    </div>
                    <span class="status-badge bg-warning-light">Mendatang</span>
                </div>
            </div>

            <div class="text-center mt-3">
                <button class="btn btn-link text-decoration-none text-muted small">
                    <i class="bi bi-arrow-repeat me-1"></i> Refresh Jadwal
                </button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
