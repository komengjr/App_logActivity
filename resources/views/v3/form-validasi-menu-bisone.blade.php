<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Validasi BISONE</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7f9;
            font-family: 'Segoe UI', sans-serif;
        }

        .main-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            background: white;
        }

        .header-section {
            background: #1e3a8a;
            color: white;
            border-radius: 15px 15px 0 0;
            padding: 20px;
        }

        .legend-box {
            background: #eff6ff;
            border-left: 4px solid #3b82f6;
            padding: 15px;
            border-radius: 8px;
            font-size: 0.9rem;
        }

        .section-title {
            background: #e2e8f0;
            font-weight: bold;
        }

        .desc-text {
            font-size: 0.8rem;
            font-weight: 600;
            display: block;
        }

        .sig-container {
            border: 1px dashed #cbd5e1;
            background: #f8fafc;
            border-radius: 6px;
            padding: 6px;
            position: relative;
            min-width: 150px;
        }

        .sig-canvas {
            border: 1px solid #e2e8f0;
            background: #ffffff;
            border-radius: 4px;
            cursor: crosshair;
            width: 100%;
            height: 75px;
        }

        .btn-clear-sig {
            font-size: 0.65rem;
            padding: 1px 4px;
            position: absolute;
            right: 10px;
            bottom: 10px;
        }

        pre {
            background-color: #1e1e2e;
            color: #a6adc8;
            padding: 15px;
            border-radius: 8px;
            max-height: 400px;
            overflow-y: auto;
        }

        /* Animasi Transisi Menghilangkan Baris */
        .fade-out {
            opacity: 0;
            transform: translateX(20px);
            transition: all 0.5s ease-out;
        }
    </style>
</head>

<body>

    <div class="container py-5">
        <div id="view-form" class="main-card">
            <div class="header-section d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-0" id="form-title">FORM VALIDASI</h4>
                    <p class="mb-0 small" id="form-subtitle"></p>
                </div>
            </div>
            <div class="p-4">
                <div class="legend-box mb-4">
                    <h6 class="fw-bold"><i class="bi bi-info-circle"></i> Status Kesiapan Menu:</h6>
                    <div class="row">
                        <div class="col-md-6">0: Belum ada | 1: Tidak bisa (Mayor) | 2: Bisa (Minor)</div>
                        <div class="col-md-6">3: Perlu Sedikit Improvement | 4: Siap Digunakan</div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="text-center table-dark">
                            <tr>
                                <th width="4%">No</th>
                                <th width="20%">Menu / Fitur</th>
                                <th width="12%">Skala (0-4)</th>
                                <th width="22%">Keterangan & Catatan</th>
                                <th width="16%">Verifikator (Nama & TTD)</th>
                                <th width="16%">Validator (Nama & TTD)</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="content-tabel"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="jsonModal" tabindex="-1" aria-labelledby="jsonModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="jsonModalLabel"><i class="bi bi-code-slash text-warning"></i> Data JSON Baris Disimpan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="small text-muted">Berikut adalah data terformat JSON dari baris yang baru saja Anda simpan:</p>
                    <pre><code id="json-renderer"></code></pre>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const dataA = @json($menu);

        const statusDescriptions = {
            "0": {
                text: "Belum ada aplikasi",
                color: "text-danger"
            },
            "1": {
                text: "Belum bisa digunakan (Mayor)",
                color: "text-danger"
            },
            "2": {
                text: "Bisa digunakan (Minor)",
                color: "text-warning"
            },
            "3": {
                text: "Bisa digunakan, butuh improvement",
                color: "text-primary"
            },
            "4": {
                text: "Aplikasi siap digunakan",
                color: "text-success"
            }
        };

        let activeSignaturePads = [];
        let bsModal;
        let pendingRowToRemove = null;

        // Sekarang dataA berbentuk objek JSON (Kode: Nama Menu)

        function openForm(bulan) {
            const tahunSekarang = 2026; // Sesuai periode sistem Anda
            document.getElementById('form-title').innerText = `{{ $data->b_menus_kategori }}`;
            document.getElementById('form-subtitle').innerText = `Periode Kegiatan: {{ $data->b_validasi_data_req_date }}`;

            const tbody = document.getElementById('content-tabel');
            tbody.innerHTML = '';
            activeSignaturePads = [];

            tbody.innerHTML += `
        <tr class="section-title">
            <td class="text-center">A</td>
            <td colspan="6">{{ $data->b_menus_kategori }}</td>
        </tr>
    `;

            // Looping objek: menuCode adalah KEY (b_menus_sub_code), menuName adalah VALUE (Nama Menu)
            let index = 1;
            for (const [menuCode, menuName] of Object.entries(dataA)) {
                const rowId = menuCode; // Kita gunakan kode menu sebagai ID Baris agar unik

                tbody.innerHTML += `
        <tr id="row-${rowId}">
            <td class="text-center small">${index++}</td>
            <td class="fw-semibold text-secondary field-nama-menu" data-code="${menuCode}">${menuName}</td>
            <td>
                <select class="form-select form-select-sm select-skala">
                    <option value="">-- Skala --</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </td>
            <td>
                <div class="mb-2">
                    <span id="desc-${rowId}" class="desc-text text-muted fst-italic">Belum memilih skala...</span>
                </div>
                <textarea class="form-control form-control-sm input-catatan" rows="2" placeholder="Catatan manual..."></textarea>
            </td>
            <td>
                <input type="text" class="form-control form-control-sm mb-1 input-petugas" placeholder="Nama Petugas">
                <div class="sig-container">
                    <canvas id="canvas-verif-${rowId}" class="sig-canvas"></canvas>
                    <button type="button" class="btn btn-danger btn-clear-sig" onclick="clearSignature('canvas-verif-${rowId}')">Hapus</button>
                </div>
            </td>
            <td>
                <input type="text" class="form-control form-control-sm mb-1 input-validator" placeholder="Nama Validator">
                <div class="sig-container">
                    <canvas id="canvas-valid-${rowId}" class="sig-canvas"></canvas>
                    <button type="button" class="btn btn-danger btn-clear-sig" onclick="clearSignature('canvas-valid-${rowId}')">Hapus</button>
                </div>
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-primary btn-sm w-100" onclick="simpanPerBaris('${rowId}')">
                    <i class="bi bi-save"></i> Simpan
                </button>
            </td>
        </tr>
        `;
            }

            // Init Signatures
            setTimeout(() => {
                for (const menuCode of Object.keys(dataA)) {
                    initCanvasSignature(`canvas-verif-${menuCode}`);
                    initCanvasSignature(`canvas-valid-${menuCode}`);
                }
            }, 100);
        }

        function updateDescription(selectElement, descId) {
            const val = selectElement.value;
            const descCell = document.getElementById(descId);

            if (val in statusDescriptions) {
                descCell.innerText = `Status: ${statusDescriptions[val].text}`;
                descCell.className = `desc-text ${statusDescriptions[val].color}`;
            } else {
                descCell.innerText = "Belum memilih skala...";
                descCell.className = "desc-text text-muted fst-italic";
            }
        }

        function initCanvasSignature(id) {
            const canvas = document.getElementById(id);
            if (canvas) {
                canvas.width = canvas.offsetWidth;
                canvas.height = canvas.offsetHeight;
                const signaturePad = new SignaturePad(canvas, {
                    minWidth: 1,
                    maxWidth: 2.5,
                    penColor: "rgb(30, 58, 138)"
                });
                activeSignaturePads[id] = signaturePad;
            }
        }

        function clearSignature(id) {
            if (activeSignaturePads[id]) activeSignaturePads[id].clear();
        }

        function simpanPerBaris(rowId) {
            const row = document.getElementById(`row-${rowId}`);

            const menuElement = row.querySelector('.field-nama-menu');
            const namaMenu = menuElement.innerText;
            const menuCode = menuElement.getAttribute('data-code'); // Ambil b_menus_sub_code

            const skala = row.querySelector('.select-skala').value;
            const catatan = row.querySelector('.input-catatan').value;
            const petugas = row.querySelector('.input-petugas').value;
            const validator = row.querySelector('.input-validator').value;

            const ttdPetugasKosong = activeSignaturePads[`canvas-verif-${rowId}`].isEmpty();
            const ttdValidatorKosong = activeSignaturePads[`canvas-valid-${rowId}`].isEmpty();

            if (!skala || !petugas || !validator || ttdPetugasKosong || ttdValidatorKosong) {
                alert(`Gagal Menyimpan!\nMohon lengkapi data untuk menu "${namaMenu}".`);
                return;
            }

            const payloadBaris = {
                b_menus_sub_code: menuCode,
                code_token: `{{ $token }}`,
                tahun: 2026,
                bulan: "Juli", // Bisa dinamis sesuai parameter openForm
                skala: parseInt(skala),
                catatan_manual: catatan,
                nama_verifikator: petugas,
                ttd_verifikator: activeSignaturePads[`canvas-verif-${rowId}`].toDataURL("image/png"),
                nama_validator: validator,
                ttd_validator: activeSignaturePads[`canvas-valid-${rowId}`].toDataURL("image/png")
            };

            const csrfTokenElement = document.querySelector('meta[name="csrf-token"]');
            const csrfToken = csrfTokenElement ? csrfTokenElement.getAttribute('content') : '';

            fetch("{{ route('v3_get_token_validasi_save') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken
                    },
                    body: JSON.stringify(payloadBaris)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        row.classList.add('fade-out');
                        setTimeout(() => {
                            row.remove();
                        }, 500);
                    } else {
                        alert("Gagal menyimpan data.");
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                });
        }

        window.onload = function() {
            bsModal = new bootstrap.Modal(document.getElementById('jsonModal'));

            // Memanggil openForm tanpa perlu parameter kode petugas 'A' lagi
            openForm('Juli');

            document.getElementById('jsonModal').addEventListener('hidden.bs.modal', function() {
                if (pendingRowToRemove) {
                    const targetRow = document.getElementById(`row-${pendingRowToRemove}`);
                    if (targetRow) {
                        targetRow.classList.add('fade-out');
                        setTimeout(() => {
                            targetRow.remove();
                            pendingRowToRemove = null;
                        }, 500);
                    }
                }
            });

            document.getElementById('content-tabel').addEventListener('change', function(e) {
                if (e.target && e.target.classList.contains('select-skala')) {
                    const rowTr = e.target.closest('tr');
                    const cleanId = rowTr.id.replace('row-', '');
                    updateDescription(e.target, `desc-${cleanId}`);
                }
            });
        };
    </script>
</body>

</html>
