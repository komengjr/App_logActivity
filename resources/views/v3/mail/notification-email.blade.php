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
            font-size: 16px;
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
            font-size: 20px;
        }

        p {
            font-size: 14px;
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
            padding: 7px 0;
            font-size: 13px;
            color: #334155;
            vertical-align: top;
        }

        .ticket-table td.label {
            font-weight: bold;
            color: #64748b;
            width: 38%;
        }

        .badge {
            display: inline-block;
            padding: 3px 10px;
            font-size: 11px;
            font-weight: bold;
            border-radius: 20px;
            text-align: center;
        }

        .badge-status {
            background-color: #e0f2fe;
            color: #0284c7;
        }

        .badge-priority {
            background-color: #fee2e2;
            color: #dc2626;
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
                🎫 Sistem Pelaporan & Tiket User
            </div>

            <h2>Halo, {{ $data['name'] }}!</h2>
            <p>{{ $data['messageContent'] }}</p>

            <!-- Box Informasi Detail dari Database tbl_laporan_user -->
            <div class="ticket-box">
                <table class="ticket-table">
                    <tr>
                        <td class="label">No. Tiket</td>
                        <td>: <strong>#{{ $data['ticket_id'] }}</strong></td>
                    </tr>
                    <tr>
                        <td class="label">Kode Cabang</td>
                        <td>: {{ $data['kd_cabang'] }}</td>
                    </tr>
                    <tr>
                        <td class="label">Divisi / Bagian</td>
                        <td>: {{ $data['divisi'] }}</td>
                    </tr>
                    <tr>
                        <td class="label">Kategori Laporan</td>
                        <td>: {{ $data['category'] }}</td>
                    </tr>
                    <tr>
                        <td class="label">Tingkat / Prioritas</td>
                        <td>: <span class="badge badge-priority">{{ $data['priority'] }}</span></td>
                    </tr>
                    <tr>
                        <td class="label">Status Saat Ini</td>
                        <td>: <span class="badge badge-status">{{ $data['status'] }}</span></td>
                    </tr>
                    <tr>
                        <td class="label">Tanggal Laporan</td>
                        <td>: {{ $data['created_at'] }}</td>
                    </tr>
                </table>
            </div>

            <p style="font-size: 13px; color: #64748b;">Anda dapat memantau perkembangan penanganan laporan ini secara berkala melalui tombol di bawah.</p>

            <div style="text-align: center;">
                <a href="{{ $data['url'] }}" class="btn">{{ $data['buttonText'] }}</a>
            </div>

            <p style="margin-top: 25px; margin-bottom: 0;">Salam hangat,<br><strong>Tim Support & IT</strong></p>

            <div class="footer">
                &copy; 2026 Laravel App. Seluruh hak cipta dilindungi.<br>
                Pesan ini digenerate secara otomatis oleh sistem, mohon tidak membalas email ini.
            </div>
        </div>
    </div>
</body>

</html>
