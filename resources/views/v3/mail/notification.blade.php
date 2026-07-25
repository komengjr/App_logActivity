<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Tiket Bantuan</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f6f9;
            color: #334155;
            margin: 0;
            padding: 0;
        }

        .wrapper {
            max-width: 600px;
            margin: 0 auto;
            padding: 30px 15px;
        }

        .content {
            background: #ffffff;
            border-radius: 10px;
            padding: 35px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .header-logo {
            font-size: 18px;
            font-weight: bold;
            color: #2563eb;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
            border-bottom: 2px solid #f1f5f9;
            padding-bottom: 12px;
        }

        h2 {
            color: #1e293b;
            margin-top: 0;
            font-size: 22px;
        }

        p {
            font-size: 15px;
            line-height: 1.6;
            color: #475569;
        }

        .ticket-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }

        .ticket-table {
            width: 100%;
            border-collapse: collapse;
        }

        .ticket-table td {
            padding: 8px 0;
            font-size: 14px;
            color: #334155;
            vertical-align: top;
        }

        .ticket-table td.label {
            font-weight: bold;
            color: #64748b;
            width: 35%;
        }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            font-size: 12px;
            font-weight: bold;
            border-radius: 20px;
            text-align: center;
        }

        .badge-open {
            background-color: #fef3c7;
            color: #d97706;
        }

        .badge-progress {
            background-color: #e0f2fe;
            color: #0284c7;
        }

        .badge-resolved {
            background-color: #dcfce7;
            color: #16a34a;
        }

        .btn {
            background: #2563eb;
            color: #ffffff !important;
            padding: 12px 28px;
            text-decoration: none;
            border-radius: 6px;
            display: inline-block;
            margin: 20px 0 10px 0;
            font-weight: bold;
            font-size: 14px;
            box-shadow: 0 2px 4px rgba(37, 99, 235, 0.2);
        }

        .btn:hover {
            background: #1d4ed8;
        }

        .footer {
            font-size: 12px;
            color: #94a3b8;
            margin-top: 30px;
            text-align: center;
            border-top: 1px solid #f1f5f9;
            padding-top: 15px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="content">
            <div class="header-logo">
                🎫 Support Ticketing System
            </div>

            <h2>Halo, {{ $data['name'] }}!</h2>
            <p>{{ $data['messageContent'] }}</p>

            <!-- Box Informasi Detail Tiket -->
            <div class="ticket-box">
                <table class="ticket-table">
                    <tr>
                        <td class="label">ID Tiket</td>
                        <td>: <strong>#{{ $data['ticket_id'] ?? 'TCK-98214' }}</strong></td>
                    </tr>
                    <tr>
                        <td class="label">Kategori</td>
                        <td>: {{ $data['category'] ?? 'Kendala Teknis / Sistem' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Status Tiket</td>
                        <td>:
                            <span class="badge badge-progress">Sedang Diproses</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Waktu Dibuat</td>
                        <td>: {{ date('d M Y, H:i') }} WIB</td>
                    </tr>
                </table>
            </div>

            <p style="font-size: 14px; color: #64748b;">Tim support kami sedang meninjau laporan Anda dan akan segera memberikan pembaruan melalui sistem.</p>

            <div style="text-align: center;">
                <a href="{{ $data['url'] }}" class="btn">{{ $data['buttonText'] ?? 'Lihat Detail Tiket' }}</a>
            </div>

            <p style="margin-top: 25px; margin-bottom: 0;">Salam hangat,<br><strong>Tim Support Perusahaan</strong></p>

            <div class="footer">
                &copy; 2026 Laravel App. Seluruh hak cipta dilindungi.<br>
                Email ini dikirim secara otomatis, mohon tidak membalas langsung ke alamat ini.
            </div>
        </div>
    </div>
</body>

</html>
