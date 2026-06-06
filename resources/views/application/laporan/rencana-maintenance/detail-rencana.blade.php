<div class="alert alert-primary d-flex justify-content-between align-items-center mb-4 shadow-sm">
    <div>
        <i class="bi bi-info-circle-fill me-2"></i> Menampilkan Laporan Kerja Hasil Maintenance Perangkat:
    </div>
    <div>
        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal-log-it" id="button-cetak-rencana-maintenance" data-code="{{ $tahun }}">Cetak Rencana Maintenance</button>
    </div>
</div>

@foreach ($bulan as $bulans)
@php
$no = 1;
$brg = DB::table('m_rencana_detail')
->join('m_rencana_data', 'm_rencana_data.m_rencana_data_code', '=', 'm_rencana_detail.m_rencana_data_code')
->where('m_rencana_data.m_rencana_data_tahun', '=', $tahun)
->where('m_rencana_detail.m_rencana_detail_bulan', '=', $bulans->m_rencana_detail_bulan)
->get()
@endphp
<div class="card shadow-sm mb-4">
    <div class="card-header bulan-header py-3">
        <i class="fas fa-calendar-month me-2"></i><span class="badge bg-primary">{{ $bulans->m_rencana_detail_bulan }} </span><span class="badge bg-secondary ms-2">{{ $brg->count() }} Perangkat</span>
    </div>
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
                    ->where('m_rencana_log_id_brg',$brgs->m_rencana_detail_id_brg)
                    ->where('m_rencana_log_tahun',$tahun)
                    ->where('m_rencana_log_bulan',$bulans->m_rencana_detail_bulan)
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
                            <div class="d-flex justify-content-between align-items-center ms-2">
                                <span>{{ $soft->m_rencana_log_detail_sub }}</span>
                                <span class="badge bg-success"><i class="bi bi-check-circle-fill me-1"></i>{{ $soft->m_rencana_log_detail_desc }}</span>
                            </div>
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
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-log-it" id="button-cetak-hasil-maintenance" data-code="{{ $brgs->m_rencana_detail_code }}" data-petugas="{{ $petugas }}">Cetak</button>
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
@endforeach
