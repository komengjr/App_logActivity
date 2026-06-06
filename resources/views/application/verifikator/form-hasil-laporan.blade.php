 <!-- <div class="d-flex justify-content-between align-items-center mb-3">
     <div class="badge bg-secondary p-2" id="infoRangeTerpilih">
     </div>
     <button type="button" onclick="resetFilter()" class="btn btn-sm btn-outline-secondary">
         <i class="bi bi-arrow-clockwise me-1"></i> Ganti Rentang Tanggal
     </button>
 </div> -->

 <div class="card mb-3 shadow-sm">
     <div class="card-header bg-primary py-3">
         <h5 class="mb-0 h6 fw-bold text-white">1. Data Rekam Cadangan (Backup Logs)</h5>
     </div>
     <div class="card-body">
         <div class="row g-3">
             <div class="col-lg-7">
                 <div class="card border border-danger">
                     <div class="card-header bg-danger">
                         <h6 class="fw-bold text-white mb-0"><i class="fas fa-clock-history me-1"></i> Log Backup Harian</h6>
                     </div>
                     <div class="card-body p-2">

                         <table class="table table-sm bg-white table-bordered align-middle mb-0 fs--2" id="table-backup-harian">
                             <thead class="bg-300">
                                 <tr>
                                     <td class="text-center">No</td>
                                     <td class="text-center">Verifikasi Backup</td>
                                     <td class="text-center">Sistem Backup</td>
                                     <td class="text-center">Proses Backup</td>
                                     <td class="text-center">Deskripsi</td>
                                 </tr>
                             </thead>
                             <tbody>
                                 @php
                                 $no = 1;
                                 @endphp
                                 @foreach ($backupharian as $item)
                                 <tr>
                                     <td>{{$no++}}</td>
                                     <td>{{$item->created_at }}</td>
                                     <td>{{$item->sistem_backup_harian }}</td>
                                     <td>{{$item->proses_backup_harian }}</td>
                                     <td class="text-justify">
                                         @php
                                         echo $item->deskripsi_backup_harian;
                                         @endphp
                                     </td>
                                 </tr>
                                 @endforeach
                             </tbody>
                         </table>

                     </div>
                 </div>
             </div>

             <div class="col-lg-5">
                 <div class="card border border-danger">
                     <div class="card-header bg-danger">
                         <h6 class="fw-bold text-white mb-0"><i class="fas fa-calendar-check me-1"></i> Log Backup Bulanan (Arsip)</h6>
                     </div>
                     <div class="card-body p-2">
                         <table class="table table-sm bg-white table-bordered align-middle mb-0 fs--2" id="table-backup-bulanan">
                             <thead>
                                 <tr>
                                     <td class="text-center">No</td>
                                     <td class="text-center">Bulan Backup</td>
                                     <td class="text-center">Tahun Backup</td>
                                     <td class="text-center">Deskripsi</td>
                                     <td class="text-center">Bukti</td>
                                 </tr>
                             </thead>
                             <tbody>
                                 @php
                                 $no = 1;
                                 @endphp
                                 @foreach ($backupbulanan as $item)
                                 <tr>
                                     <td>{{$no++}}</td>
                                     <td>{{$item->nama_backup_bulanan }}</td>
                                     <td>{{$item->tahun_backup_bulanan }}</td>
                                     <td>
                                         @php
                                         echo $item->deskripsi;
                                         @endphp
                                     </td>
                                     <td>
                                         <img src="data:image/png;base64, {{ base64_encode(file_get_contents(public_path('storage/screenshots/' . $item->screenshot))) }}" width="450">
                                     </td>
                                 </tr>
                                 @endforeach
                             </tbody>
                         </table>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <div class="card mb-3 shadow-sm">
     <div class="card-header text-white py-3 bg-primary">
         <h5 class="mb-0 h6 fw-bold text-white"><i class="bi bi-grid-3x3-gap me-2"></i>2. Laporan Log Kritis Harian (Hasil Pengukuran Fasilitas)</h5>
     </div>
     <div class="card-body p-0">
         <div class="table-responsive">
             <table class="table table-bordered table-hover table-matriks align-middle mb-0 text-center">
                 <thead class="text-white text-nowrap fs--2" style="background-color: #008b8b; border-color: #007e7e;">
                     <tr>
                         <th rowspan="2" class="align-middle" style="width: 60px;">No</th>
                         <th rowspan="2" class="text-start">Jenis Alat/Fasilitas</th>
                         <th colspan="{{ count($harimasuk) }}">Hasil Pengukuran</th>
                     </tr>
                     <tr style=" background-color: #007e7e;">
                         @foreach ($harimasuk as $datamasuk)
                         <th style="padding: 2px; font-size: 7px;">{{ date('d/m/Y', $datamasuk) }}</th>
                         @endforeach
                     </tr>
                 </thead>
                 <tbody class="fs--2">
                     @php
                     $no = 1;
                     @endphp
                     @foreach ($dataharian as $item)
                     <tr>
                         <td>{{ $no++ }}</td>
                         <td class="text-start">{{ $item->kinerja_sub }}</td>
                         @foreach ($harimasuk as $datamasuk1)
                         @php
                         $cekdata = DB::table('users_handler_record_log')
                         ->where('kd_kinerja_sub', $item->kd_kinerja_sub)
                         ->where('kd_cabang',Auth::user()->cabang)
                         ->where('tgl_record', date('Y-m-d', $datamasuk1))
                         ->first();
                         @endphp
                         @if ($cekdata)
                         <td style="text-align: center;font-size: 12px;">
                             <span class="badge bg-success-subtle text-success border border-success-subtle px-2">{{ $cekdata->ket_kinerja_sub }}</span>
                         </td>
                         @else
                         <td></td>
                         @endif
                         @endforeach

                     </tr>
                     @endforeach
                 </tbody>
             </table>
         </div>
     </div>
     <div class="card-footer bg-white small text-muted">
         <span class="me-3"><strong class="text-success">N</strong> = Normal</span>
         <span><strong class="text-danger">TN</strong> = Tidak Normal</span>
     </div>
 </div>

 <div class="card mb-3 shadow-sm">
     <div class="card-header bg-primary py-3">
         <h5 class="mb-0 h6 fw-bold text-white">3. Laporan Kendala User</h5>
     </div>
     <div class="card-body">
         <div class="table-responsive">
             <table class="table table-bordered table-hover align-middle fs--1" id="table-kendala-user">
                 <thead class="bg-300">
                     <tr>
                         <td class="text-center">No</td>
                         <td class="text-center">Tiket Laporan</td>
                         <td class="text-center">Nama Pelapor</td>
                         <td class="text-center">Kategori Laporan</td>
                         <td class="text-center">Deskripsi Masalah</td>
                         <td class="text-center">Tanggal Laporan</td>
                         <td class="text-center">Terima Laporan</td>
                         <td class="text-center">Tindakan Perbaikan</td>
                         <td class="text-center">Selesai Laporan</td>
                         <td class="text-center">Di Bawah 5 Menit</td>
                         <td class="text-center">Status Laporan</td>
                     </tr>
                 </thead>
                 <tbody>
                     @php
                     $no = 1;
                     @endphp
                     @foreach ($kendala as $item)
                     <tr>
                         <td>{{ $no++ }}</td>
                         <td>{{ $item->tiket_laporan }}</td>
                         <td>{{ $item->nama_user }}</td>
                         <td>
                             @if ($item->kategori_laporan == 'ER-001')
                             Software
                             @else
                             Hardware
                             @endif
                         </td>
                         <td>
                             @php
                             echo $item->deskripsi_laporan;
                             @endphp
                         </td>
                         <td>{{ $item->tgl_laporan }}</td>
                         <td>{{ $item->tgl_respon_laporan }}</td>
                         <td>
                             @php
                             $penyelesaian = DB::table('tbl_laporan_user_log')->where('tiket_laporan',$item->tiket_laporan)->first();
                             @endphp
                             @if ($penyelesaian)
                             @php
                             echo $penyelesaian->deskripsi_penyelesaian;
                             @endphp
                             @endif
                         </td>
                         <td>{{ $item->tgl_selesai_laporan }}</td>
                         <td><span class="badge bg-success">
                                 @php
                                 $dari = date_create($item->tgl_respon_laporan);
                                 $sampai = date_create($item->tgl_selesai_laporan);
                                 $diff = date_diff($dari, $sampai);
                                 echo $diff->format(' %H:%i:%s');
                                 @endphp

                                 {{-- {{$datamenit}} --}}
                             </span>
                         </td>
                         <td>
                             @if ($item->status_laporan == 2)
                             Selesai
                             @else
                             Belum Selesai
                             @endif
                         </td>
                     </tr>
                     @endforeach
                 </tbody>
             </table>
         </div>
     </div>
 </div>

 <div class="card mb-3 shadow-sm">
     <div class="card-header bg-white py-3 bg-primary">
         <h5 class="mb-0 h6 fw-bold text-white mb-0">4. Data Maintenance</h5>
     </div>
     <div class="card-body">
         <div class="table-responsive">
             <table class="table table-bordered table-hover align-middle">
                 <thead class="bg-300">
                     <tr>
                         <th>Server/Host</th>
                         <th>Aktivitas Perawatan</th>
                         <th>Waktu Pelaksanaan</th>
                         <th>Penanggung Jawab</th>
                         <th>Status Akhir</th>
                     </tr>
                 </thead>
                 <tbody>
                     <tr>
                         <td><strong>SRV-01</strong> (Main DB)</td>
                         <td>Optimasi Index & Clear Temporary Logs</td>
                         <td>06 Juni 2026, 01:00 WIB</td>
                         <td>Rian Aditia</td>
                         <td><span class="badge bg-success">Selesai</span></td>
                     </tr>
                     <tr>
                         <td><strong>SRV-05</strong> (Web Apps)</td>
                         <td>Security Patching Kernel OS</td>
                         <td>06 Juni 2026, 03:00 WIB</td>
                         <td>Rian Aditia</td>
                         <td><span class="badge bg-success">Selesai</span></td>
                     </tr>
                 </tbody>
             </table>
         </div>
     </div>
 </div>
 <script>
     new DataTable('#table-backup-harian', {
         responsive: true
     });
     new DataTable('#table-backup-bulanan', {
         responsive: true
     });
     new DataTable('#table-kendala-user', {
         responsive: true
     });
 </script>
