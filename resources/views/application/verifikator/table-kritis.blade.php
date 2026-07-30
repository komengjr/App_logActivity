<!-- Header Card dengan Tombol Print -->
<div class="card-header py-3 d-flex justify-content-between align-items-center" style="background-color: #008b8b;">

    <h5 class="mb-0 h6 fw-bold text-white"><i class="bi bi-grid-3x3-gap me-2"></i>2. Laporan Log Kritis Harian (Hasil Pengukuran Fasilitas)</h5>

    <button type="button" class="btn btn-light btn-sm fw-semibold shadow-sm" data-bs-toggle="modal" data-bs-target="#modal-log-it" id="button-print-laporan-kritis" data-start="{{ $start }}" data-end="{{ $end }}">
        <i class="bi bi-printer me-1"></i> Cetak Laporan
    </button>
</div>

<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-matriks align-middle mb-0 text-center" id="table-matriks-hasil">
            <thead class="text-white text-nowrap fs--2" style="background-color: #008b8b; border-color: #007e7e;">
                <tr>
                    <th rowspan="2" class="align-middle" style="width: 50px;">No</th>
                    <th rowspan="2" class="align-middle text-start">Jenis Alat/Fasilitas</th>
                    <th colspan="{{ count($harimasuk) }}">Hasil Pengukuran</th>
                </tr>
                <tr style="background-color: #007e7e;">
                    @foreach ($harimasuk as $datamasuk)
                    <th style="padding: 4px 2px; font-size: 10px;">{{ date('d/m/Y', $datamasuk) }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="fs--2">
                @foreach ($dataharian as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-start fw-semibold text-dark">{{ $item->kinerja_sub }}</td>

                    @foreach ($harimasuk as $datamasuk1)
                    @php
                    $cekdata = DB::table('users_handler_record_log')
                    ->where('kd_kinerja_sub', $item->kd_kinerja_sub)
                    ->where('kd_cabang', Auth::user()->cabang)
                    ->where('tgl_record', date('Y-m-d', $datamasuk1))
                    ->first();

                    $ket = $cekdata ? strtoupper(trim($cekdata->ket_kinerja_sub)) : null;
                    @endphp

                    <td style="text-align: center; font-size: 11px; min-width: 40px;">
                        @if ($ket === 'N')
                        <!-- Hasil N: Warna Hijau -->
                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2 fw-bold">N</span>
                        @elseif ($ket === 'TN')
                        <!-- Hasil TN: Warna Merah -->
                        <span class="badge text-danger border border-danger px-2 fw-bold">TN</span>
                        @elseif ($cekdata)
                        <!-- Hasil Lainnya jika ada -->
                        <span class="badge bg-secondary-subtle text-warning border border-warning px-2">{{ $cekdata->ket_kinerja_sub }}</span>
                        @else
                        <!-- Jika tidak ada data -->
                        <span class="text-muted">-</span>
                        @endif
                    </td>
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
