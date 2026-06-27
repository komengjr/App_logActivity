 <div class="card mb-3 shadow-sm">
     <div class="card-header text-white py-3 bg-primary">
         <h5 class="mb-0 h5 fw-bold text-white"><i class="bi bi-grid-3x3-gap me-2"></i>Laporan Log Kritis Harian (Hasil Pengukuran Fasilitas)</h5>
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
                         ->where('kd_cabang',$datacabang->kd_cabang)
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
