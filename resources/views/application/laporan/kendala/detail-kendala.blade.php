@php
// Menentukan apakah data berasal dari Security atau User
$isSecurity = isset($data->laporan_security_code);

// Dynamic Field Mapping
$tiket = $isSecurity ? $data->laporan_security_code : $data->tiket_laporan;
$status = $isSecurity ? $data->laporan_security_status : $data->status_laporan;
$deskripsi = $isSecurity ? $data->laporan_security_desc : $data->deskripsi_laporan;
$namaUser = $isSecurity ? $data->laporan_security_user : $data->nama_user;
$idUser = $isSecurity ? $data->laporan_security_it : $data->id_user;
$tglLaporan = $isSecurity ? $data->laporan_security_date : $data->tgl_laporan;
$tglRespon = $isSecurity ? $data->laporan_security_respon : $data->tgl_respon_laporan;
$tglProses = $isSecurity ? ($data->laporan_security_proses ?? null) : ($data->tgl_proses_laporan ?? null);
$tglSelesai = $isSecurity ? $data->laporan_security_selesai : $data->tgl_selesai_laporan;
$tglVerifikasi = $isSecurity ? null : ($data->tgl_verifikasi_laporan ?? null); // Khusus user / disesuaikan

// Ambil data Pelaksana Tugas (IT)
$user = DB::table('tbl_biodata')->where('id_user', $idUser)->first();

// Ambil Log Solusi
if ($isSecurity) {
$log = DB::table('tbl_laporan_security_log')->where('laporan_security_code', $tiket)->first();
} else {
$log = DB::table('tbl_laporan_user_log')->where('tiket_laporan', $tiket)->first();
}
@endphp

<style>
    /* Style Timeline Progress Step */
    .timeline-steps {
        display: flex;
        justify-content: space-between;
        position: relative;
    }

    .timeline-steps::before {
        content: "";
        position: absolute;
        top: 18px;
        left: 10%;
        right: 10%;
        height: 3px;
        background-color: #e9ecef;
        z-index: 1;
    }

    .timeline-step {
        position: relative;
        z-index: 2;
        text-align: center;
        flex: 1;
    }

    .timeline-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background-color: #e9ecef;
        color: #6c757d;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 8px;
        font-size: 14px;
        border: 2px solid #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    /* Step Active & Completed */
    .timeline-step.completed .timeline-icon {
        background-color: #198754;
        color: #fff;
    }

    .timeline-step.active .timeline-icon {
        background-color: #0d6efd;
        color: #fff;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.25);
    }

    .timeline-step.pending .timeline-icon {
        background-color: #f8f9fa;
        color: #adb5bd;
        border-color: #dee2e6;
    }
</style>

<!-- Header Tiket & Status Badge -->
<div class="mb-3 d-flex justify-content-between align-items-center border-bottom pb-2">
    <div>
        <span class="text-muted small fw-bold me-2">{{ $tiket }}</span>
        @if ($isSecurity)
        <span class="badge bg-warning text-dark border border-warning px-2 py-1 rounded-pill">
            <i class="fas fa-shield-alt me-1"></i>SECURITY
        </span>
        @else
        <span class="badge bg-primary text-white px-2 py-1 rounded-pill">
            <i class="fas fa-user me-1"></i>USER
        </span>
        @endif
    </div>

    <div>
        @if ($status == '0' || $status == 'Belum')
        <span class="badge bg-danger text-white px-3 py-2 rounded-pill">Belum Diproses</span>
        @elseif ($status == '1' || $status == 'Proses')
        <span class="badge bg-warning text-white px-3 py-2 rounded-pill">Sedang Diproses</span>
        @elseif ($status == '2' || $status == 'Selesai')
        <span class="badge bg-success text-white px-3 py-2 rounded-pill">Selesai</span>
        @else
        <span class="badge bg-secondary text-white px-3 py-2 rounded-pill">{{ $status }}</span>
        @endif
    </div>
</div>

<!-- Deskripsi Laporan -->
<div class="mb-3">
    <label class="text-muted small d-block">Deskripsi Laporan</label>
    <div class="fw-bold text-dark fs-3">
        {!! $deskripsi !!}
    </div>
</div>

<!-- Pembuat & Pelaksana -->
<div class="row g-3 mb-4">
    <div class="col-6">
        <label class="text-muted small d-block">Pembuat Laporan</label>
        <span class="fw-semibold">
            <span class="badge bg-light text-dark border">{{ $namaUser ?? '-' }}</span>
        </span>
    </div>
    <div class="col-6">
        <label class="text-muted small d-block">Pelaksana Tugas (IT)</label>
        <span class="fw-semibold">
            @if ($user)
            <span class="badge bg-light text-dark border">{{ $user->nama_lengkap }}</span>
            @else
            <span class="badge bg-light text-muted border">- Belum Ada -</span>
            @endif
        </span>
    </div>
</div>

<!-- Section Timeline Progress Pengerjaan -->
<div class="card bg-light border-0 mb-4">
    <div class="card-body p-3">
        <label class="text-muted small fw-bold d-block mb-3">
            <i class="fas fa-tasks me-1 text-primary"></i> Timeline Progress Pengerjaan
        </label>

        <div class="timeline-steps">
            <!-- Step 1: Laporan Dibuat -->
            <div class="timeline-step {{ $tglLaporan ? 'completed' : 'pending' }}">
                <div class="timeline-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="fw-bold small text-dark">Laporan Dibuat</div>
                <div class="text-muted extra-small" style="font-size: 11px;">{{ $tglLaporan ?? '-' }}</div>
            </div>

            <!-- Step 2: Diterima / Respon -->
            <div class="timeline-step {{ $tglRespon ? 'completed' : ($tglLaporan ? 'active' : 'pending') }}">
                <div class="timeline-icon">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="fw-bold small text-dark">Diterima</div>
                <div class="text-muted extra-small" style="font-size: 11px;">{{ $tglRespon ?? '-' }}</div>
            </div>

            <!-- Step 3: Diproses -->
            <div class="timeline-step {{ $tglProses ? 'completed' : ($tglRespon ? 'active' : 'pending') }}">
                <div class="timeline-icon">
                    <i class="fas fa-cogs"></i>
                </div>
                <div class="fw-bold small text-dark">Diproses</div>
                <div class="text-muted extra-small" style="font-size: 11px;">{{ $tglProses ?? '-' }}</div>
            </div>

            <!-- Step 4: Selesai IT -->
            <div class="timeline-step {{ $tglSelesai ? 'completed' : ($tglProses ? 'active' : 'pending') }}">
                <div class="timeline-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="fw-bold small text-dark">Selesai IT</div>
                <div class="text-muted extra-small" style="font-size: 11px;">{{ $tglSelesai ?? '-' }}</div>
            </div>

            <!-- Step 5: Diverifikasi Pembuat -->
            <div class="timeline-step {{ $tglVerifikasi ? 'completed' : ($tglSelesai ? 'active' : 'pending') }}">
                <div class="timeline-icon">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="fw-bold small text-dark">Diverifikasi</div>
                <div class="text-muted extra-small" style="font-size: 11px;">{{ $tglVerifikasi ?? '-' }}</div>
            </div>
        </div>
    </div>
</div>

<!-- Solusi & Catatan Tindakan -->
<div class="mb-0 bg-light p-3 rounded border">
    <label class="text-muted small d-block fw-bold mb-1">Solusi & Tindakan:</label>
    <div class="mb-0 text-secondary small-85">
        @if ($log && isset($log->deskripsi_penyelesaian))
        {!! $log->deskripsi_penyelesaian !!}
        @else
        <em class="text-muted">Belum ada catatan penyelesaian/solusi.</em>
        @endif
    </div>
</div>
