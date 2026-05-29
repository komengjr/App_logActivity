<div class="mb-3 d-flex justify-content-between align-items-center border-bottom pb-2">
    <span class="text-muted small">{{ $data->tiket_laporan }}</span>
    <span class="badge bg-success-subtle text-success px-3 py-1 rounded-pill">
        @if ($data->status_laporan == '0')
        <span class="badge bg-danger text-white px-3 py-2 rounded-pill">Belum</span>
        @elseif ($data->status_laporan == '1')
        <span class="badge bg-warning text-white px-3 py-2 rounded-pill">Proses</span>
        @elseif ($data->status_laporan == '2')
        <span class="badge bg-success text-white px-3 py-2 rounded-pill">Selesai</span>
        @endif
    </span>
</div>
<div class="mb-3">
    <label class="text-muted small d-block">Deskripsi Laporan</label>
    <span class="fw-bold text-dark fs-3">
        @php
        echo $data->deskripsi_laporan ;
        @endphp
    </span>
</div>
<div class="row g-3 mb-3">
    <div class="col-6">
        <label class="text-muted small d-block">Pembuat Laporan</label>
        <span class="fw-semibold"><span class="badge bg-light text-dark border">{{ $data->nama_user }}</span></span>
    </div>
    <div class="col-6">
        <label class="text-muted small d-block">Pelaksana Tugas</label>
        <span class="fw-semibold">
            @php
            $user = DB::table('tbl_biodata')->where('id_user',$data->id_user)->first();
            @endphp
            @if ($user)
            <span class="badge bg-light text-dark border">{{ $user->nama_lengkap }}</span>
            @endif
        </span>
    </div>
</div>
<hr class="text-muted opacity-25">
<div class="row g-3 mb-3">
    <div class="col-4">
        <label class="text-muted small d-block">Tgl Laporan</label>
        <span class="small fw-semibold">{{ $data->tgl_laporan }}</span>
    </div>
    <div class="col-4">
        <label class="text-muted small d-block">Tgl Diterima</label>
        <span class="small fw-semibold">{{ $data->tgl_respon_laporan }}</span>
    </div>
    <div class="col-4">
        <label class="text-muted small d-block">Tgl Selesai</label>
        <span class="small fw-semibold text-success">{{ $data->tgl_selesai_laporan }}</span>
    </div>
</div>
<div class="mb-0 bg-light p-3 rounded border">
    <label class="text-muted small d-block fw-bold mb-1">Solusi & Tindakan:</label>
    <p class="mb-0 text-secondary small-85">
        @php
        $log = DB::table('tbl_laporan_user_log')->where('tiket_laporan',$data->tiket_laporan)->first();
        @endphp
        @if ($log)
        @php
        echo $log->deskripsi_penyelesaian;
        @endphp
        @endif
    </p>
</div>
