<link href="{{ asset('vendors/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
<div class="modal-body p-0">
    <div class="bg-primary rounded-top-lg py-3 ps-4 pe-6">
        <h4 class="mb-1" style="color: white;" id="staticBackdropLabel">Form Report Monitoring Harian</h4>
        <p class="fs--2 mb-0" style="color: white;">Support by <a class="link-600 fw-semi-bold" href="#!">Transforma</a>
        </p>
    </div>
    <div class="p-3 pb-1" id="menu-add-data-pr-all">
        <div class="card mb-3 border border-1">
            <div class="card-body d-flex justify-content-between">
                <div>
                    <input class="form-control datetimepicker" name="tanggal_monitoring_harian" id="tanggal_monitoring_harian" type="text" placeholder="Y-m-d to Y-m-d" data-options='{"mode":"range","dateFormat":"Y-m-d","disableMobile":true}' />
                </div>
                <div class="d-flex">

                    <div class="dropdown font-sans-serif">
                        <button class="btn btn-primary dropdown-toggle dropdown-caret-none ms-2" type="button" id="email-settings" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false">
                            <span class="fas fa-print"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="email-settings">
                            <a class="dropdown-item" href="#!">Coming Soon</a>
                            <div class="dropdown-divider">Pdf</div>
                            <a class="dropdown-item" href="#!" id="button-preview-backup-harian-kritis">Preview Backup Kritis</a>
                            <a class="dropdown-item" href="#!" id="button-preview-backup-harian">Preview Laporan Harian</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div id="report-backup-harian"></div>
        </div>
    </div>
</div>
<div class="modal-footer px-4 bg-300">

</div>
<script src="{{ asset('asset/js/flatpickr.js') }}"></script>
