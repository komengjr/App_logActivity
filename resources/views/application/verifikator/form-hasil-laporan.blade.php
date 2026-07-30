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
                                         @if ($item->screenshot == "")
                                         <span class="badge bg-danger">Kosong</span>
                                         @else
                                         <img src="data:image/png;base64, {{ base64_encode(file_get_contents(public_path('storage/screenshots/' . $item->screenshot))) }}" width="450">

                                         @endif
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

 <div class="card mb-3 shadow-sm" id="hasil-data-kritis">
     <div class="card-header text-white py-3 bg-primary">
         <h5 class="mb-0 h6 fw-bold text-white"><i class="bi bi-grid-3x3-gap me-2"></i>2. Laporan Log Kritis Harian (Hasil Pengukuran Fasilitas)</h5>
     </div>
     <div class="card-body p-0">
         <div class="table-responsive" >

         </div>
     </div>

 </div>
 <script>
     $('#hasil-data-kritis').html(
         '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
     );
     $.ajax({
         url: "{{ route('dashboard_verifikator_get_data_kritis') }}",
         type: "POST",
         cache: false,
         data: {
             "_token": "{{ csrf_token() }}",
             "awal": "{{ $start }}",
             "akhir": "{{ $end }}",
         },
         dataType: 'html',
     }).done(function(data) {
         $("#hasil-data-kritis").html(data);
     }).fail(function() {
         $('#hasil-data-kritis').html('eror');
     });
 </script>

 <div class="card mb-3 shadow-sm">
     <div class="card-header bg-primary py-3 d-flex justify-content-between align-items-center">
         <h5 class="mb-0 h6 fw-bold text-white">3. Laporan Kendala User</h5>
         <button type="button" class="btn btn-light btn-sm fw-semibold shadow-sm" onclick="printTableKendala()">
             <i class="bi bi-printer me-1"></i> Cetak Table
         </button>
     </div>
     <div class="card-body">
         <div class="table-responsive">
             <table class="table table-bordered table-hover align-middle fs--1" id="table-kendala-user">
                 <thead class="bg-300">
                     <tr>
                         <th class="text-center">No</th>
                         <th class="text-center">Tiket Laporan</th>
                         <th class="text-center">Nama Pelapor</th>
                         <th class="text-center">Kategori Laporan</th>
                         <th class="text-center">Deskripsi Masalah</th>
                         <th class="text-center">Tanggal Laporan</th>
                         <th class="text-center">Terima Laporan</th>
                         <th class="text-center">Tindakan Perbaikan</th>
                         <th class="text-center">Selesai Laporan</th>
                         <th class="text-center">Durasi (Respon - Selesai)</th>
                         <th class="text-center">Status Laporan</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($kendala as $index => $item)
                     <tr>
                         <td class="text-center">{{ $index + 1 }}</td>
                         <td>{{ $item->tiket_laporan }}</td>
                         <td>{{ $item->nama_user }}</td>
                         <td>
                             @if ($item->kategori_laporan == 'ER-001')
                             <span class="badge bg-info">Software</span>
                             @else
                             <span class="badge bg-warning text-dark">Hardware</span>
                             @endif
                         </td>
                         <td>

                             {!! $item->deskripsi_laporan !!}
                         </td>
                         <td>{{ $item->tgl_laporan }}</td>
                         <td>{{ $item->tgl_respon_laporan ?? '-' }}</td>
                         <td>
                             @php
                             // PERINGATAN: Mengambil data DB di dalam loop sangat membebani server (N+1 Query Issue).
                             // Sebaiknya ini dipindah ke Controller.
                             $penyelesaian = DB::table('tbl_laporan_user_log')
                             ->where('tiket_laporan', $item->tiket_laporan)
                             ->first();
                             @endphp

                             @if ($penyelesaian)
                             {!! $penyelesaian->deskripsi_penyelesaian !!}
                             @else
                             <span class="text-muted">-</span>
                             @endif
                         </td>
                         <td>{{ $item->tgl_selesai_laporan ?? '-' }}</td>
                         <td class="text-center">
                             {{-- Validasi agar tidak error jika tgl_respon atau tgl_selesai masih kosong --}}
                             @if($item->tgl_respon_laporan && $item->tgl_selesai_laporan)
                             @php
                             $dari = date_create($item->tgl_respon_laporan);
                             $sampai = date_create($item->tgl_selesai_laporan);
                             $diff = date_diff($dari, $sampai);
                             @endphp
                             <span class="badge bg-success">
                                 {{ $diff->format('%H:%i:%s') }}
                             </span>
                             @else
                             <span class="badge bg-secondary">Menunggu</span>
                             @endif
                         </td>
                         <td class="text-center">
                             @if ($item->status_laporan == 2)
                             <span class="badge bg-success">Selesai</span>
                             @else
                             <span class="badge bg-danger">Belum Selesai</span>
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
             <table class="table table-hover align-middle mb-0">
                 <thead class="table-dark">
                     <tr>
                         <th style="width: 4%;" class="text-center">No</th>
                         <th style="width: 26%;">Nama Barang / Perangkat</th>
                         <th style="width: 20%;">Spesifikasi & Lokasi</th>
                         <th style="width: 25%;">Sub Penilaian Komponen</th>
                         <th style="width: 10%;">Tgl Eksekusi</th>
                         <th style="width: 15%;">Tindakan</th>
                         <th style="width: 15%;">Action</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($brg as $brgs)
                     <tr>
                         <td class="text-center fw-bold">{{ $no++ }}</td>
                         <td>
                             <div class="fw-bold">{{ $brgs->m_rencana_detail_nama_brg }}</div>
                             <small class="text-muted">{{ $brgs->m_rencana_detail_id_brg }}</small>
                         </td>
                         @php
                         $log = DB::table('m_rencana_log')
                         ->where('m_rencana_detail_code',$brgs->m_rencana_detail_code)
                         ->first();
                         @endphp
                         <td>
                             @if ($log)
                             <strong class="text-success">{{ $log->m_rencana_log_loc }}</strong>
                             @else
                             <strong class="text-danger">Belum di lakukan</strong>
                             @endif
                         </td>
                         <td>
                             @if ($log)
                             @php
                             $hardware = DB::table('m_rencana_log_detail')
                             ->where('m_rencana_log_code',$log->m_rencana_log_code)
                             ->where('m_rencana_log_detail_cat','=','Hardware')
                             ->get();
                             $software = DB::table('m_rencana_log_detail')
                             ->where('m_rencana_log_code',$log->m_rencana_log_code)
                             ->where('m_rencana_log_detail_cat','=','Software')
                             ->get();
                             @endphp
                             <div class="d-flex flex-column gap-1 text-eval">
                                 <div class="d-flex justify-content-between align-items-center border-bottom pb-1">
                                     <span class="badge bg-primary"><i class="fas fa-cpu me-1"></i> Hardware</span>

                                 </div>
                                 @foreach ($hardware as $hard)

                                 <strong>{{$hard->m_rencana_log_detail_sub}}</strong>
                                 <p style="text-align: justify;">{{ $hard->m_rencana_log_detail_desc }}</p>

                                 @endforeach

                                 <div class="d-flex justify-content-between align-items-center">
                                     <span class="badge bg-primary"><i class="fas fa-terminal me-1"></i> Software/Firmware</span>
                                     <!-- <span class="badge bg-success"><i class="bi bi-check-circle-fill me-1"></i>Normal (v2.1)</span> -->
                                 </div>
                                 @foreach ($software as $soft)
                                 <strong>{{$soft->m_rencana_log_detail_sub}}</strong>
                                 <p style="text-align: justify;">{{ $soft->m_rencana_log_detail_desc }}</p>
                                 @endforeach
                             </div>
                             @endif
                         </td>
                         <td>
                             @if ($log)
                             <strong class="text-success">{{ $log->m_rencana_log_tgl_selesai }}</strong>
                             @else
                             <strong class="text-danger">Belum di lakukan</strong>
                             @endif
                         </td>
                         <td>
                             @if ($log)
                             <strong class="text-success">{{ $log->m_rencana_log_tipe }}</strong>
                             @else
                             <strong class="text-danger">Belum di lakukan</strong>
                             @endif
                         </td>
                         <td>
                             @if ($log)
                             <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-log-it" id="button-cetak-hasil-maintenance" data-code="{{ $brgs->m_rencana_detail_code }}" data-petugas="{{ $brgs->m_rencana_data_user }}">Cetak</button>
                             @else
                             <button class="btn btn-primary" disabled>Cetak</button>
                             @endif
                         </td>
                     </tr>
                     @endforeach
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
 <script>
     function printTableKendala() {
         // Ambil elemen HTML tabel
         let tableHtml = document.getElementById('table-kendala-user').outerHTML;

         // Buat window baru khusus untuk proses cetak
         let printWindow = window.open('', '_blank', 'width=1000,height=700');

         // Tulis dokumen HTML baru di window tersebut
         printWindow.document.write(`
        <!DOCTYPE html>
        <html>
        <head>
            <title>Laporan Kendala User</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
            <style>
                body {
                    font-family: Arial, sans-serif;
                    padding: 20px;
                }
                h4 {
                    text-align: center;
                    margin-bottom: 20px;
                    font-weight: bold;
                }
                table {
                    font-size: 11px !important;
                    width: 100%;
                    border-collapse: collapse;
                }
                th, td {
                    padding: 6px !important;
                    vertical-align: middle !important;
                }
                /* Pengaturan halaman kertas agar lanskap/mendatar */
                @page {
                    size: A4 landscape;
                    margin: 10mm;
                }
            </style>
        </head>
        <body>
            <h4>LAPORAN KENDALA USER</h4>
            ${tableHtml}
        </body>
        </html>
    `);

         printWindow.document.close();
         printWindow.focus();

         // Beri jeda 500ms agar style Bootstrap ter-load sempurna sebelum dialog print muncul
         setTimeout(function() {
             printWindow.print();
             printWindow.close();
         }, 500);
     }
 </script>
