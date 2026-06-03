<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Form Case - Laporan Kendala User</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('asset/img/icons/shield.png') }}">
    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #e8f1fc, #ffffff);
            position: relative;
            overflow-x: hidden;
            padding: 20px 0;
        }

        /* Latar belakang animasi dari source sebelumnya */
        .background-animation {
            position: absolute;
            inset: 0;
            overflow: hidden;
            z-index: 0;
        }

        .bg-shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.3;
            animation: float 12s ease-in-out infinite;
        }

        .bg-shape:nth-child(1) {
            width: 300px;
            height: 300px;
            background: #a0d3ff;
            top: -50px;
            left: -50px;
        }

        .bg-shape:nth-child(2) {
            width: 250px;
            height: 250px;
            background: #f5cba7;
            bottom: -50px;
            right: -50px;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .wizard-card {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 1.5rem;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            padding: 2rem;
        }

        /* Stepper Style */
        .step-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            position: relative;
        }

        .step-header::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 2px;
            background: #e0e0e0;
            z-index: 1;
            transform: translateY(-50%);
        }

        .step-item {
            width: 40px;
            height: 40px;
            background: #fff;
            border: 2px solid #e0e0e0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
            font-weight: 600;
            transition: all 0.3s;
            color: #999;
        }

        .step-item.active {
            border-color: #5a9bd5;
            background: #5a9bd5;
            color: #fff;
            box-shadow: 0 0 15px rgba(90, 155, 213, 0.4);
        }

        .step-item.completed {
            border-color: #2ecc71;
            background: #2ecc71;
            color: #fff;
        }

        /* Form Steps Animation */
        .form-step {
            display: none;
            animation: fadeIn 0.5s ease;
        }

        .form-step-active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateX(10px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .btn-next {
            background-color: #5a9bd5;
            color: white;
            border: none;
        }

        .btn-prev {
            background-color: #6c757d;
            color: white;
            border: none;
        }

        .btn-submit {
            background-color: #2ecc71;
            color: white;
            border: none;
        }

        .form-label {
            font-weight: 600;
            color: #444;
        }

        .error-msg {
            color: #e74c3c;
            font-size: 0.8rem;
            margin-top: 4px;
            display: none;
        }

        .is-invalid {
            border-color: #e74c3c !important;
        }
    </style>
    <!-- Tambahkan di HEAD (setelah Bootstrap) -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* Penyesuaian agar tampilan Select2 cocok dengan Bootstrap 5 */
        .select2-container--default .select2-selection--single {
            height: 38px;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            padding-top: 5px;
        }

        .select2-container {
            width: 100% !important;
        }
    </style>


</head>

<body>
    <div class="background-animation">
        <div class="bg-shape"></div>
        <div class="bg-shape"></div>
    </div>

    <div class="wizard-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-0 fw-bold" style="color: #316bb3;">Form Lapran Kendala User</h4>
                <small class="text-muted">{{ date('d-m-Y H:i:s') }}</small>
            </div>
            <a href="{{ url('/login') }}" class="btn btn-dark"><i class="bi bi-arrow-left"></i> Back</a>
        </div>
        <!-- <h3 class="text-center mb-4" style="color: #316bb3; font-weight: 700;"><span class="badge bg-primary">/span></h3> -->

        <!-- Stepper -->
        <div class="step-header">
            <div class="step-item active" data-step="1">1</div>
            <div class="step-item" data-step="2">2</div>
            <div class="step-item" data-step="3">3</div>
        </div>

        <form id="wizardForm" novalidate method="POST">
            @csrf
            <!-- Step 1: Informasi Dasar -->
            <div class="form-step form-step-active">
                <h5 class="mb-3 text-info"><i class="bi bi-info-circle me-2"></i><strong>Informasi Pelapor & Cabang</strong></h5>
                <div class="mb-3">
                    <label class="form-label">Nama Pelapor</label>
                    <input type="text" class="form-control" name="nama_pelapor" placeholder="Masukkan Nama Pelapor" required>
                    <div class="error-msg">Nama Pelapor wajib diisi.</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">NIP</label>
                    <input type="text" class="form-control" name="nip" placeholder="Masukan NIP" required>
                    <div class="error-msg">NIP Wajib disi</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Divisi</label>
                    <input type="text" class="form-control" name="divisi" placeholder="Masukan Divisi" required>
                    <div class="error-msg">Divisi Wajib disi</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Pilih Cabang</label>
                    <select class="form-select select-search" name="cabang" id="cabang" required>
                        <option value="">Cari Cabang...</option>
                        @foreach ($data as $datas)
                        <option value="{{ $datas->kd_cabang }}">{{ $datas->nama_cabang }}</option>
                        @endforeach
                    </select>
                    <div class="error-msg">Silakan pilih Cabang.</div>
                </div>
                <div class="text-end mt-4">
                    <button type="button" class="btn btn-next px-4 py-2">Lanjut <i class="bi bi-arrow-right ms-1"></i></button>
                </div>
            </div>

            <!-- Step 2: Detail Teknis -->
            <div class="form-step">
                <h5 class="mb-3 text-info"><i class="bi bi-gear me-2"></i>Detail Laporan</h5>
                <div class="mb-3">
                    <label class="form-label">Tingkat Laporan</label>
                    <select class="form-select" name="tingkat_laporan" required>
                        <option value="">Pilih Tingkat Laporan...</option>
                        <option value="1">Rendah</option>
                        <option value="2">Sedang</option>
                        <option value="3">Tinggi</option>
                    </select>
                    <div class="error-msg">Tingkat Laporan wajib diisi.</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="kategori_laporan" class="form-control wizard-required" id="pilih_kategori" required>
                        <option value="">Pilih Kategori</option>
                        <option value="ER-001">Software</option>
                        <option value="ER-002">Hardware</option>
                    </select>
                    <div class="error-msg">Isi Kategori.</div>
                </div>
                <div id="data-kategori"></div>
                <div class="mb-3">
                    <label class="form-label">Catatan Tambahan</label>
                    <textarea class="form-control" name="catatan_laporan" rows="3" placeholder="Kondisi barang, dll..." required></textarea>
                    <div class="error-msg">Isi Pesan Tambahan.</div>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <!-- <button type="button" class="btn btn-prev px-4 py-2"><i class="bi bi-arrow-left me-1"></i> Kembali</button> -->
                    <button type="button" class="btn btn-next px-4 py-2">Lanjut <i class="bi bi-arrow-right ms-1"></i></button>
                </div>
            </div>

            <!-- Step 3: Konfirmasi -->
            <div class="form-step">
                <h5 class="mb-3 text-info"><i class="bi bi-check2-circle me-2"></i>Konfirmasi Penyimpanan</h5>
                <div class="alert alert-info border-0 shadow-sm">
                    <p class="small mb-0">Pastikan semua data yang Anda masukkan sudah benar sebelum menekan tombol simpan.</p>
                </div>
                <div class="mb-3">
                    <label class="form-label">No WHatsapp</label>
                    <input type="text" class="form-control" name="no_whatsapp" id="no_whatsapp" placeholder="Masukkan nomor Whatsapp" required>
                    <div class="error-msg">Nomor Whatsapp wajib diisi.</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email <small>Optional</small></label>
                    <input type="text" class="form-control" name="email" placeholder="0" required>
                    <div class="error-msg">Stok minimal 1.</div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-prev px-4 py-2"><i class="bi bi-arrow-left me-1"></i> Kembali</button>
                    <button type="submit" class="btn btn-submit px-4 py-2" id="btnSubmit">
                        <i class="bi bi-cloud-arrow-up me-1"></i> Simpan Data
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Tambahkan di paling bawah (setelah jQuery) -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inisialisasi Select2
            $('.select-search').select2({
                placeholder: "Ketik nama cabang...",
                allowClear: true
            });

            // FIX: Masalah Select2 hilang saat validasi/perpindahan step
            // Karena Select2 menyembunyikan element asli, kita perlu trigger ulang validasi
            $('.select-search').on('change', function() {
                if (this.checkValidity()) {
                    $(this).removeClass("is-invalid");
                    $(this).next('.select2-container').find('.select2-selection').css('border-color', '#dee2e6');
                    $(this).siblings(".error-msg").fadeOut();
                }
            });

            // ... sisanya adalah script wizard kamu yang sudah ada ...
        });
    </script>
    <script>
        $(document).ready(function() {
            let currentStep = 0;
            const steps = $(".form-step");
            const stepIcons = $(".step-item");


            // Fungsi Validasi Step
            function validateStep(stepIndex) {
                let valid = true;
                const inputs = steps.eq(stepIndex).find("input[required], select[required], textarea[required]");

                inputs.each(function() {
                    if (!this.checkValidity()) {
                        $(this).addClass("is-invalid");
                        $(this).siblings(".error-msg").fadeIn();
                        valid = false;
                    } else {
                        $(this).removeClass("is-invalid");
                        $(this).siblings(".error-msg").fadeOut();
                    }
                });
                return valid;
            }

            // Tombol Lanjut
            $(".btn-next").click(function() {
                if (validateStep(currentStep)) {
                    stepIcons.eq(currentStep).addClass("completed").removeClass("active");
                    currentStep++;
                    steps.removeClass("form-step-active");
                    steps.eq(currentStep).addClass("form-step-active");
                    stepIcons.eq(currentStep).addClass("active");
                }
            });

            // Tombol Kembali
            $(".btn-prev").click(function() {
                stepIcons.eq(currentStep).removeClass("active");
                currentStep--;
                steps.removeClass("form-step-active");
                steps.eq(currentStep).addClass("form-step-active");
                stepIcons.eq(currentStep).addClass("active").removeClass("completed");
            });



            // Real-time validation clear
            $("input, select").on("input change", function() {
                if (this.checkValidity()) {
                    $(this).removeClass("is-invalid");
                    $(this).siblings(".error-msg").fadeOut();
                }
            });
        });
        $(document).on("click", "#btnSubmit", function(e) {
            e.preventDefault();
            var nowhatsapp = document.getElementById('no_whatsapp').value;
            const btn = $("#btnSubmit");
            // Submit Akhir
            if (nowhatsapp == "") {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong!",
                    footer: "<a href=\"#\">Why do I have this issue?</a>"
                });
            } else {
                Swal.fire({
                    title: 'Apakah data sudah benar?',
                    text: "Data akan disimpan ke sistem Pelaporan.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#5a9bd5',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Simpan!',
                    cancelButtonText: 'Cek Kembali'
                }).then((result) => {
                    if (result.isConfirmed) {
                        btn.html('<span class="spinner-border spinner-border-sm me-2"></span>Menyimpan...');
                        btn.prop("disabled", true);
                        var data = $("#wizardForm").serialize();
                        // Simulasi Proses Ajax
                        $.ajax({
                            url: "{{ route('v3_case_save_data') }}",
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf"]').attr("content"),
                            },
                            type: "POST",
                            data: data,
                            dataType: "html",
                        }).done(function(data) {
                            if (data == 0) {
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Gagal Menyimpan Tiket Laporan , Coba lagi nanti!",
                                    footer: "<a href=\"#\">Why do I have this issue?</a>"
                                });
                            } else {
                                setTimeout(() => {
                                    Swal.fire('Berhasil!', 'Nomor Tiket '+ data +' telah dibuat. Pastikan No Tiket Ini disimpan', 'success').then(() => {
                                        location.reload();
                                    });
                                }, 2000);
                            }
                        }).fail(function() {
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: "Something went wrong!",
                                footer: "<a href=\"#\">Why do I have this issue?</a>"
                            });
                        });

                    }
                });

            }
        });
    </script>
    <script>
        $('#pilih_kategori').on("change", function() {
            var dataid = document.getElementById("pilih_kategori").value;
            var cabang = document.getElementById("cabang").value;
            if (dataid == "") {
                Lobibox.notify('warning', {
                    pauseDelayOnHover: true,
                    continueDelayOnInactiveTab: true,
                    position: 'top right',
                    icon: 'fas fa-info-circle',
                    msg: 'Pastikan Sudah dipilih'
                });
            } else {
                if (dataid == 'ER-001') {
                    $("#data-kategori").html("");
                } else {

                    $("#data-kategori").html('<span class="spinner-border spinner-border-sm me-2"></span>Mohon Menunggu...');
                    $.ajax({
                        url: "{{ route('v3_case_get_data') }}",
                        type: "POST",
                        cache: false,
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "code": dataid,
                            "cabang": cabang,
                        },
                        dataType: 'html',
                    }).done(function(data) {
                        $("#data-kategori").html(data);
                    }).fail(function() {
                        console.log('eror');
                    });
                }
            }
        });
    </script>
</body>

</html>
