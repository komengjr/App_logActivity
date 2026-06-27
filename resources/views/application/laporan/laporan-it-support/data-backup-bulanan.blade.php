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
                     <td>Deskripsi</td>
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
                     <td class="text-center">{{$item->nama_backup_bulanan }}</td>
                     <td class="text-center">{{$item->tahun_backup_bulanan }}</td>
                     <td>
                         @php
                         echo $item->deskripsi;
                         @endphp
                     </td>
                     <td class="text-center">
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
