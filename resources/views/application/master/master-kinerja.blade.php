@extends('layouts.template')
@section('base.css')

@endsection
@section('content')

<div class="card mb-3">
    <div class="card-body border-top">
        <div class="d-flex">
            <div class="flex-1">
                <h5 class="fw-bold text-dark"><i class="bi bi-calendar-week text-primary"></i>Master Data Kinerja</h5>
                <p class="text-muted mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit voluptatibus, ducimus ea ut ipsam laborum error doloribus consectetur! Quibusdam repudiandae animi atque consequuntur cum in? Necessitatibus deserunt quod sequi laudantium!</p>
            </div>
        </div>
    </div>
</div>
<!-- TABEL 1: RUTIN HARIAN -->
<div class="card p-4 mb-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold text-primary m-0">1. Kinerja Rutin Harian (Operasional & Monitoring)</h5>
        <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3">Frekuensi: Setiap Hari Kerja</span>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="th-harian text-center small">
                <tr>
                    <th style="width: 3%">No</th>
                    <th style="width: 30%">Indikator Kinerja Utama (KPI)</th>
                    <th style="width: 10%">Satuan</th>
                    <th style="width: 7%">Bobot</th>
                    <th style="width: 8%">Target</th>
                    <th style="width: 8%">Realisasi</th>
                    <th style="width: 8%">Skor Capaian</th>
                    <th style="width: 10%">Nilai Akhir</th>
                    <th style="width: 16%">Catatan / Bukti Kerja</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td><strong>Server & Network Availability</strong><br><small class="text-muted">Memastikan seluruh core server & switch perimeter tetap menyala.</small></td>
                    <td class="text-center"><span class="badge bg-light text-dark border">Uptime %</span></td>
                    <td class="text-center row-bobot">15%</td>
                    <td class="text-center">99.90%</td>
                    <td class="text-center">99.95%</td>
                    <td class="text-center row-skor">100.5%</td>
                    <td class="text-center fw-bold text-dark row-total">0</td>
                    <td><small class="text-muted">Melebihi target, sistem hanya down 15 menit selama sebulan.</small></td>
                </tr>
                <tr>
                    <td class="text-center">2</td>
                    <td><strong>Helpdesk Ticket Resolution Rate</strong><br><small class="text-muted">Penyelesaian kendala teknolog user harian sesuai SLA Level 1.</small></td>
                    <td class="text-center"><span class="badge bg-light text-dark border">Persentase</span></td>
                    <td class="text-center row-bobot">15%</td>
                    <td class="text-center">95.00%</td>
                    <td class="text-center">92.30%</td>
                    <td class="text-center row-skor">97.1%</td>
                    <td class="text-center fw-bold text-dark row-total">0</td>
                    <td><small class="text-muted">Ada 3 tiket tertunda karena menunggu sparepart vendor.</small></td>
                </tr>
                <tr>
                    <td class="text-center">3</td>
                    <td><strong>Daily Data Backup & Integrity Test</strong><br><small class="text-muted">Eksekusi backup harian ke NAS lokal dan Cloud Storage.</small></td>
                    <td class="text-center"><span class="badge bg-light text-dark border">Keberhasilan</span></td>
                    <td class="text-center row-bobot">10%</td>
                    <td class="text-center">100%</td>
                    <td class="text-center">100%</td>
                    <td class="text-center row-skor">100.0%</td>
                    <td class="text-center fw-bold text-dark row-total">0</td>
                    <td><small class="text-muted">Log harian lengkap, restorasi sampel data berhasil.</small></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- TABEL 2: RUTIN BULANAN -->
<div class="card p-4 mb-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold text-success m-0">2. Kinerja Rutin Bulanan (Preventive Maintenance & Report)</h5>
        <span class="badge bg-success-subtle text-success border border-success-subtle px-3">Frekuensi: 1-2 Kali Sebulan</span>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="th-bulanan text-center small">
                <tr>
                    <th style="width: 3%">No</th>
                    <th style="width: 30%">Indikator Kinerja Utama (KPI)</th>
                    <th style="width: 10%">Satuan</th>
                    <th style="width: 7%">Bobot</th>
                    <th style="width: 8%">Target</th>
                    <th style="width: 8%">Realisasi</th>
                    <th style="width: 8%">Skor Capaian</th>
                    <th style="width: 10%">Nilai Akhir</th>
                    <th style="width: 16%">Catatan / Bukti Kerja</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td><strong>Patching & Security Update Os Windows/Linux</strong><br><small class="text-muted">Pembaruan keamanan rutin di lingkungan server produksi.</small></td>
                    <td class="text-center"><span class="badge bg-light text-dark border">Siklus</span></td>
                    <td class="text-center row-bobot">15%</td>
                    <td class="text-center">1 Kali / Bln</td>
                    <td class="text-center">1 Kali / Bln</td>
                    <td class="text-center row-skor">100.0%</td>
                    <td class="text-center fw-bold text-dark row-total">0</td>
                    <td><small class="text-muted">Dilakukan setiap minggu ke-3 saat window time.</small></td>
                </tr>
                <tr>
                    <td class="text-center">2</td>
                    <td><strong>IT Capacity & Utilization Reporting</strong><br><small class="text-muted">Penyerahan laporan penggunaan bandwidth, ram, dan storage.</small></td>
                    <td class="text-center"><span class="badge bg-light text-dark border">Ketepatan Waktu</span></td>
                    <td class="text-center row-bobot">10%</td>
                    <td class="text-center">Maks Tgl 5</td>
                    <td class="text-center">Tgl 3</td>
                    <td class="text-center row-skor">110.0%</td>
                    <td class="text-center fw-bold text-dark row-total">0</td>
                    <td><small class="text-muted">Laporan dikirim lebih awal, data visualisasi sangat informatif.</small></td>
                </tr>
                <tr>
                    <td class="text-center">3</td>
                    <td><strong>User Privileges Access Audit</strong><br><small class="text-muted">Review berkala akun karyawan aktif, resign, atau mutasi.</small></td>
                    <td class="text-center"><span class="badge bg-light text-dark border">Akurasi Data</span></td>
                    <td class="text-center row-bobot">10%</td>
                    <td class="text-center">100% Cocok</td>
                    <td class="text-center">98.00%</td>
                    <td class="text-center row-skor">98.0%</td>
                    <td class="text-center fw-bold text-dark row-total">0</td>
                    <td><small class="text-muted">Ditemukan 2 akun mantan staf yang terlambat dinonaktifkan.</small></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- TABEL 3: TIDAK RUTIN -->
<div class="card p-4 mb-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold text-warning m-0" style="color: #b45309 !important;">3. Kinerja Tidak Rutin (Proyek Inovasi, Insidental & Ad-Hoc)</h5>
        <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-3" style="color: #b45309 !important;">Frekuensi: Kondisional / Project Based</span>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="th-tidak-rutin text-center small">
                <tr>
                    <th style="width: 3%">No</th>
                    <th style="width: 30%">Indikator Kinerja Utama (KPI)</th>
                    <th style="width: 10%">Satuan</th>
                    <th style="width: 7%">Bobot</th>
                    <th style="width: 8%">Target</th>
                    <th style="width: 8%">Realisasi</th>
                    <th style="width: 8%">Skor Capaian</th>
                    <th style="width: 10%">Nilai Akhir</th>
                    <th style="width: 16%">Catatan / Bukti Kerja</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td><strong>Cybersecurity Incident Handling (SLA-0)</strong><br><small class="text-muted">Kecepatan mitigasi saat ada indikasi serangan Malware/DDoS.</small></td>
                    <td class="text-center"><span class="badge bg-light text-dark border">Jam Tanggap</span></td>
                    <td class="text-center row-bobot">10%</td>
                    <td class="text-center">&lt; 2 Jam</td>
                    <td class="text-center">45 Menit</td>
                    <td class="text-center row-skor">120.0%</td>
                    <td class="text-center fw-bold text-dark row-total">0</td>
                    <td><small class="text-muted">Respon sangat cepat saat ransomware mencoba masuk ke cabang.</small></td>
                </tr>
                <tr>
                    <td class="text-center">2</td>
                    <td><strong>Migrasi Server On-Premise ke Cloud (AWS/Azure)</strong><br><small class="text-muted">Proyek strategis migrasi database ERP utama perusahaan.</small></td>
                    <td class="text-center"><span class="badge bg-light text-dark border">Timeline</span></td>
                    <td class="text-center row-bobot">10%</td>
                    <td class="text-center">Selesai Juni</td>
                    <td class="text-center">Selesai Mei</td>
                    <td class="text-center row-skor">115.0%</td>
                    <td class="text-center fw-bold text-dark row-total">0</td>
                    <td><small class="text-muted">Proyek selesai 3 minggu lebih cepat dari milestone awal.</small></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('base.js')

@endsection
