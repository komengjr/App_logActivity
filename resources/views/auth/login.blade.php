<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login | LogIT System</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('asset/img/icons/shield.png') }}">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #e8f1fc, #ffffff);
            overflow: hidden;
            position: relative;
        }

        /* === Animated Background === */
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
            width: 180px;
            height: 180px;
            background: #a0d3ff;
            top: 10%;
            left: 5%;
            animation-delay: 0s;
        }

        .bg-shape:nth-child(2) {
            width: 250px;
            height: 250px;
            background: #f5cba7;
            bottom: 5%;
            right: 8%;
            animation-delay: 3s;
        }

        .bg-shape:nth-child(3) {
            width: 220px;
            height: 220px;
            background: #c8e6c9;
            top: 40%;
            left: 70%;
            animation-delay: 5s;
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

        .background-illustration {
            position: absolute;
            inset: 0;
            z-index: 1;
            background: url('https://pustaka.bca.co.id/Promo/A2C31A68-BC10-4CBD-AB51-85474A36CC50/Detail/ImageListing/20250723_PRAMITA-LAB-SBY-thumb.jpeg') center/cover no-repeat;
            opacity: 0.15;
            filter: blur(1px);
        }

        /* === Login Card === */
        .login-card {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border-radius: 1.5rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            max-width: 450px;
            width: 100%;
            padding: 1.5rem;
            margin: 1rem;
            animation: fadeInUp 1s ease forwards;
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-control {
            border-radius: 0.75rem;
            padding: 0.75rem;
            border-color: #d0d9e2;
        }

        /* === Button Styles === */
        .btn-primary {
            background-color: #5a9bd5;
            border: none;
            border-radius: 0.75rem;
            padding: 0.75rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(90, 155, 213, 0.4);
            background-color: #4689c4;
        }

        /* Custom Action Buttons Grid */
        .action-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 15px;
        }

        .btn-action {
            border: none;
            border-radius: 10px;
            padding: 10px;
            font-size: 0.85rem;
            font-weight: 600;
            color: white;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            opacity: 0.9;
            color: white;
        }

        .btn-new-case {
            background-color: #2ecc71;
        }

        .btn-laporan {
            background-color: #e67e22;
        }

        .btn-piket {
            background-color: #9b59b6;
            grid-column: span 2;
        }

        .footer-text {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.85rem;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="background-animation">
        <div class="bg-shape"></div>
        <div class="bg-shape"></div>
        <div class="bg-shape"></div>
    </div>

    <div class="background-illustration"></div>

    <div class="login-card">
        <div class="text-center mb-2">
            <!-- <img src="{{ asset('vendor/pramita.png') }}" alt="Logo" style="width: 100%; height: auto; max-width: 300px; display: block; margin: 0 auto;"> -->
            <p class="mt-2 mb-3 fw-bold text-secondary">LOGIN APLIKASI</p>
        </div>

        <span id="notifikasi-login"></span>

        <form id="loginForm">
            <div class="mb-3">
                <label for="username" class="form-label fw-semibold">Username</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-person"></i></span>
                    <input type="text" id="username" class="form-control border-start-0" placeholder="Username" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Kata Sandi</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock"></i></span>
                    <input type="password" id="password" class="form-control border-start-0" placeholder="Password" required>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="rememberMe">
                    <label for="rememberMe" class="form-check-label small">Ingat saya</label>
                </div>
            </div>

            <!-- Tombol Login Utama -->
            <button type="submit" class="btn btn-primary w-100 mb-3" id="button-login-system">
                <i class="bi bi-box-arrow-in-right me-2"></i>Masuk Sekarang
            </button>

            <hr class="text-muted opacity-25">

            <!-- Grid Tombol Tambahan -->
            <div class="action-grid">
                <a href="{{ route('v3_case') }}" class="btn-action btn-new-case text-decoration-none">
                    <i class="bi bi-plus-circle"></i> New Case
                </a>
                <a href="{{ route('v3_chek_laporan') }}" class="btn-action btn-laporan text-decoration-none">
                    <i class="bi bi-file-earmark-text"></i> Laporan
                </a>
                <a href="{{ route('v3_check_schedule') }}" class="btn-action btn-piket text-decoration-none">
                    <i class="bi bi-calendar-event"></i> Jadwal Piket
                </a>
            </div>
        </form>

        <div class="footer-text">
            <strong>Copyright © 2023</strong> <br>
            <small class="text-muted">LogIT Management System</small>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Logika Ajax tetap sama sesuai source asli Anda
        const form = document.getElementById('loginForm');
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value.trim();
            const btn = document.getElementById('button-login-system');

            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Memeriksa...';
            btn.disabled = true;

            $.ajax({
                url: "{{ route('verifikasi_Login') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "email": email,
                    "password": password
                },
                dataType: 'html',
            }).done(function(data) {
                $('#notifikasi-login').html(data);
                btn.innerHTML = '<i class="bi bi-box-arrow-in-right me-2"></i>Masuk Sekarang';
                btn.disabled = false;
            }).fail(function() {
                Swal.fire('Error', 'Terjadi kesalahan pada server', 'error');
                btn.innerHTML = '<i class="bi bi-box-arrow-in-right me-2"></i>Masuk Sekarang';
                btn.disabled = false;
            });
        });
    </script>
</body>

</html>
