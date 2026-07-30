<link href="{{ asset('vendors/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
<div class="modal-body p-0">
    <div class="bg-primary rounded-top-lg py-3 ps-4 pe-6">
        <h4 class="mb-1" style="color: white;" id="staticBackdropLabel">Form Report Kendala User</h4>
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
                            <a class="dropdown-item" href="#!" id="button-preview-laporan-user">Preview Laporan</a>
                            <!-- <a class="dropdown-item" href="#!" id="button-preview-backup-harian">Preview Laporan Harian</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div id="report-backup-harian">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <!-- Header & Filter Form -->
                    <div class="card-header bg-white py-3 border-bottom">
                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                            <h6 class="fw-bold mb-0 text-dark">
                                <i class="bi bi-list-stars me-2 text-primary"></i> Monitoring Laporan User
                            </h6>
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3">
                                Total: {{ count($laporans) }} Laporan
                            </span>
                        </div>

                        <!-- Section Input Filter -->
                        <div class="row g-2">
                            <!-- Filter Pencarian No. Tiket -->
                            <div class="col-12 col-md-3">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-light border-end-0 text-muted">
                                        <i class="fas fa-search"></i>
                                    </span>
                                    <input type="text"
                                        id="filter-tiket"
                                        class="form-control bg-light border-start-0"
                                        placeholder="Cari No. Tiket..."
                                        value="{{ request('search_tiket') }}">
                                </div>
                            </div>

                            <!-- Filter Rentang Tanggal (Mulai & Selesai) -->
                            <div class="col-12 col-md-3">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-light text-muted">Dari</span>
                                    <input type="date"
                                        id="filter-tgl-mulai"
                                        class="form-control bg-light"
                                        value="{{ request('tgl_mulai') ?? \Carbon\Carbon::now()->startOfMonth()->format('Y-m-d') }}">
                                </div>
                            </div>

                            <div class="col-12 col-md-3">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-light text-muted">Sampai</span>
                                    <input type="date"
                                        id="filter-tgl-selesai"
                                        class="form-control bg-light"
                                        value="{{ request('tgl_selesai') ?? \Carbon\Carbon::now()->endOfMonth()->format('Y-m-d') }}">
                                </div>
                            </div>

                            <!-- Filter Status -->
                            <div class="col-12 col-md-3">
                                <div class="input-group input-group-sm">
                                    <label class="input-group-text bg-light text-muted" for="filter-status">
                                        <i class="bi bi-funnel me-1"></i> Status
                                    </label>
                                    <select id="filter-status" class="form-select bg-light">
                                        <option value="all" {{ request('status_filter') == 'all' ? 'selected' : '' }}>Semua Status</option>
                                        <option value="belum_selesai" {{ request('status_filter') == 'belum_selesai' ? 'selected' : '' }}>Belum Selesai</option>
                                        <option value="sudah_selesai" {{ request('status_filter') == 'sudah_selesai' ? 'selected' : '' }}>Sudah Selesai</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Table Body -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 fs--2" style="font-size: 0.85rem;">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3 text-secondary text-uppercase" style="font-size: 0.72rem;">No. Tiket</th>
                                    <th class="text-secondary text-uppercase" style="font-size: 0.72rem;">Pelapor</th>
                                    <th class="text-secondary text-uppercase" style="font-size: 0.72rem; min-width: 200px;">Deskripsi Laporan</th>
                                    <th class="text-secondary text-uppercase" style="font-size: 0.72rem;">Kategori</th>
                                    <th class="text-secondary text-uppercase" style="font-size: 0.72rem;">Tingkat</th>
                                    <th class="text-secondary text-uppercase" style="font-size: 0.72rem;">Status</th>
                                    <th class="text-secondary text-uppercase" style="font-size: 0.72rem;">Tgl Lapor</th>
                                    <th class="text-secondary text-uppercase" style="font-size: 0.72rem;">Tgl Respon</th>
                                    <th class="text-secondary text-uppercase" style="font-size: 0.72rem;">Tgl Proses</th>
                                    <th class="text-secondary text-uppercase" style="font-size: 0.72rem;">Tgl Selesai IT</th>
                                    <th class="pe-3 text-secondary text-uppercase" style="font-size: 0.72rem;">Tgl Verifikasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($laporans as $laporan)
                                <tr>
                                    <!-- No. Tiket -->
                                    <td class="ps-3 fw-bold text-primary">
                                        #{{ $laporan->tiket_laporan }} <br>
                                        <small class="text-primary">{{ $laporan->no_hp }}</small>
                                        <small>{{ $laporan->email }}</small>
                                    </td>

                                    <!-- Pelapor -->
                                    <td>
                                        <div class="fw-semibold text-dark">{{ $laporan->nama_user }}</div>
                                        <small class="text-muted">{{ $laporan->divisi }} ({{ $laporan->nip_user }})</small><br>

                                    </td>

                                    <!-- Deskripsi Laporan -->
                                    <td>
                                        <div class="text-dark" style="max-width: 280px; white-space: normal; word-break: break-word;">
                                            {{ $laporan->deskripsi_laporan ?? '-' }}
                                        </div>
                                    </td>

                                    <!-- Kategori -->
                                    <td>
                                        @if($laporan->kategori_laporan == 'ER-000')
                                        <span class="badge bg-secondary-subtle text-secondary border rounded-pill">Security</span>
                                        @elseif($laporan->kategori_laporan == 'ER-001')
                                        <span class="badge bg-info-subtle text-info border border-info-subtle rounded-pill">Software</span>
                                        @elseif($laporan->kategori_laporan == 'ER-002')
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill">Hardware</span>
                                        @else
                                        <span class="badge bg-light text-dark border rounded-pill">{{ $laporan->kategori_laporan }}</span>
                                        @endif
                                    </td>

                                    <!-- Tingkat Penanganan -->
                                    <td>
                                        @if($laporan->tingkat_laporan == 1)
                                        <span class="text-success fw-semibold"><i class="bi bi-shield-check me-1"></i> Rendah</span>
                                        @elseif($laporan->tingkat_laporan == 2)
                                        <span class="text-warning fw-semibold"><i class="bi bi-exclamation-triangle me-1"></i> Sedang</span>
                                        @elseif($laporan->tingkat_laporan == 3)
                                        <span class="text-danger fw-bold"><i class="bi bi-exclamation-octagon me-1"></i> Tinggi</span>
                                        @else
                                        <span class="text-secondary">-</span>
                                        @endif
                                    </td>

                                    <!-- Status Laporan -->
                                    <td>
                                        @if(!empty($laporan->tgl_verifikasi_laporan) || $laporan->status_laporan == 'selesai')
                                        <span class="badge bg-success rounded-pill px-2 py-1">
                                            <i class="bi bi-check-circle-fill me-1"></i> Tiket Selesai
                                        </span>
                                        @elseif($laporan->status_laporan == '0')
                                        <span class="badge bg-danger rounded-pill px-2 py-1">
                                            <i class="bi bi-exclamation-circle-fill me-1"></i> Belum Direspon
                                        </span>
                                        @elseif($laporan->status_laporan == '1')
                                        <span class="badge bg-warning text-dark rounded-pill px-2 py-1">
                                            <i class="bi bi-hourglass-split me-1"></i> Sedang Diproses
                                        </span>
                                        @elseif($laporan->status_laporan == '2')
                                        <span class="badge bg-info text-dark rounded-pill px-2 py-1">
                                            <i class="bi bi-tools me-1"></i> Penyelesaian IT
                                        </span>
                                        @else
                                        <span class="badge bg-success rounded-pill px-2 py-1">
                                            <i class="bi bi-check-circle-fill me-1"></i> Tiket Selesai
                                        </span>
                                        @endif
                                    </td>

                                    <!-- Timeline Tanggal -->
                                    <td class="text-secondary small">
                                        {{ $laporan->tgl_laporan ? \Carbon\Carbon::parse($laporan->tgl_laporan)->format('d/m/Y H:i') : '-' }}
                                    </td>
                                    <td class="text-secondary small">
                                        {{ $laporan->tgl_respon_laporan ? \Carbon\Carbon::parse($laporan->tgl_respon_laporan)->format('d/m/Y H:i') : '-' }}
                                    </td>
                                    <td class="text-secondary small">
                                        {{ $laporan->tgl_proses_laporan ? \Carbon\Carbon::parse($laporan->tgl_proses_laporan)->format('d/m/Y H:i') : '-' }}
                                    </td>
                                    <td class="text-secondary small">
                                        {{ $laporan->tgl_selesai_laporan ? \Carbon\Carbon::parse($laporan->tgl_selesai_laporan)->format('d/m/Y H:i') : '-' }}
                                    </td>
                                    <td class="pe-3 fw-semibold text-success small">
                                        @if($laporan->tgl_verifikasi_laporan)
                                        <i class="bi bi-patch-check-fill me-1"></i>{{ \Carbon\Carbon::parse($laporan->tgl_verifikasi_laporan)->format('d/m/Y H:i') }}
                                        @else
                                        <span class="text-muted fw-normal">-</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="11" class="text-center py-4 text-muted">
                                        <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                        Tidak ada data laporan pada periode atau filter ini.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Script Event Trigger Filter -->
                <script>
                    window.filterTimer = window.filterTimer || null;

                    function reloadTableMonitoring() {
                        let searchTiket = $('#filter-tiket').val();
                        let tglMulai = $('#filter-tgl-mulai').val();
                        let tglSelesai = $('#filter-tgl-selesai').val();
                        let statusFilter = $('#filter-status').val();

                        $.ajax({
                            url: "{{ route('dashboard_monitoring_laporan_user') }}",
                            type: "POST",
                            cache: false,
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "code": '{{ Auth::user()->id_user }}',
                                "search_tiket": searchTiket,
                                "tgl_mulai": tglMulai,
                                "tgl_selesai": tglSelesai,
                                "status_filter": statusFilter
                            },
                            dataType: 'html'
                        }).done(function(data) {
                            $('#menu-template').html(data);

                            let inputSearch = $('#filter-tiket');
                            let val = inputSearch.val();
                            inputSearch.focus().val('').val(val);
                        }).fail(function() {
                            $('#menu-template').html('<div class="alert alert-danger text-center">Gagal memuat data.</div>');
                        });
                    }

                    $(document).off('keyup', '#filter-tiket').on('keyup', '#filter-tiket', function() {
                        clearTimeout(window.filterTimer);
                        window.filterTimer = setTimeout(reloadTableMonitoring, 500);
                    });

                    $(document).off('change', '#filter-tgl-mulai, #filter-tgl-selesai, #filter-status')
                        .on('change', '#filter-tgl-mulai, #filter-tgl-selesai, #filter-status', function() {
                            reloadTableMonitoring();
                        });
                </script>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer px-4 bg-300">

</div>
<script src="{{ asset('asset/js/flatpickr.js') }}"></script>
