@extends('layouts.template')
@section('base.css')
<style>
    /* Styling Tabel Kalender Utama */
    .table-kalender {
        table-layout: fixed;
        width: 100%;
        margin-bottom: 0;
    }

    .table-kalender th {
        width: 14.28%;
        background-color: #0d6efd !important;
        color: white;
        text-align: center;
        padding: 12px 0;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.9rem;
        letter-spacing: 0.5px;
        border: none;
    }

    .table-kalender td {
        height: 145px;
        width: 14.28%;
        vertical-align: top;
        padding: 8px;
        position: relative;
        background-color: #fff;
        border: 1px solid #dee2e6;
        transition: all 0.15s ease;
    }

    /* Gaya tanggal berjalan & masa depan (Bisa Diklik untuk Edit) */
    .td-mendatang {
        cursor: pointer;
    }

    .td-mendatang:hover {
        background-color: #f0f5ff;
        box-shadow: inset 0 0 0 2px #0d6efd;
    }

    /* Gaya khusus tanggal lampau (Terkunci) */
    .td-lampau {
        background-color: #f8f9fa !important;
        cursor: pointer;
    }

    .td-lampau:hover {
        background-color: #f1f3f5 !important;
    }

    .td-lampau .nomor-tanggal {
        color: #adb5bd;
    }

    .hari-ini {
        background-color: #f7faff !important;
        border: 2px solid #0d6efd !important;
    }

    .hari-ini .nomor-tanggal {
        color: #fff;
        background-color: #0d6efd;
        border-radius: 50%;
        width: 28px;
        height: 28px;
        text-align: center;
        line-height: 28px;
        margin-top: -2px;
        margin-left: -2px;
    }

    .nomor-tanggal {
        font-weight: 700;
        color: #495057;
        font-size: 1.1rem;
        margin-bottom: 6px;
        display: inline-block;
    }

    .td-kosong {
        background-color: #e9ecef !important;
    }

    /* Desain Kolom Petugas Di Dalam Sel Kalender */
    .badge-petugas {
        font-size: 0.75rem;
        padding: 4px 8px;
        border-radius: 6px;
        background-color: #f1f3f5;
        color: #212529;
        border-left: 4px solid #6c757d;
        margin-bottom: 4px;
        font-weight: 600;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .badge-petugas span {
        color: #0d6efd;
        font-family: monospace;
    }

    textarea.font-monospace {
        font-size: 0.8rem;
        background-color: #1e1e1e;
        color: #39ff14;
        border-radius: 6px;
    }
</style>
@endsection
@section('content')
<div class="card mb-3">
    <div class="card-body border-top">
        <div class="d-flex">
            <div class="flex-1">
                <h5 class="fw-bold text-dark"><i class="bi bi-calendar-week text-primary"></i>🗓️ Data Jadwal Piket</h5>
                <p class="text-muted mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit voluptatibus, ducimus ea ut ipsam laborum error doloribus consectetur! Quibusdam repudiandae animi atque consequuntur cum in? Necessitatibus deserunt quod sequi laudantium!</p>
            </div>
        </div>
    </div>
</div>

<div class="card p-4">
    <div class="row align-items-center mb-4">
        <div class="col-md-8 text-center text-md-start">
            <h2 class="fw-bold text-dark m-0" id="namaBulanTahun">Loading...</h2>
            <p class="text-muted small m-0 mt-1">💡 Klik pada kotak tanggal untuk mengubah atau melihat preview update data.</p>
        </div>
        <div class="col-md-4 mt-3 mt-md-0">
            <div class="d-flex align-items-center justify-content-md-end gap-2">
                <label for="pilihBulanTahun" class="fw-semibold text-secondary small text-nowrap m-0">Periode:</label>
                <input type="month" id="pilihBulanTahun" class="form-control form-control-sm" style="max-width: 180px;" onchange="gantiPeriodeKalender()">
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-kalender">
            <thead>
                <tr>
                    <th>Minggu</th>
                    <th>Senin</th>
                    <th>Selasa</th>
                    <th>Rabu</th>
                    <th>Kamis</th>
                    <th>Jumat</th>
                    <th>Sabtu</th>
                </tr>
            </thead>
            <tbody id="bodyKalender">
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('base.js')
<div class="modal fade" id="modalEditHari" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalEditHariLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <div>
                    <h5 class="modal-title fw-bold text-dark" id="modalEditHariLabel">Detail Petugas Piket</h5>
                    <small id="subJudulModalTanggal" class="text-muted fw-semibold"></small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div id="sectionFormEditorModal">
                    <div id="alertTerkunci" class="alert alert-warning py-2 small d-none" role="alert">
                        🔒 <strong>Data Terkunci:</strong> Tanggal ini sudah berlalu. Anda hanya bisa melihat daftar petugas.
                    </div>

                    <label class="form-label fw-bold small text-secondary mb-2">Daftar Personel Piket:</label>

                    <div id="containerFormPetugasModal" class="vstack gap-2 mb-3">
                    </div>

                    <button type="button" id="btnTambahPetugasModal" class="btn btn-outline-success btn-sm w-100 fw-semibold mb-2" onclick="tambahBarisPetugasDiModal('', '')">
                        <i class="bi bi-plus-lg"></i> Tambah Personel Petugas
                    </button>
                </div>

                <div id="sectionPreviewJsonModal" class="d-none">
                    <div class="alert alert-success py-2 small mb-2" role="alert">
                        ✅ <strong>Data Berhasil Di-update!</strong> Berikut adalah potongan data JSON terbaru untuk tanggal ini:
                    </div>
                    <label class="form-label fw-bold small text-dark mb-1">Data JSON Tanggal Terpilih:</label>
                    <textarea id="jsonOutputHarianModal" class="form-control font-monospace mb-2" rows="6" readonly></textarea>
                    <small class="text-muted d-block mb-2">Anda bisa menyalin teks JSON di atas jika diperlukan.</small>
                </div>

            </div>
            <div class="modal-footer bg-light py-2">
                <div id="footerAksiEditor" class="d-flex gap-2 justify-content-end w-100">
                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="button" id="btnSimpanPetugasModal" class="btn btn-primary btn-sm px-4 fw-semibold" onclick="prosesSimpanDanTampilkanJSON()">Simpan Petugas</button>
                </div>

                <div id="footerAksiPreview" class="d-flex gap-2 justify-content-end w-100 d-none">
                    <button type="button" class="btn btn-outline-primary btn-sm fw-semibold" onclick="kembaliKeEditorModal()">← Edit Lagi</button>
                    <button type="button" class="btn btn-success btn-sm px-4 fw-semibold" onclick="terapkanPerubahanKeKalenderUtama()">Selesai & Terapkan</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const hariIniSistem = new Date();
    hariIniSistem.setHours(0, 0, 0, 0);

    let objekTanggalAktif = new Date();
    let databaseJadwalPiket = []; // Tetap digunakan sebagai state lokal setelah data diambil dari DB



    let listMasterUser = @json($listMasterUser);

    // Tambahkan baris debug ini untuk melihat bentuk aslinya di Console F12
    console.log("Tipe Data listMasterUser:", typeof listMasterUser, Array.isArray(listMasterUser), listMasterUser);

    let tanggalSedangDieditModal = "";
    let simpananPetugasSementara = [];

    window.onload = function() {
        document.getElementById('pilihBulanTahun').value = objekTanggalAktif.toISOString().substring(0, 7);
        // Panggil fungsi ambil data dari database saat pertama kali load
        ambilDataJadwalDariDB();
    };

    function gantiPeriodeKalender() {
        const nilaiInput = document.getElementById('pilihBulanTahun').value;
        if (!nilaiInput) return;
        const [tahun, bulan] = nilaiInput.split('-');
        objekTanggalAktif = new Date(tahun, bulan - 1, 1);
        // Setiap ganti bulan/periode, ambil data baru dari database
        ambilDataJadwalDariDB();
    }

    // ================= FUNGSI BARU: AMBIL DATA DARI DATABASE (GET) =================
    async function ambilDataJadwalDariDB() {
        const tahun = objekTanggalAktif.getFullYear();
        // Method getMonth() dimulai dari 0, jadikan format 1-12 dengan padStart
        const bulan = String(objekTanggalAktif.getMonth() + 1).padStart(2, '0');

        try {
            // Mengirim request ke backend dengan parameter filter tahun dan bulan
            const response = await fetch(`${API_URL}?tahun=${tahun}&bulan=${bulan}`);

            if (!response.ok) throw new Error('Gagal mengambil data dari server.');

            // Override state database lokal dengan data riil dari database backend
            databaseJadwalPiket = await response.json();

            // Render ulang tampilan kalender setelah data sukses didapatkan
            renderKalenderMurni();
        } catch (error) {
            console.error("Error Database:", error);
            alert("Gagal memuat jadwal piket dari database. Menggunakan data kosong.");
            databaseJadwalPiket = [];
            renderKalenderMurni();
        }
    }

    function renderKalenderMurni() {
        const tahun = objekTanggalAktif.getFullYear();
        const bulan = objekTanggalAktif.getMonth();

        document.getElementById('namaBulanTahun').textContent = objekTanggalAktif.toLocaleDateString('id-ID', {
            month: 'long',
            year: 'numeric'
        });

        const hariPertamaMulai = new Date(tahun, bulan, 1).getDay();
        const jumlahHariBulanAktif = new Date(tahun, bulan + 1, 0).getDate();

        const bodyKalender = document.getElementById('bodyKalender');
        bodyKalender.innerHTML = '';

        let hitungTanggal = 1;
        let htmlBarisTabel = '';

        for (let m = 0; m < 6; m++) {
            htmlBarisTabel += '<tr>';
            for (let k = 0; k < 7; k++) {
                if (m === 0 && k < hariPertamaMulai) {
                    htmlBarisTabel += '<td class="td-kosong"></td>';
                } else if (hitungTanggal > jumlahHariBulanAktif) {
                    htmlBarisTabel += '<td class="td-kosong"></td>';
                } else {
                    const formatIsoTanggal = `${tahun}-${String(bulan + 1).padStart(2, '0')}-${String(hitungTanggal).padStart(2, '0')}`;
                    const tanggalLoopObj = new Date(tahun, bulan, hitungTanggal);

                    const apakahMasaLalu = tanggalLoopObj < hariIniSistem;
                    const cocokDataPiket = databaseJadwalPiket.find(item => item.tanggal === formatIsoTanggal);

                    let htmlListPetugas = '';
                    if (cocokDataPiket && cocokDataPiket.petugas) {
                        cocokDataPiket.petugas.forEach(p => {
                            htmlListPetugas += `<div class="badge-petugas"><span>[${p.id}]</span> ${p.nama}</div>`;
                        });
                    }

                    const isHariIni = (formatIsoTanggal === hariIniSistem.toISOString().substring(0, 10));
                    const kelasHariIni = isHariIni ? 'hari-ini' : '';
                    const kelasStatusEdit = apakahMasaLalu ? 'td-lampau' : 'td-mendatang';

                    htmlBarisTabel += `
                        <td class="${kelasStatusEdit} ${kelasHariIni}" onclick="bukaModalEditHari('${formatIsoTanggal}', ${apakahMasaLalu})">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="nomor-tanggal">${hitungTanggal}</span>
                                ${apakahMasaLalu ? '<span class="text-muted" style="font-size:0.7rem;">🔒</span>' : ''}
                            </div>
                            <div class="vstack gap-0">
                                ${htmlListPetugas}
                            </div>
                        </td>`;
                    hitungTanggal++;
                }
            }
            htmlBarisTabel += '</tr>';
            if (hitungTanggal > jumlahHariBulanAktif) break;
        }
        bodyKalender.innerHTML = htmlBarisTabel;
    }

    // ================= LOGIKA INTERAKTIF MODAL VIEW EDITOR =================

    function bukaModalEditHari(tanggalIso, apakahMasaLalu) {
        tanggalSedangDieditModal = tanggalIso;

        kembaliKeEditorModal();

        const tglObj = new Date(tanggalIso);
        const opsiFormat = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        document.getElementById('subJudulModalTanggal').textContent = tglObj.toLocaleDateString('id-ID', opsiFormat);

        const containerForm = document.getElementById('containerFormPetugasModal');
        containerForm.innerHTML = '';

        const cocokData = databaseJadwalPiket.find(item => item.tanggal === tanggalIso);
        if (cocokData && cocokData.petugas) {
            cocokData.petugas.forEach(p => {
                tambahBarisPetugasDiModal(p.id, p.nama, apakahMasaLalu);
            });
        }

        const alertKunci = document.getElementById('alertTerkunci');
        const btnTambah = document.getElementById('btnTambahPetugasModal');
        const btnSimpan = document.getElementById('btnSimpanPetugasModal');

        if (apakahMasaLalu) {
            alertKunci.classList.remove('d-none');
            btnTambah.classList.add('d-none');
            btnSimpan.classList.add('d-none');
        } else {
            alertKunci.classList.add('d-none');
            btnTambah.classList.remove('d-none');
            btnSimpan.classList.remove('d-none');
        }

        const modalEl = new bootstrap.Modal(document.getElementById('modalEditHari'));
        modalEl.show();
    }

    function tambahBarisPetugasDiModal(idTerpilih = '', namaTerpilih = '', apakahMasaLalu = false) {
        const containerForm = document.getElementById('containerFormPetugasModal');

        const pesanKosong = containerForm.querySelector('.pencatatan-kosong');
        if (pesanKosong) pesanKosong.remove();

        // --- ANTISIPASI ERROR JIKA BUKAN ARRAY ---
        let arrayUser = [];
        if (Array.isArray(listMasterUser)) {
            arrayUser = listMasterUser;
        } else if (listMasterUser && Array.isArray(listMasterUser.data)) {
            // Antisipasi jika data Laravel dibungkus di dalam property 'data'
            arrayUser = listMasterUser.data;
        } else {
            console.error("Variabel listMasterUser bukan Array yang valid!", listMasterUser);
            alert("Gagal memuat daftar master user dari database.");
            return;
        }
        // -----------------------------------------

        let opsiHTML = '';
        // Gunakan 'arrayUser' yang sudah tervalidasi aman sebagai Array
        arrayUser.forEach(user => {
            const selected = (user.id_user == idTerpilih) ? 'selected' : '';
            opsiHTML += `<option value="${user.id_user}" data-nama="${user.nama_lengkap}" ${selected}>[${user.id_user}] ${user.nama_lengkap}</option>`;
        });

        const atributDisabled = apakahMasaLalu ? 'disabled' : '';

        const barisHTML = `
        <div class="input-group input-group-sm baris-input-petu-modal">
            <select class="form-select select-petugas-modal" ${atributDisabled}>
                <option value="" disabled ${idTerpilih === '' ? 'selected' : ''}>-- Pilih Petugas --</option>
                ${opsiHTML}
            </select>
            ${apakahMasaLalu ? '' : `
                <button class="btn btn-outline-danger" type="button" onclick="this.closest('.input-group').remove()">
                    <i class="bi bi-trash3-fill"></i>
                </button>
            `}
        </div>`;

        containerForm.insertAdjacentHTML('beforeend', barisHTML);
    }

    function prosesSimpanDanTampilkanJSON() {
        // 1. Deklarasi nama variabel yang benar (semuaSelect)
        const semuaSelect = document.querySelectorAll('#containerFormPetugasModal .select-petugas-modal');
        simpananPetugasSementara = [];

        // 2. PERBAIKAN DI SINI: Ubah dari 'semeuaSelect' menjadi 'semuaSelect'
        semuaSelect.forEach(select => {
            const opsiTerpilih = select.options[select.selectedIndex];

            // Pastikan opsi terpilih ada dan nilainya tidak kosong (bukan "-- Pilih Petugas --")
            if (opsiTerpilih && select.value !== "") {
                simpananPetugasSementara.push({
                    id: select.value, // mengambil ID dari value option
                    nama: opsiTerpilih.getAttribute('data-nama') // mengambil nama dari atribut data-nama
                });
            }
        });

        const tglObj = new Date(tanggalSedangDieditModal);
        const namaHari = tglObj.toLocaleDateString('id-ID', {
            weekday: 'long'
        });

        // Buat susunan objek JSON untuk pratinjau
        const objekHarianPreview = {
            tanggal: tanggalSedangDieditModal,
            hari: namaHari,
            jumlah_petugas: simpananPetugasSementara.length,
            petugas: simpananPetugasSementara
        };

        document.getElementById('jsonOutputHarianModal').value = JSON.stringify(objekHarianPreview, null, 4);

        // Alihkan tampilan panel modal
        document.getElementById('sectionFormEditorModal').classList.add('d-none');
        document.getElementById('footerAksiEditor').classList.add('d-none');

        document.getElementById('sectionPreviewJsonModal').classList.remove('d-none');
        document.getElementById('footerAksiPreview').classList.remove('d-none');
    }

    function kembaliKeEditorModal() {
        document.getElementById('sectionPreviewJsonModal').classList.add('d-none');
        document.getElementById('footerAksiPreview').classList.add('d-none');

        document.getElementById('sectionFormEditorModal').classList.remove('d-none');
        document.getElementById('footerAksiEditor').classList.remove('d-none');
    }

    // ================= FUNGSI: SIMPAN DATA KE DATABASE (POST/PUT LARAVEL) =================
    // TERAPKAN PERUBAHAN: Memasukkan data array baru ke database utama lokal & render visual kalender
    function terapkanPerubahanKeKalenderUtama() {
        const indexData = databaseJadwalPiket.findIndex(item => item.tanggal === tanggalSedangDieditModal);

        const tglObj = new Date(tanggalSedangDieditModal);
        const namaHari = tglObj.toLocaleDateString('id-ID', {
            weekday: 'long'
        });

        const objekDataFinal = {
            tanggal: tanggalSedangDieditModal,
            hari: namaHari,
            jumlah_petugas: simpananPetugasSementara.length,
            petugas: simpananPetugasSementara
        };

        if (indexData !== -1) {
            databaseJadwalPiket[indexData] = objekDataFinal;
        } else {
            databaseJadwalPiket.push(objekDataFinal);
        }
        $.ajax({
            url: "{{ route('master_piket_data_bulan_update') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "tanggal": tanggalSedangDieditModal,
                "petugas": simpananPetugasSementara,
            },
            dataType: 'html',
        }).done(function(data) {
            Swal.fire('Berhasil!', 'Data Jadwal Sudah dibuat', 'success').then(() => {
                // location.reload();
                console.log(tanggalSedangDieditModal);
                console.log(simpananPetugasSementara);
            });
        }).fail(function() {
            console.log('eror');
        });
        renderKalenderMurni();
        bootstrap.Modal.getInstance(document.getElementById('modalEditHari')).hide();
    }
    // ================= MODIFIKASI FUNGSI: SIMPAN DATA KE DATABASE (POST) =================
    async function ambilDataJadwalDariDB() {
        const tahun = objekTanggalAktif.getFullYear();
        const bulan = String(objekTanggalAktif.getMonth() + 1).padStart(2, '0');

        // Gabungkan tahun dan bulan sesuai format yang diharapkan oleh Laravel Anda (misal: "2026-05")
        const parameterBulan = `${tahun}-${bulan}`;

        try {
            // Menggabungkan URL sehingga menjadi: .../master-piket-data/2026-05
            const response = await fetch(`{{ url('/menu/app/master/master-piket-data/') }}/${parameterBulan}`);

            if (!response.ok) throw new Error('Gagal mengambil data dari server.');

            databaseJadwalPiket = await response.json();
            renderKalenderMurni();
        } catch (error) {
            console.error("Error Database:", error);
            alert("Gagal memuat jadwal piket dari database.");
            databaseJadwalPiket = [];
            renderKalenderMurni();
        }
    }
</script>
@endsection
