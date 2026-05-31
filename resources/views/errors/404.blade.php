<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: radial-gradient(circle at center, #1e1b4b 0%, #0f172a 100%);
            color: #f8fafc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .error-container {
            text-align: center;
            padding: 2rem;
            position: relative;
        }

        /* Efek Animasi Angka 404 */
        .error-code {
            font-size: clamp(8rem, 15vw, 12rem);
            font-weight: 800;
            line-height: 1;
            background: linear-gradient(135deg, #38bdf8 0%, #818cf8 50%, #c084fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: floating 3s ease-in-out infinite;
            filter: drop-shadow(0 10px 20px rgba(129, 140, 248, 0.3));
        }

        /* Efek Lingkaran Glow di Latar Belakang */
        .glow-bg {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 300px;
            height: 300px;
            background: rgba(99, 102, 241, 0.15);
            border-radius: 50%;
            filter: blur(80px);
            z-index: -1;
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        .error-title {
            font-weight: 600;
            font-size: 1.8rem;
            margin-top: 1rem;
            color: #e2e8f0;
        }

        .error-message {
            color: #94a3b8;
            max-width: 500px;
            margin: 0 auto 2rem auto;
            font-size: 1rem;
        }

        /* Desain Tombol Keren */
        .btn-custom {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            color: white;
            border: none;
            padding: 0.8rem 2rem;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.4);
        }

        .btn-custom:hover {
            background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.6);
        }

        .btn-outline-custom {
            color: #94a3b8;
            border: 2px solid #334155;
            padding: 0.8rem 2rem;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .btn-outline-custom:hover {
            color: #fff;
            border-color: #6366f1;
            background: rgba(99, 102, 241, 0.1);
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 error-container">
                <div class="glow-bg"></div>

                <h1 class="error-code">404</h1>

                <h2 class="error-title">Waduh, Kamu Tersesat?</h2>
                <p class="error-message">Halaman yang kamu cari tidak ada atau sudah dipindahkan ke tempat lain. Tenang, kamu bisa kembali ke jalan yang benar kok!</p>

                <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                    <a href="{{ route('dashboard_home') }}" class="btn btn-custom d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-house-door-fill"></i> Kembali ke Beranda
                    </a>
                    <a href="javascript:history.back()" class="btn btn-outline-custom d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-arrow-left"></i> Halaman Sebelumnya
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
