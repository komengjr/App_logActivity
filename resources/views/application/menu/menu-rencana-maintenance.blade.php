@extends('layouts.template')
@section('content')
<style>
    /* KUSTOMISASI SCROLLBAR UNTUK LIST BARANG (Mencegah Card Melar Kebawah) */
    .scrollable-checkbox-container {
        max-height: 320px;
        /* Batas tinggi maksimal box list barang */
        overflow-y: auto;
        /* Otomatis memunculkan scrollbar vertikal jika barang penuh */
        border: 1px solid #dee2e6;
        background-color: #f8f9fa;
        border-radius: 0.375rem;
        padding: 15px;
    }

    /* Style scrollbar agar terlihat lebih modern dan tipis (Webkit Browser) */
    .scrollable-checkbox-container::-webkit-scrollbar {
        width: 6px;
    }

    .scrollable-checkbox-container::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    .scrollable-checkbox-container::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 4px;
    }

    .scrollable-checkbox-container::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }
</style>
<div class="card mb-3">
    <div class="card-body border-top">
        <div class="d-flex">
            <div class="flex-1">
                <h5 class="fw-bold text-dark"><i class="bi bi-calendar-week text-primary"></i>Form Perencanaan Jadwal Maintenance</h5>
                <p class="text-muted mb-0">Tahap 1: Daftarkan dan plot aset inventaris. Barang yang <b>sudah dijadwalkan di bulan mana pun</b> tidak akan muncul lagi di bulan-bulan lainnya.</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-12 col-md-5 col-lg-4">
        <div class="card shadow-sm border-0 position-sticky">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="card-title mb-0 fw-bold text-white"><i class="fas fa-calendar-plus me-2"></i>Plotting Jadwal</h5>
            </div>
            <div class="card-body p-4">
                <form id="formPlotJadwal" onsubmit="tambahJadwalKeKalender(event)">

                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-primary">Pilih Cabang Perusahaan</label>
                        <select class="form-select border-primary fw-bold" id="inputCabang" onchange="handleCabangChange()" required>
                            <option value="" disabled selected>-- Pilih Cabang --</option>
                            @foreach ($cabang as $cab)
                            <option value="{{ $cab->kd_cabang }}">{{ $cab->nama_cabang }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold small">Tahun</label>
                            <select class="form-select fw-bold" id="inputTahun" disabled>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold small">Target Bulan</label>
                            <select class="form-select fw-bold text-primary" id="inputBulan" onchange="filterCheckboxInventaris(true)" required disabled>
                                <option value="" disabled selected>-- Pilih --</option>
                                <option value="0">Januari</option>
                                <option value="1">Februari</option>
                                <option value="2">Maret</option>
                                <option value="3">April</option>
                                <option value="4">Mei</option>
                                <option value="5">Juni</option>
                                <option value="6">Juli</option>
                                <option value="7">Agustus</option>
                                <option value="8">September</option>
                                <option value="9">Oktober</option>
                                <option value="10">November</option>
                                <option value="11">Desember</option>
                            </select>
                        </div>
                    </div>

                    <div id="areaPilihanBarang" style="display: none;">
                        <div class="mb-4">
                            <label class="form-label fw-semibold d-block text-secondary mb-2">
                                <i class="bi bi-boxes me-1"></i> Pilih Inventaris untuk Bulan Terpilih:
                            </label>

                            <div class="input-group mb-2 shadow-sm">
                                <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                                <input type="text" id="searchBarang" class="form-control border-start-0 ps-0" placeholder="Cari Nama atau ID Barang..." onkeyup="filterCheckboxInventaris(false)">
                            </div>

                            <div class="scrollable-checkbox-container" id="containerCheckbox">
                                <div id="notifSemuaTerpilih" class="text-muted text-center py-2 small" style="display: none;">
                                    <i class="bi bi-lock-fill text-warning d-block fs-4 mb-1"></i> Semua barang sudah terjadwal di bulan lain.
                                </div>
                                <div id="notifTidakDitemukan" class="text-muted text-center py-2 small" style="display: none;">
                                    <i class="bi bi-patch-question text-secondary d-block fs-4 mb-1"></i> Barang tidak ditemukan.
                                </div>
                            </div>
                        </div>

                        <button type="submit" id="btnSubmit" class="btn btn-primary w-100 fw-bold py-2">
                            <i class="bi bi-plus-square me-1"></i> Tambahkan ke Rencana
                        </button>
                    </div>

                    <div id="notifPanduanAwal" class="alert alert-warning text-center small mt-3">
                        <i class="bi bi-info-circle-fill me-1"></i> Selesaikan pilihan Cabang dan Target Bulan untuk melihat item barang.
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-7 col-lg-8">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-dark text-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 fw-bold text-white"><i class="fas fa-journal-calendar me-2 text-warning"></i> Matriks Rencana Kerja 1 Tahun</h5>
                <span class="badge bg-secondary px-3" id="badgeTahun">Periode Belum Set</span>
            </div>
            <div class="card-body p-3">

                <form id="formSimpanJadwalGlobal" onsubmit="submitJadwalKeDatabase(event)">
                    <div class="accordion" id="accordionKalenderRencana">
                        <div id="pesanKosong" class="text-center p-5 text-muted small border border-dashed rounded bg-white">
                            <i class="bi bi-calendar-x d-block fs-1 mb-2 text-secondary"></i>
                            Belum ada plotting agenda. Silakan tentukan cabang, bulan, dan inventaris di panel sebelah kiri.
                        </div>
                    </div>

                    <div id="areaTombolSimpan" class="mt-4 text-end" style="display: none;">
                        <button type="submit" class="btn btn-success fw-bold px-5 py-2.5 shadow-sm">
                            <i class="bi bi-save-fill me-2"></i> Kunci & Simpan Jadwal Tahunan
                        </button>
                    </div>
                </form>

            </div>
        </div>

        <div id="cardJsonViewer" class="card shadow-sm border-0 animate-fade-in" style="display: none;">
            <div class="card-header bg-secondary text-white py-2 d-flex justify-content-between align-items-center">
                <span class="fw-bold small"><i class="bi bi-code-slash me-2"></i>Jadwal Log Output (JSON Format)</span>
                <button class="btn btn-xs btn-light py-0 px-2 small" style="font-size: 11px;" onclick="copyJsonToClipboard()">
                    <i class="bi bi-copy"></i> Salin JSON
                </button>
            </div>
            <div class="card-body p-3">
                <pre id="jsonOutput">{}</pre>
            </div>
        </div>

    </div>

</div>

@endsection
@section('base.js')

<div class="modal fade" id="modal-log-it" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content border-0">
            <div class="position-absolute top-0 end-0 mt-3 me-3 z-index-1">
                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="menu-log-it"></div>
        </div>
    </div>
</div>
<script>
    const namaBulanList = [
        "Januari", "Februari", "Maret", "April", "Mei", "Juni",
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];

    let databaseRencanaTahunan = {};
    let cabangTerpilihGlobal = "";
    let tahunTerpilihGlobal = "2026";
    let listMasterBarangDariAPI = [];

    // Mengambil data inventaris menggunakan Fetch API berdasarkan cabang terpilih
    function ambilBarangDariAPI(cabang) {
        // Tampilkan loading sebelum proses fetch dimulai
        const container = document.getElementById("containerCheckbox");
        container.innerHTML = `
            <div id="loadingStatusAPI" class="text-center py-3 text-muted small">
                <div class="spinner-border spinner-border-sm text-primary me-2" role="status"></div>
                Memuat data inventaris...
            </div>
        `;

        const endpointAPI = `http://inventory.pramita.co.id:8000/api/v2/datainventaris/${encodeURIComponent(cabang)}`;

        fetch(endpointAPI)
            .then(response => {
                if (!response.ok) {
                    throw new Error("Gagal mengambil respon dari server.");
                }
                return response.json();
            })
            .then(data => {
                listMasterBarangDariAPI = data;
                renderCheckboxKeContainer(); // Bangun ulang checkbox data baru
                filterCheckboxInventaris(true); // Jalankan filter bulan
            })
            .catch(error => {
                console.error("Terjadi kendala Fetch API:", error);
                alert("Gagal memuat data barang inventaris dari database/API.");
            })
            .finally(() => {
                // Sembunyikan loading secara tegas setelah proses selesai/gagal
                const loadingStatus = document.getElementById("loadingStatusAPI");
                if (loadingStatus) loadingStatus.style.display = "none";
            });
    }

    // Merender element form-check-input checkbox secara dinamis dari hasil API
    function renderCheckboxKeContainer() {
        const container = document.getElementById("containerCheckbox");

        // Buat element penampung notifikasi agar tidak hilang terhapus innerHTML
        container.innerHTML = `
            <div id="loadingStatusAPI" class="text-center py-3 text-muted small" style="display: none;">
                <div class="spinner-border spinner-border-sm text-primary me-2" role="status"></div>
                Memuat data inventaris...
            </div>
        `;

        // Render setiap barang menggunakan ID unik
        listMasterBarangDariAPI.forEach((barang, index) => {
            const dynamicId = `b_api_${index}`;
            const itemHTML = `
                <div class="form-check mb-2 item-wrapper" data-id="${barang.inventaris_data_code}" data-nama="${barang.inventaris_data_number} - ${barang.inventaris_data_name}">
                    <input class="form-check-input check-barang" type="checkbox" value="${barang.inventaris_data_code}" data-nama="${barang.inventaris_data_number} - ${barang.inventaris_data_name}" id="${dynamicId}">
                    <label class="form-check-label fw-medium" for="${dynamicId}">
                        <span class="badge bg-secondary text-white badge-id me-1">${barang.inventaris_data_code}</span> ${barang.inventaris_data_name} - ${barang.inventaris_data_number}
                    </label>
                </div>
            `;
            container.innerHTML += itemHTML;
        });

        // Kembalikan elemen notifikasi status ke bawah kontainer
        const notifKunci = document.createElement('div');
        notifKunci.id = "notifSemuaTerpilih";
        notifKunci.className = "text-muted text-center py-2 small";
        notifKunci.style.display = "none";
        notifKunci.innerHTML = '<i class="bi bi-lock-fill text-warning d-block fs-4 mb-1"></i> Semua barang sudah terjadwal di bulan lain.';
        container.appendChild(notifKunci);

        const notifKosong = document.createElement('div');
        notifKosong.id = "notifTidakDitemukan";
        notifKosong.className = "text-muted text-center py-2 small";
        notifKosong.style.display = "none";
        notifKosong.innerHTML = '<i class="bi bi-patch-question text-secondary d-block fs-4 mb-1"></i> Barang tidak ditemukan.';
        container.appendChild(notifKosong);

        // Langsung sembunyikan teks loading karena render data selesai
        const loadingStatus = document.getElementById("loadingStatusAPI");
        if (loadingStatus) loadingStatus.style.display = "none";
    }

    // Mengatur status form aktif/tidak berdasarkan pilihan Cabang
    function handleCabangChange() {
        cabangTerpilihGlobal = document.getElementById("inputCabang").value;

        const inputTahun = document.getElementById("inputTahun");
        const inputBulan = document.getElementById("inputBulan");
        const areaPilihanBarang = document.getElementById("areaPilihanBarang");
        const notifPanduanAwal = document.getElementById("notifPanduanAwal");

        if (cabangTerpilihGlobal !== "") {
            inputTahun.disabled = false;
            inputBulan.disabled = false;

            areaPilihanBarang.style.display = "none";
            if (notifPanduanAwal) notifPanduanAwal.style.display = "block";

            inputBulan.value = "";

            if (!databaseRencanaTahunan[cabangTerpilihGlobal]) {
                databaseRencanaTahunan[cabangTerpilihGlobal] = {};
            }

            tahunTerpilihGlobal = inputTahun.value;
            document.getElementById("badgeTahun").innerText = `Cabang ${cabangTerpilihGlobal} (${tahunTerpilihGlobal})`;

            ambilBarangDariAPI(cabangTerpilihGlobal);
            renderMatriksJadwal();
        }
    }

    // Memfilter item checkbox berdasarkan ID unik barang agar nama yang sama tidak tabrakan
    function filterCheckboxInventaris(resetCheckboxState = false) {
        const indexBulanAktif = document.getElementById("inputBulan").value;
        const keyword = document.getElementById("searchBarang").value.toLowerCase();
        const areaPilihanBarang = document.getElementById("areaPilihanBarang");
        const notifPanduanAwal = document.getElementById("notifPanduanAwal");

        if (cabangTerpilihGlobal === "") return;

        if (indexBulanAktif === "") {
            areaPilihanBarang.style.display = "none";
            if (notifPanduanAwal) notifPanduanAwal.style.display = "block";
            return;
        } else {
            areaPilihanBarang.style.display = "block";
            if (notifPanduanAwal) notifPanduanAwal.style.display = "none";
        }

        let semuaIdBarangTerjadwal = [];
        const dataCabangAktif = databaseRencanaTahunan[cabangTerpilihGlobal] || {};

        Object.keys(dataCabangAktif).forEach((blnKey) => {
            if (dataCabangAktif[blnKey] && dataCabangAktif[blnKey].items) {
                dataCabangAktif[blnKey].items.forEach(item => {
                    if (!semuaIdBarangTerjadwal.includes(item.id)) {
                        semuaIdBarangTerjadwal.push(item.id);
                    }
                });
            }
        });

        const idBarangBulanIni = (dataCabangAktif[indexBulanAktif]) ? dataCabangAktif[indexBulanAktif].items.map(b => b.id) : [];

        let jumlahTersembunyiGlobal = 0;
        let jumlahGagalKeyword = 0;
        const wrappers = document.querySelectorAll('.item-wrapper');

        wrappers.forEach((wrapper) => {
            const idBarang = wrapper.getAttribute('data-id');
            const idBarangLower = idBarang.toLowerCase();
            const namaBarang = wrapper.getAttribute('data-nama');
            const namaBarangLower = namaBarang.toLowerCase();
            const checkbox = wrapper.querySelector('.check-barang');

            if (resetCheckboxState) {
                checkbox.checked = false;
            }

            let sudahDipakaiBulanLain = semuaIdBarangTerjadwal.includes(idBarang);
            let sudahDipakaiBulanIni = idBarangBulanIni.includes(idBarang);
            let cocokKeyword = namaBarangLower.includes(keyword) || idBarangLower.includes(keyword);

            if (sudahDipakaiBulanLain || sudahDipakaiBulanIni) {
                wrapper.style.display = 'none';
                jumlahTersembunyiGlobal++;
            } else if (!cocokKeyword) {
                wrapper.style.display = 'none';
                jumlahGagalKeyword++;
            } else {
                wrapper.style.display = 'block';
            }
        });

        const notifKunci = document.getElementById("notifSemuaTerpilih");
        const notifKosong = document.getElementById("notifTidakDitemukan");

        if (wrappers.length > 0 && jumlahTersembunyiGlobal === wrappers.length) {
            if (notifKunci) notifKunci.style.display = 'block';
            if (notifKosong) notifKosong.style.display = 'none';
        } else if (wrappers.length > 0 && (jumlahTersembunyiGlobal + jumlahGagalKeyword) === wrappers.length) {
            if (notifKosong) notifKosong.style.display = 'block';
            if (notifKunci) notifKunci.style.display = 'none';
        } else {
            if (notifKunci) notifKunci.style.display = 'none';
            if (notifKosong) notifKosong.style.display = 'none';
        }
    }

    // Menangani penambahan data terpilih berdasarkan keunikan ID barang
    function tambahJadwalKeKalender(event) {
        event.preventDefault();

        if (cabangTerpilihGlobal === "") {
            alert("Silakan pilih cabang terlebih dahulu!");
            return;
        }

        tahunTerpilihGlobal = document.getElementById("inputTahun").value;
        const indexBulan = document.getElementById("inputBulan").value;
        const namaBulan = namaBulanList[indexBulan];

        const dataCabangAktif = databaseRencanaTahunan[cabangTerpilihGlobal];
        let barangDipilih = (dataCabangAktif[indexBulan]) ? [...dataCabangAktif[indexBulan].items] : [];

        let adaInputBaru = false;
        document.querySelectorAll('.check-barang:checked').forEach((checkbox) => {
            const idTerpilih = checkbox.value;
            const namaTerpilih = checkbox.getAttribute('data-nama');

            if (!barangDipilih.some(b => b.id === idTerpilih)) {
                barangDipilih.push({
                    id: idTerpilih,
                    nama: namaTerpilih
                });
            }
            adaInputBaru = true;
        });

        if (!adaInputBaru) {
            alert("Silakan centang item inventaris hasil pencarian terlebih dahulu!");
            return;
        }

        databaseRencanaTahunan[cabangTerpilihGlobal][indexBulan] = {
            bulan: namaBulan,
            items: barangDipilih
        };

        document.getElementById("badgeTahun").innerText = `Cabang ${cabangTerpilihGlobal} (${tahunTerpilihGlobal})`;

        if (document.getElementById("pesanKosong")) {
            document.getElementById("pesanKosong").remove();
        }

        document.getElementById("areaTombolSimpan").style.display = "block";

        renderMatriksJadwal();

        document.getElementById("searchBarang").value = "";
        filterCheckboxInventaris(true);
    }

    // Menyusun struktur HTML Accordion 12 Bulan rencana kerja
    function renderMatriksJadwal() {
        const container = document.getElementById("accordionKalenderRencana");
        container.innerHTML = "";

        if (cabangTerpilihGlobal === "") {
            container.innerHTML = `
                <div id="pesanKosong" class="text-center p-5 text-muted small border border-dashed rounded bg-white">
                    <i class="bi bi-calendar-x d-block fs-1 mb-2 text-secondary"></i>
                    Belum ada plotting agenda. Silakan tentukan cabang, bulan, dan inventaris di panel sebelah kiri.
                </div>
            `;
            document.getElementById("areaTombolSimpan").style.display = "none";
            return;
        }

        let totalItemTerjadwal = 0;
        const dataCabangAktif = databaseRencanaTahunan[cabangTerpilihGlobal] || {};

        namaBulanList.forEach((namaBulan, idxBulan) => {
            let itemsHTML = "";
            const jumlahBarang = (dataCabangAktif[idxBulan]) ? dataCabangAktif[idxBulan].items.length : 0;
            totalItemTerjadwal += jumlahBarang;

            const warnaBadgeBulan = (jumlahBarang > 0) ? "bg-primary" : "bg-dark";

            if (jumlahBarang > 0) {
                itemsHTML = '<div class="p-3 bg-white d-flex flex-column gap-2">';

                dataCabangAktif[idxBulan].items.forEach((barang) => {
                    itemsHTML += `
                        <div class="list-barang-plan p-2.5 px-3 rounded d-flex align-items-center justify-content-between">
                            <span class="fw-semibold text-dark small">
                                <i class="bi bi-box-seam text-primary me-2"></i>
                                <span class="badge bg-dark text-white badge-id me-1">${barang.id}</span> ${barang.nama}
                            </span>
                            <button type="button" class="btn btn-sm btn-outline-danger btn-delete-item" onclick="hapusItemJadwal(${idxBulan}, '${barang.id}')" title="Batalkan Jadwal">
                                <i class="bi bi-trash3-fill"></i> Hapus
                            </button>
                        </div>
                    `;
                });

                itemsHTML += '</div>';
            } else {
                itemsHTML = '<div class="p-3 text-muted small bg-light-subtle text-center"><i>Belum ada agenda maintenance di bulan ini.</i></div>';
            }

            const accordionItemHTML = `
                <div class="accordion-item mb-2 border rounded shadow-xs">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed py-2.5 fw-bold text-secondary bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_${idxBulan}">
                            <i class="bi bi-calendar2-range text-primary me-2"></i> ${namaBulan} 
                            <span class="badge ${warnaBadgeBulan} ms-2 small" style="font-size:10px;">${jumlahBarang} Item</span>
                        </button>
                    </h2>
                    <div id="collapse_${idxBulan}" class="accordion-collapse collapse" data-bs-parent="#accordionKalenderRencana">
                        <div class="accordion-body p-0 bg-light-subtle">
                            ${itemsHTML}
                        </div>
                    </div>
                </div>
            `;
            container.innerHTML += accordionItemHTML;
        });

        if (totalItemTerjadwal === 0) {
            container.innerHTML = `
                <div id="pesanKosong" class="text-center p-5 text-muted small border border-dashed rounded bg-white">
                    <i class="bi bi-calendar-x d-block fs-1 mb-2 text-secondary"></i>
                    Belum ada plotting agenda untuk Cabang ${cabangTerpilihGlobal}. Silakan tentukan bulan dan inventaris.
                </div>
            `;
            document.getElementById("areaTombolSimpan").style.display = "none";
            document.getElementById("cardJsonViewer").style.display = "none";
        } else {
            document.getElementById("areaTombolSimpan").style.display = "block";
        }
    }

    // Menghapus item dari matriks jadwal berdasarkan ID barang
    function hapusItemJadwal(idxBulan, idBarang) {
        const dataCabangAktif = databaseRencanaTahunan[cabangTerpilihGlobal];
        if (dataCabangAktif && dataCabangAktif[idxBulan]) {
            dataCabangAktif[idxBulan].items = dataCabangAktif[idxBulan].items.filter(item => item.id !== idBarang);

            renderMatriksJadwal();
            filterCheckboxInventaris(false);

            if (document.getElementById("cardJsonViewer").style.display === "block") {
                updateJsonDisplay();
            }
        }
    }

    // Memformat dan mengupdate payload JSON
    function updateJsonDisplay() {
        const outputPayload = {
            cabang: cabangTerpilihGlobal,
            tahun_periode: tahunTerpilihGlobal,
            status_jadwal: "LOCKED_AND_SAVED",
            terakhir_diupdate: new Date().toLocaleString('id-ID'),
            matriks_jadwal: databaseRencanaTahunan[cabangTerpilihGlobal] || {}
        };

        // SIMPAN DATA
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: true
        });
        swalWithBootstrapButtons.fire({
            title: "Apakah Yakin ?",
            text: "Kamu Menyimpan Data Jadwal Saat ini!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, Save it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('menu_rencana_maintenance_save') }}",
                    type: "POST",
                    cache: false,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "cabang": cabangTerpilihGlobal,
                        "tahun_periode": tahunTerpilihGlobal,
                        "matriks_jadwal": databaseRencanaTahunan[cabangTerpilihGlobal],
                    },
                    dataType: 'html',
                }).done(function(data) {
                    Swal.fire('Berhasil!', 'Data Jadwal Sudah dibuat', 'success').then(() => {
                        location.reload();
                        document.getElementById("jsonOutput").innerText = JSON.stringify(outputPayload, null, 4);
                    });
                }).fail(function() {
                    console.log('eror');
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire({
                    title: "Pembatalan",
                    text: "Kamu Membatalkan Untuk Simpan",
                    icon: "error"
                });
            }
        });




    }

    // Submit Akhir rencana kerja ke penampil log JSON
    function submitJadwalKeDatabase(event) {
        event.preventDefault();
        document.getElementById("cardJsonViewer").style.display = "block";
        updateJsonDisplay();
        document.getElementById("cardJsonViewer").scrollIntoView({
            behavior: 'smooth'
        });
    }

    // Copy string JSON hasil plotting ke Clipboard
    function copyJsonToClipboard() {
        const jsonText = document.getElementById("jsonOutput").innerText;
        navigator.clipboard.writeText(jsonText).then(() => {
            alert("Teks JSON berhasil disalin ke clipboard!");
        });
    }
</script>
@endsection
