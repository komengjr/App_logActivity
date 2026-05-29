@extends('layouts.template')
@section('content')
<style>
    .card-proses {
        border-top: 4px solid #198754;
    }

    .scrollable-table {
        max-height: 550px;
        overflow-y: auto;
    }

    .badge-status {
        font-size: 11px;
        padding: 4px 8px;
    }

    .badge-tindakan {
        font-size: 11px;
        background-color: #e2e8f0;
        color: #475569;
        font-weight: 600;
    }

    .badge-kategori {
        font-size: 10px;
        font-weight: 700;
    }

    .category-header {
        font-size: 13px;
        font-weight: bold;
        background-color: #f8f9fa;
        padding: 6px 10px;
        border-radius: 4px;
        margin-top: 10px;
        margin-bottom: 8px;
        border-left: 3px solid #0d6efd;
    }

    .category-header.software {
        border-left-color: #6c757d;
    }

    .sub-penilaian-box {
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        padding: 12px;
        /* background-color: #fff; */
        max-height: 320px;
        overflow-y: auto;
    }

    .sub-item-group {
        border-bottom: 1px solid #f1f3f5;
        padding-bottom: 8px;
        margin-bottom: 8px;
    }

    .sub-item-group:last-child {
        border-bottom: none;
        padding-bottom: 0;
        margin-bottom: 0;
    }

    .input-deskripsi-sub {
        font-size: 12px;
        margin-top: 4px;
    }

    .json-output-area {
        background-color: #1e1e1e;
        color: #39ea49;
        font-family: 'Courier New', Courier, monospace;
        font-size: 12px;
        padding: 15px;
        border-radius: 6px;
        max-height: 250px;
        overflow-y: auto;
        white-space: pre-wrap;
    }
</style>
<div class="card mb-3">

    <div class="card-body border-top">
        <div class="d-flex">
            <div class="flex-1">
                <h5 class="fw-bold text-dark"><i class="bi bi-calendar-week text-primary"></i>Proses Perencanaan Jadwal Maintenance</h5>
                <p class="text-muted mb-0">Tahap 2: Eksekusi Lapangan.</p>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-1 mb-3 bg-white">
    <div class="card-body p-3">
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label fw-bold small text-muted text-uppercase mb-1">1. Pilih Cabang Pelaksanaan</label>
                <select class="form-select border-primary fw-bold" id="filterCabang" onchange="AksiPilihCabang()">
                    <option value="" disabled selected>-- Pilih Cabang --</option>
                    @foreach ($cabang as $cab)
                    <option value="{{ $cab->kd_cabang }}">{{ $cab->nama_cabang }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold small text-muted text-uppercase mb-1">2. Pilih Tahun Jadwal</label>
                <select class="form-select border-primary fw-bold" id="filterTahun" onchange="AksiPilihTahun()" disabled>
                    <option value="" disabled selected>-- Pilih Cabang Dahulu --</option>
                    <option value="2026">Tahun 2026</option>
                    <option value="2027">Tahun 2027</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold small text-muted text-uppercase mb-1">3. Pilih Bulan Jadwal</label>
                <select class="form-select border-primary fw-bold" id="filterBulan" onchange="AksiPilihBulan()" disabled>
                    <option value="" disabled selected>-- Pilih Tahun Dahulu --</option>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-12 col-lg-7">
        <div class="card shadow-sm border-0 card-jadwal mb-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 fw-bold text-primary"><i class="fas fa-calendar-week me-2"></i>Daftar Aset Terjadwal</h5>
                <span class="badge bg-primary px-3" id="counterJadwal">Pilih Parameter</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive" style="max-height: 400px;">
                    <table class="table table-striped align-middle mb-0" style="font-size: 13px;">
                        <thead class="table-primary sticky-top">
                            <tr>
                                <th style="width: 25%;">Cabang</th>
                                <th style="width: 50%;">ID & Nama Barang / Aset</th>
                                <th style="width: 25%;" class="text-center">Aksi Kerja</th>
                            </tr>
                        </thead>
                        <tbody id="tabelJadwalBody">
                            <tr>
                                <td colspan="3" class="text-center p-4 text-muted">
                                    Silakan tentukan Cabang, Tahun, dan Bulan untuk memuat data dari database.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-5">
        <div class="card shadow-sm border-0 card-proses mb-4">
            <div class="card-header bg-primary py-3">
                <h5 class="card-title mb-0 fw-bold text-white"><i class="bi bi-file-earmark-check me-2"></i>Form Catat Hasil Kerja</h5>
            </div>
            <div class="card-body p-3">
                <form id="formEksekusi" onsubmit="simpanHasilMaintenance(event)">
                    <div class="row g-2 mb-1">
                        <div class="col-6">
                            <label class="form-label fw-semibold small">Cabang</label>
                            <input type="text" class="form-control bg-light fw-bold text-secondary" id="displayCabang" readonly required placeholder="-">
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold small">Periode Plan</label>
                            <input type="text" class="form-control bg-light text-secondary" id="displayPeriode" readonly required placeholder="-">
                        </div>
                    </div>

                    <div class="mb-1">
                        <label class="form-label fw-semibold small">Aset Terpilih</label>
                        <input type="hidden" id="hiddenIdAset">
                        <input type="hidden" id="hiddenBulanPlan">
                        <input type="hidden" id="hiddenTahunPlan">
                        <input type="hidden" id="hiddenCabang">
                        <input type="text" class="form-control bg-light fw-bold text-primary" id="displayNamaAset" readonly required placeholder="Silakan klik 'Lakukan Proses' di kanan &rarr;">
                    </div>

                    <div class="row g-2 mb-1">
                        <div class="col-12">
                            <label class="form-label fw-semibold small">Lokasi Barang</label>
                            <input type="text" class="form-control" id="lokasi" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold small">Tanggal Selesai</label>
                            <input type="date" class="form-control" id="inputTglSelesai" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold small">Tipe Tindakan</label>
                            <select class="form-select text-primary fw-medium" id="selectTipeTindakan" required>
                                <option value="" disabled selected>-- Pilih Tipe --</option>
                                <option value="Routine Check">📋 Routine Check</option>
                                <option value="Preventive Maint.">🛡️ Preventive Maint.</option>
                                <option value="Perbaikan Ringan">🔧 Perbaikan Ringan</option>
                                <option value="Overhaul / Berat">⚙️ Overhaul / Berat</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small d-block">Daftar Sub Penilaian Komponen</label>
                        <div class="sub-penilaian-box">
                            <div class="category-header text-primary"><i class="bi bi-cpu me-1"></i> HARDWARE</div>
                            <div id="containerHardware"></div>

                            <div class="category-header text-secondary software"><i class="bi bi-code-slash me-1"></i> SOFTWARE</div>
                            <div id="containerSoftware"></div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold small">Kondisi Alat Akhir</label>
                        <select class="form-select fw-bold text-success" id="selectKondisi" required>
                            <option value="Normal / Layak">🟢 Normal / Layak</option>
                            <option value="Rusak Ringan">🟡 Rusak Ringan</option>
                            <option value="Critical / Rusak Berat">🔴 Rusak Berat</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success w-100 fw-bold py-2" id="btnSubmitForm" disabled>
                        <i class="bi bi-cloud-upload me-1"></i> Submit Data Ke DB via Laravel Route
                    </button>
                </form>
            </div>
        </div>

        <div class="card shadow-sm border-0 d-none" id="cardJsonOutput">
            <div class="card-header bg-dark text-white py-2">
                <span class="small fw-bold text-warning"><i class="bi bi-braces me-1"></i> Respon Server Laravel</span>
            </div>
            <div class="card-body p-2 bg-dark">
                <pre class="json-output-area mb-0" id="jsonRawView"></pre>
            </div>
        </div>
    </div>


</div>

@endsection
@section('base.js')
<script>
    // URL DI-INJEKSI SECARA AMAN MENGGUNAKAN BLADE HELPER ROUTE
    // Pastikan Anda mendaftarkan ->name() ini di web.php atau api.php Anda
    const URL_GET_BULAN = "{{ route('menu_proses_maintenance_get_bulan') }}";
    const URL_GET_BARANG = "{{ route('menu_proses_maintenance_get_barang') }}";
    const URL_SIMPAN = "{{ route('menu_proses_maintenance_save') }}";

    const masterHardware = ["CPU", "KABEL", "MONITOR", "KEYBOARD MOUSE"];
    const masterSoftware = ["Operating System", "Aplikasi Lainnya"];

    window.onload = function() {
        buildCheckboxList("Hardware", masterHardware, "containerHardware");
        buildCheckboxList("Software", masterSoftware, "containerSoftware");
    };

    function buildCheckboxList(kategori, arrData, containerId) {
        const container = document.getElementById(containerId);
        container.innerHTML = "";
        arrData.forEach((sub, index) => {
            let divGroup = document.createElement("div");
            divGroup.className = "sub-item-group";
            divGroup.innerHTML = `
                <div class="form-check">
                    <input class="form-check-input check-sub-item" type="checkbox" value="${sub}" data-kategori="${kategori}" id="chk_${kategori}_${index}" onchange="toggleDeskripsi('${kategori}', ${index})">
                    <label class="form-check-label small fw-bold " for="chk_${kategori}_${index}">
                        ${sub}
                    </label>
                </div>
                <input type="text" class="form-control form-control-lg input-deskripsi-sub" id="txt_${kategori}_${index}" placeholder="Tulis deskripsi..." disabled required style="display:none;">
            `;
            container.appendChild(divGroup);
        });
    }

    function toggleDeskripsi(kategori, index) {
        const checkbox = document.getElementById(`chk_${kategori}_${index}`);
        const inputDesc = document.getElementById(`txt_${kategori}_${index}`);
        if (checkbox.checked) {
            inputDesc.disabled = false;
            inputDesc.style.display = "block";
        } else {
            inputDesc.disabled = true;
            inputDesc.value = "";
            inputDesc.style.display = "none";
        }
    }

    function AksiPilihCabang() {
        const cabang = document.getElementById("filterCabang").value;
        const selectTahun = document.getElementById("filterTahun");
        const selectBulan = document.getElementById("filterBulan");

        selectTahun.selectedIndex = 0;
        selectBulan.innerHTML = '<option value="" disabled selected>-- Pilih Tahun Dahulu --</option>';

        selectTahun.disabled = !cabang;
        selectBulan.disabled = true;

        if (cabang) selectTahun.options[0].text = "-- Pilih Tahun --";
        resetTabelJadwalView("Silakan tentukan Tahun dan Bulan untuk melihat daftar barang.");
    }

    // 2. Ambil Bulan Menggunakan URL hasil Blade Route Helper
    async function AksiPilihTahun() {
        const cabang = document.getElementById("filterCabang").value;
        const tahun = document.getElementById("filterTahun").value;
        const selectBulan = document.getElementById("filterBulan");

        selectBulan.innerHTML = '<option value="" disabled selected>Memuat bulan...</option>';
        selectBulan.disabled = true;

        if (!tahun) return;

        try {
            // Menggabungkan URL Route Laravel dengan Query Parameter JavaScript
            const response = await fetch(`${URL_GET_BULAN}?cabang=${cabang}&tahun=${tahun}`);
            const dataBulan = await response.json();

            selectBulan.innerHTML = '<option value="" disabled selected>-- Pilih Bulan --</option>';

            if (dataBulan && dataBulan.length > 0) {
                dataBulan.forEach(bulan => {
                    let opt = document.createElement("option");
                    opt.value = bulan;
                    opt.innerText = bulan;
                    selectBulan.appendChild(opt);
                });
                selectBulan.disabled = false;
            } else {
                selectBulan.options[0].text = "-- Tidak Ada Jadwal Plan --";
            }
        } catch (error) {
            console.error("Error:", error);
            selectBulan.options[0].text = "-- Gagal Memuat Data --";
        }
        resetTabelJadwalView("Silakan tentukan Bulan untuk menampilkan daftar barang.");
    }

    // 3. Ambil Barang Menggunakan URL hasil Blade Route Helper
    async function AksiPilihBulan() {
        const cabang = document.getElementById("filterCabang").value;
        const tahun = document.getElementById("filterTahun").value;
        const bulan = document.getElementById("filterBulan").value;

        if (!cabang || !tahun || !bulan) return;

        const tbody = document.getElementById("tabelJadwalBody");
        tbody.innerHTML = `<tr><td colspan="3" class="text-center p-4 text-muted"><div class="spinner-border spinner-border-sm text-primary"></div> Menghubungkan ke database...</td></tr>`;

        try {
            const response = await fetch(`${URL_GET_BARANG}?cabang=${cabang}&tahun=${tahun}&bulan=${bulan}`);
            const listBarang = await response.json();

            tbody.innerHTML = "";

            if (!listBarang || listBarang.length === 0) {
                tbody.innerHTML = `<tr><td colspan="3" class="text-center p-4 text-warning">Tidak ada antrean barang di periode ini.</td></tr>`;
                document.getElementById("counterJadwal").innerText = "0 Aset";
                return;
            }

            listBarang.forEach(barang => {
                let tr = document.createElement("tr");
                tr.innerHTML = `
                    <td><span class="badge bg-secondary">${cabang}</span></td>
                    <td>
                        <strong class="text-dark">${barang.m_rencana_detail_nama_brg}</strong><br>
                        <small class="text-muted">${barang.m_rencana_detail_id_brg}</small>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-primary btn-sm fw-bold py-1" style="font-size:11px;"
                                onclick="pilihAsetKeForm('${barang.m_rencana_detail_id_brg}', '${barang.m_rencana_detail_nama_brg}', '${cabang}', '${bulan}', '${tahun}')">
                            <i class="bi bi-play-fill"></i> Lakukan Proses
                        </button>
                    </td>
                `;
                tbody.appendChild(tr);
            });

            document.getElementById("counterJadwal").innerText = `${listBarang.length} Barang Terjadwal`;

        } catch (error) {
            console.error("Error:", error);
            tbody.innerHTML = `<tr><td colspan="3" class="text-center p-4 text-danger">Terjadi kegagalan memuat data barang.</td></tr>`;
        }
    }

    function resetTabelJadwalView(pesan) {
        document.getElementById("tabelJadwalBody").innerHTML = `<tr><td colspan="3" class="text-center p-4 text-muted">${pesan}</td></tr>`;
        document.getElementById("counterJadwal").innerText = "Pilih Parameter";
    }

    function pilihAsetKeForm(id, nama, cabang, bulan, tahun) {
        document.getElementById("displayCabang").value = cabang;
        document.getElementById("displayPeriode").value = `${bulan} ${tahun}`;
        document.getElementById("displayNamaAset").value = `[${id}] - ${nama}`;

        document.getElementById("hiddenIdAset").value = id;
        document.getElementById("hiddenBulanPlan").value = bulan;
        document.getElementById("hiddenTahunPlan").value = tahun;
        document.getElementById("hiddenCabang").value = cabang;

        document.getElementById("btnSubmitForm").disabled = false;
        document.getElementById("inputTglSelesai").focus();
    }

    // 4. POST Simpan Data dengan CSRF perlindungan Laravel Token
    async function simpanHasilMaintenance(event) {
        event.preventDefault();

        let detailTindakanList = [];
        masterHardware.forEach((sub, index) => {
            const cb = document.getElementById(`chk_Hardware_${index}`);
            if (cb && cb.checked) {
                detailTindakanList.push({
                    kategori: "Hardware",
                    sub_nama: sub,
                    deskripsi: document.getElementById(`txt_Hardware_${index}`).value
                });
            }
        });
        masterSoftware.forEach((sub, index) => {
            const cb = document.getElementById(`chk_Software_${index}`);
            if (cb && cb.checked) {
                detailTindakanList.push({
                    kategori: "Software",
                    sub_nama: sub,
                    deskripsi: document.getElementById(`txt_Software_${index}`).value
                });
            }
        });

        if (detailTindakanList.length === 0) {
            alert("Pilih minimal 1 sub penilaian komponen!");
            return;
        }

        const dataForm = {
            id_aset: document.getElementById("hiddenIdAset").value,
            cabang: document.getElementById("hiddenCabang").value,
            tahun: document.getElementById("hiddenTahunPlan").value,
            bulan: document.getElementById("hiddenBulanPlan").value,
            tgl_selesai: document.getElementById("inputTglSelesai").value,
            lokasi: document.getElementById("lokasi").value,
            tipe_tindakan: document.getElementById("selectTipeTindakan").value,
            kondisi: document.getElementById("selectKondisi").value,
            rincian: detailTindakanList
        };

        // Ambil CSRF token dari tag <meta> diatas
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        try {
            const response = await fetch(URL_SIMPAN, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken // Wajib diisi saat melakukan POST/PUT/DELETE di Laravel
                },
                body: JSON.stringify(dataForm)
            });
            const result = await response.json();

            document.getElementById("cardJsonOutput").classList.remove("d-none");
            document.getElementById("jsonRawView").innerText = JSON.stringify(result, null, 4);

            if (result.status === "success") {
                alert("Data berhasil disimpan di database Laravel!");
                document.getElementById("formEksekusi").reset();
                AksiPilihBulan(); // Refresh list antrean barang
            }
        } catch (error) {
            alert("Gagal mengirim data ke server Laravel.");
        }
    }
</script>
@endsection
