<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Login Portal</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background: #ffffff;
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }

        .login-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .input-group {
            margin-bottom: 1rem;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            color: #666;
            font-size: 0.9rem;
        }

        .input-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            outline: none;
            transition: border-color 0.3s;
        }

        .input-group input:focus {
            border-color: #764ba2;
        }

        .button-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 1.5rem;
        }

        .btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, opacity 0.3s;
            font-size: 0.85rem;
        }

        .btn:active {
            transform: scale(0.95);
        }

        .btn:hover {
            opacity: 0.9;
        }

        /* Tombol Utama (Login) */
        .btn-login {
            background-color: #764ba2;
            grid-column: span 2;
            /* Tombol login memenuhi lebar penuh */
            margin-bottom: 5px;
            font-size: 1rem;
        }

        /* Tombol Fitur */
        .btn-new-case {
            background-color: #2ecc71;
        }

        .btn-report {
            background-color: #e67e22;
        }

        .btn-schedule {
            background-color: #3498db;
        }

        .footer-text {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.8rem;
            color: #aaa;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <h2>Portal Sistem</h2>

        <form action="#">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" placeholder="Masukkan username" required>
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Masukkan password" required>
            </div>

            <button type="submit" class="btn btn-login">LOGIN</button>

            <div class="button-grid">
                <button type="button" class="btn btn-new-case">New Case</button>
                <button type="button" class="btn btn-report">Laporan</button>
                <button type="button" class="btn btn-schedule" style="grid-column: span 2;">Jadwal Piket</button>
            </div>
        </form>

        <div class="footer-text">
            &copy; 2026 Management System v1.0
        </div>
    </div>

</body>

</html>
