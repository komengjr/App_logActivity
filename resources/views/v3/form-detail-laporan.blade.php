<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <h4 class="fw-bold mb-1" style="color: #316bb3;">Laporan Pengecekan</h4>
        <p class="text-muted small mb-0">Logit System Checking..</p>
    </div>
    <button class="btn btn-sm btn-outline-secondary border-0" onclick="resetSearch()">
        <i class="bi bi-x-lg"></i>
    </button>
</div>

<div class="ticket-info-box">
    <div class="row align-items-center">
        <div class="col-9">
            <span class="badge bg-primary mb-2" id="displayTicketID">#{{ $data->tiket_laporan }}</span>
            <h6 class="mb-0 fw-bold">
                @if ($data->kategori_laporan == "ER-001")
                Kendala Pada Software
                @elseif ($data->kategori_laporan == "ER-002")
                Kendala Pada Hardware
                @else
                Ada Masalah
                @endif
            </h6>
            <small class="text-muted">Status: <strong>
                    @if ($data->tgl_respon_laporan == NULL)
                    <span class="text-danger">Tiket Belum direspon</span>
                    @elseif ($data->tgl_selesai_laporan == NULL)
                    <span class="text-warning">Tiket Sudah direspon</span>
                    @else
                    <span class="text-primary">Tiket Selesai</span>
                    @endif
                </strong></small>
        </div>
        <div class="col-3 text-end text-warning">
            <i class="bi bi-clipboard2-check" style="font-size: 1.8rem;"></i>
        </div>
    </div>
</div>

<form id="reportForm">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold small">Waktu Proses Tiket</label>
            <input type="datetime-local" class="form-control" value="{{ $data->tgl_respon_laporan }}">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold small">Waktu Proses Tiket</label>
            <input type="datetime-local" class="form-control" value="{{ $data->tgl_selesai_laporan }}">
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold small">Catatan Kendala</label>
        <textarea class="form-control" rows="3" placeholder="Apa temuan Anda di lokasi?" readonly>{{ $data->deskripsi_laporan }}</textarea>
    </div>

    <!-- <div class="mb-4">
        <label class="form-label fw-semibold small">Foto Bukti</label>
        <div class="upload-area" onclick="document.getElementById('fileUpload').click()">
            <i class="bi bi-camera text-muted mb-2 d-block" style="font-size: 1.5rem;"></i>
            <p class="mb-0 small text-muted">Ambil Gambar / Upload Foto</p>
            <input type="file" hidden id="fileUpload" accept="image/*">
        </div>
    </div>

    <div class="d-grid">
        <button type="submit" class="btn btn-submit">Kirim Laporan</button>
    </div> -->
</form>
