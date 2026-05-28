<link href="{{ asset('vendors/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />

<div class="modal-body p-0">
    <div class="bg-primary rounded-top-lg py-3 ps-4 pe-6">
        <h4 class="mb-1" style="color: white;" id="staticBackdropLabel">Proses Check in</h4>
        <p class="fs--2 mb-0" style="color: white;">Support by <a class="link-600 fw-semi-bold" href="#!">Transforma</a>
        </p>
    </div>
    <div class="p-3 pb-1" id="menu-add-data-pr-all">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <p class="text-danger" id="alert-notice">Lengkapi seluruh data dan sub-proses di bawah. Kotak proses akan otomatis hilang jika semua bagian diselesaikan.</p>
                @php
                $count = DB::table('users_handler_record_log')
                ->where('kd_cabang', $code)
                ->where('id_user', Auth::user()->id_user)
                ->where('tgl_record', date('Y-m-d'))
                ->where('ket_kinerja_sub','=','N')->count();
                $counts = DB::table('users_backup_harian')->where('tgl_backup_harian', date('Y-m-d'))->where('kd_cabang', $code)->count();
                @endphp
                <form id="processForm" novalidate>
                    <input type="text" name="data_code" id="data_code" value="{{ $code }}" hidden>
                    <div class="card mb-4 border border-warning main-process-card" id="prosesBackup">
                        <div class="card-header bg-300 d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 text-warning-emphasis"><i class="bi bi-database-fill-up me-2"></i>1. Backup Harian</h5>
                            <span class="badge bg-warning text-dark" id="backupStatusBadge">Menunggu Verifikasi</span>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">SISTEM</label>
                                    <select name="sistem_backup" class="form-control" id="sistem_backup"
                                        required>
                                        <option value="">Pilih Status</option>
                                        <option value="OK">OK</option>
                                        <option value="NOT OK">NOT OK</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="">PROSES BACK UP</label>
                                    <select name="proses_backup" class="form-control" id="proses_backup"
                                        required>
                                        <option value="">Pilih Status</option>
                                        <option value="OK">OK</option>
                                        <option value="NOT OK">NOT OK</option>
                                    </select>
                                </div>
                                <div class="invalid-feedback">Wajib mengisi Status.</div>
                            </div>

                            <div class="row g-3 p-1 pb-3 bg-light rounded border border-warning-subtle mb-4">
                                <div class="col-md-12">
                                    <label for="notesBackup" class="form-label fw-semibold small text-warning-emphasis">
                                        <i class="bi bi-pencil-square me-1"></i>Catatan / Keterangan Backup:
                                    </label>
                                    @php
                                    $data = DB::connection('second_db')
                                    ->table('log')
                                    ->where('logBranchCode', $code)
                                    ->Where('logDate','like', '%' . date('Y-m-d') . '%',)
                                    ->first();
                                    @endphp
                                    @if ($data)
                                    <textarea class="form-control" id="notesBackup" rows="10" placeholder="Masukkan detail atau pesan error...">@php echo $data->logMessage; @endphp </textarea>
                                    @else
                                    <textarea class="form-control" id="notesBackup" rows="6" placeholder="Masukkan detail atau pesan error..."></textarea>
                                    @endif
                                    <div class="invalid-feedback">Wajib mengisi Satatan Backup.</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-check-label" for="uploadCloud">Sinkronisasi Upload ke Cloud Storage</label>
                                    <input type="file" id="browseFile" class="form-control" />
                                </div>
                            </div>

                            <div class="progress" style="height: 20px">
                                <div class="progress-bar progress-bar-striped progress-bar-animated loading"
                                    role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                    style="width: 0%; height: 100%">0%</div>
                            </div>
                            <input id="link" type="text" name="link" class="form-control" hidden>
                            <!-- <span id="videoPreview"></span> -->
                            <img id="videoPreview" frameborder="0" style="width: 100%; height: 500px; display: none;">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end pt-3">
                                <button class="btn btn-warning fw-semibold text-dark" type="button" id="btnSelesaiBackup">
                                    <i class="bi bi-check-circle me-1"></i> Selesaikan Backup Harian
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4 border border-danger main-process-card" id="prosesLaporan">
                        <div class="card-header bg-300 bg-danger-subtle d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 text-danger-emphasis"><i class="bi bi-exclamation-triangle-fill me-2"></i>2. Laporan Kritis</h5>
                            <span class="badge bg-danger" id="laporanCounter">{{ $count }} / {{ $kritis->count() }} Selesai</span>
                        </div>
                        <div class="card-body">
                            <p class="small text-muted mb-3">*Pilih status <strong>"Selesai"</strong> pada setiap task di bawah.</p>

                            <div class="row g-3">
                                @foreach ($kritis as $krit)
                                @php
                                $cek = DB::table('users_handler_record_log')
                                ->where('kd_kinerja_sub', $krit->kd_kinerja_sub)
                                ->where('kd_cabang', $code)
                                ->where('id_user', Auth::user()->id_user)
                                ->where('tgl_record', date('Y-m-d'))->first();
                                @endphp
                                @if ($cek)
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small">Task : {{ $krit->kinerja_sub }}</label>
                                    <select class="form-select select-task-kritis" id="select-kinerja">
                                        <option value="{{$cek->ket_kinerja_sub}}|{{ $krit->kd_kinerja_sub }}" selected>{{$cek->ket_kinerja_sub}}</option>
                                        <option value="N|{{ $krit->kd_kinerja_sub }}">Normal ✅ </option>
                                        <option value="I|{{ $krit->kd_kinerja_sub }}">Intermenten</option>
                                        <option value="TN|{{ $krit->kd_kinerja_sub }}">Tidak Normal</option>
                                    </select>
                                </div>
                                @else
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small">Task : {{ $krit->kinerja_sub }}</label>
                                    <select class="form-select select-task-kritis" id="select-kinerja">
                                        <option value="" selected>-- Pilih Status --</option>
                                        <option value="N|{{ $krit->kd_kinerja_sub }}">Normal ✅ </option>
                                        <option value="I|{{ $krit->kd_kinerja_sub }}">Intermenten</option>
                                        <option value="TN|{{ $krit->kd_kinerja_sub }}">Tidak Normal</option>
                                    </select>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div id="allDoneMessage" class="alert alert-success text-center d-none" role="alert">
                        <h4 class="alert-heading"><i class="bi bi-check-circle-fill me-2"></i>Luar Biasa!</h4>
                        <p class="mb-0">Semua tugas harian dan laporan kritis berhasil diselesaikan dan dibersihkan.</p>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
<div class="modal-footer px-4 bg-300">

</div>
@php
$ids = mt_rand(100,999);
@endphp
<script>
    // ================= LOGIKA PROSES 1: BACKUP HARIAN =================
    const cardBackup<?php echo $ids; ?> = document.getElementById('prosesBackup');
    const btnSelesaiBackup<?php echo $ids; ?> = document.getElementById('btnSelesaiBackup');
    const checkboxesBackup<?php echo $ids; ?> = document.querySelectorAll('#prosesBackup .sub-process-check');
    const sistem_backup<?php echo $ids; ?> = document.getElementById('sistem_backup');
    const proses_backup<?php echo $ids; ?> = document.getElementById('proses_backup');
    const fileInput<?php echo $ids; ?> = document.getElementById('link');
    const textAreaInput<?php echo $ids; ?> = document.getElementById('notesBackup');
    const backupBadge<?php echo $ids; ?> = document.getElementById('backupStatusBadge');
    const cardLaporan<?php echo $ids; ?> = document.getElementById('prosesLaporan');
    const code<?php echo $ids; ?> = document.getElementById('data_code').value;
    if (<?php echo $count; ?> === <?php echo $kritis->count(); ?>) {
        hilangkanProses(cardLaporan<?php echo $ids; ?>);
    }
    if (<?php echo $counts ?> === 1) {
        hilangkanProses(cardBackup<?php echo $ids; ?>);
    }

    btnSelesaiBackup<?php echo $ids; ?>.addEventListener('click', function() {
        let isValid = true;



        // 1. Validasi Proses
        if (sistem_backup<?php echo $ids; ?>.value.trim() === "" || proses_backup<?php echo $ids; ?>.value.trim() === "") {
            Swal.fire('Gagal!', 'Proses Gagal dilakukan', 'error').then(() => {});
            sistem_backup<?php echo $ids; ?>.classList.add('is-invalid');
            proses_backup<?php echo $ids; ?>.classList.add('is-invalid');
            isValid = false;
        } else {
            sistem_backup<?php echo $ids; ?>.classList.remove('is-invalid');
            proses_backup<?php echo $ids; ?>.classList.remove('is-invalid');
        }

        // 2. Validasi File Upload
        if (fileInput<?php echo $ids; ?>.value.trim() === "") {
            Swal.fire('Gagal!', 'Proses Gagal dilakukan', 'error').then(() => {});
            fileInput<?php echo $ids; ?>.classList.add('is-invalid');
            isValid = false;
        } else {
            fileInput<?php echo $ids; ?>.classList.remove('is-invalid');
        }

        // 3. Validasi Text Area
        if (textAreaInput<?php echo $ids; ?>.value.trim() === "") {
            Swal.fire('Gagal!', 'Proses Gagal dilakukan', 'error').then(() => {});
            textAreaInput<?php echo $ids; ?>.classList.add('is-invalid');
            isValid = false;
        } else {
            textAreaInput<?php echo $ids; ?>.classList.remove('is-invalid');
        }

        // Jika semua syarat lolos validasi, hilangkan card proses backup harian
        if (isValid) {
            backupBadge<?php echo $ids; ?>.textContent = "Selesai ✅";
            backupBadge<?php echo $ids; ?>.className = "badge bg-success";
            Swal.fire('Berhasil!', 'Proses Berhasil dilakukan', 'success').then(() => {
                hilangkanProses(cardBackup<?php echo $ids ?>);
            });

            $.ajax({
                url: "{{ route('dashboard_check_in_proses_data_harian_save') }}",
                type: "POST",
                cache: false,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "code": code<?php echo $ids; ?>,
                    "sistem": sistem_backup<?php echo $ids; ?>.value.trim(),
                    "proses": proses_backup<?php echo $ids; ?>.value.trim(),
                    "desc": textAreaInput<?php echo $ids; ?>.value.trim(),
                    "file": fileInput<?php echo $ids; ?>.value.trim()
                },
                dataType: 'html',
            }).done(function(data) {
                Swal.fire('Berhasil!', 'Proses Berhasil dilakukan', 'success').then(() => {});
            }).fail(function() {
                Swal.fire('Gagal!', 'Proses Gagal dilakukan', 'error').then(() => {});
            });
        }
    });

    // Hapus border merah (is-invalid) saat user mulai mengisi inputan yang salah tadi
    fileInput<?php echo $ids; ?>.addEventListener('change', function() {
        if (this.value.trim() !== "") this.classList.remove('is-invalid');
    });
    textAreaInput<?php echo $ids; ?>.addEventListener('input', function() {
        if (this.value.trim() !== "") this.classList.remove('is-invalid');
    });


    // ================= LOGIKA PROSES 2: LAPORAN KRITIS =================
    const selectTasks<?php echo $ids; ?> = document.querySelectorAll('.select-task-kritis');
    const counterBadge<?php echo $ids; ?> = document.getElementById('laporanCounter');

    selectTasks<?php echo $ids; ?>.forEach(select => {
        select.addEventListener('change', function() {
            const rawValue = this.value; // Contoh hasil: "selesai|Kritis"

            if (rawValue !== "") {

                // MEMECAH 2 DATA VALUE
                const dataArray = rawValue.split('|');
                const status = dataArray[0]; // "selesai"
                const prioritas = dataArray[1]; // "Kritis"


                // Contoh Log di Console Browser untuk membuktikan data berhasil diambil terpisah
                console.log(`Dropdown Check -> Status: ${status}, Kode Kinerja: ${prioritas}`);

                $.ajax({
                    url: "{{ route('dashboard_check_in_proses_data_kritis') }}",
                    type: "POST",
                    cache: false,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "code": code<?php echo $ids; ?>,
                        "status": status,
                        "kinerja": prioritas
                    },
                    dataType: 'html',
                }).done(function(data) {
                    console.log('berhasil Input');
                }).fail(function() {
                    Swal.fire('Gagal!', 'Proses Gagal dilakukan', 'error').then(() => {});
                });
            }
            // Cek berapa task yang berstatus awal 'selesai'
            const completedTasks<?php echo $ids; ?> = Array.from(selectTasks<?php echo $ids; ?>).filter(s => {
                return s.value.split('|')[0] === 'N';
            }).length;

            counterBadge<?php echo $ids; ?>.textContent = `${completedTasks<?php echo $ids; ?>} / <?php echo $kritis->count(); ?> Selesai`;

            if (completedTasks<?php echo $ids; ?> === <?php echo $kritis->count(); ?>) {
                Swal.fire('Berhasil!', 'Proses Berhasil dilakukan', 'success').then(() => {
                    hilangkanProses(cardLaporan<?php echo $ids; ?>);
                });
            }
        });
    });


    // ================= FUNGSI PEMBANTU GLOBAL =================
    function hilangkanProses(element) {
        element.style.transition = 'all 0.5s ease';
        element.classList.add('opacity-0', 'text-muted');

        setTimeout(() => {
            element.remove();
            checkAllProcessFinished();
        }, 500);
    }

    function checkAllProcessFinished() {
        const remainingCards = document.querySelectorAll('.main-process-card');
        if (remainingCards.length === 0) {
            document.getElementById('allDoneMessage').classList.remove('d-none');
            document.getElementById('alert-notice').classList.add('d-none');
        }
    }
</script>
<script type="text/javascript">
    var browseFile = $('#browseFile');
    var resumable = new Resumable({
        target: "{{ route('dashboard_check_in_proses_data_harian_import') }}",
        query: {
            _token: '{{ csrf_token() }}',
            code: 123123,
        },
        fileType: ['jpg','png'],
        headers: {
            'Accept': 'application/json'
        },
        testChunks: false,
        throttleProgressCallbacks: 1,
    });

    resumable.assignBrowse(browseFile[0]);

    resumable.on('fileAdded', function(file) { // trigger when file picked
        showProgress();
        resumable.upload() // to actually start uploading.
    });

    resumable.on('fileProgress', function(file) { // trigger when file progress update
        updateProgress(Math.floor(file.progress() * 100));
    });

    resumable.on('fileSuccess', function(file, response) { // trigger when file upload complete
        response = JSON.parse(response)
        $('#videoPreview').show();
        $('#videoPreview').attr('src', response.path);
        $('#link').attr('value', response.filename);
        $('.card-footer').show();
        $('#browseFile').hide();
        $('#proses-selesai-upload').show();
    });

    resumable.on('fileError', function(file, response) { // trigger when there is any error
        alert('file uploading error.')
    });

    var progress = $('.progress');

    function showProgress() {
        progress.find('.loading').css('width', '0%');
        progress.find('.loading').html('0%');
        progress.find('.loading').removeClass('bg-info');
        progress.show();
    }

    function updateProgress(value) {
        progress.find('.loading').css('width', ` ${value}%`)
        progress.find('.loading').html(`${value}%`)
    }

    function hideProgress() {
        progress.hide();
    }
</script>
