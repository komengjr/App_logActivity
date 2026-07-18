<link href="{{ asset('vendors/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
<div class="modal-body p-0">
    <div class="bg-primary rounded-top-lg py-3 ps-4 pe-6">
        <h4 class="mb-1" style="color: white;" id="staticBackdropLabel">Form Rencana Data Maintenance</h4>
        <p class="fs--2 mb-0" style="color: white;">Support by <a class="link-600 fw-semi-bold" href="#!">Transforma</a>
        </p>
    </div>
    <div class="p-3 pb-1" id="menu-add-data-pr-all">
        <div class="card mb-3 border border-1">
            <div class="card-body d-flex justify-content-between">
                <div>
                    <div class="row">
                        <div class="col-md-6">
                            <select id="kd_cabang" name="kd_cabang" class="form-select" required>
                                <option value="">-- Pilih Cabang --</option>
                                @foreach ($cabang as $cab)
                                <option value="{{ $cab->kd_cabang }}">{{ $cab->nama_cabang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select id="tahun_cabang" name="tahun_cabang" class="form-select" required>
                                <option value="">-- Pilih Tahun --</option>
                                <option value="2026">-- 2026 --</option>
                                <option value="2027">-- 2027 --</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="d-flex">

                    <div class="dropdown font-sans-serif">
                        <button class="btn btn-primary dropdown-toggle dropdown-caret-none ms-2" type="button" id="email-settings" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false">
                            <span class="fas fa-print"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="email-settings">
                            <a class="dropdown-item" href="#!">Coming Soon</a>
                            <div class="dropdown-divider">Pdf</div>
                            <a class="dropdown-item" href="#!" id="button-preview-rencana-tahunan">Rencana Tahunan</a>
                            <a class="dropdown-item" href="#!" id="button-preview-detail-barang">Rencana Detail Barang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div id="report-rencana-maintenance"></div>
        </div>
    </div>
</div>
<div class="modal-footer px-4 bg-300">

</div>
<script src="{{ asset('asset/js/flatpickr.js') }}"></script>
