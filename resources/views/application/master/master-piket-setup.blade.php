@extends('layouts.template')
@section('content')
<div class="card mb-3">
    <div class="card-body border-top">
        <div class="d-flex">
            <div class="flex-1">
                <h5 class="fw-bold text-dark"><i class="bi bi-calendar-week text-primary"></i>🗓️ Setup Jadwal Piket</h5>
                <p class="text-muted mb-0">Atur kuota, edit manual, dan simpan hasilnya langsung dalam format data JSON.</p>
            </div>
        </div>
    </div>
</div>
<div class="row g-3">
    <div class="col-lg-4">
        <div class="card sticky-top" style="top: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <div class="card-header bg-primary">
                <h4 class="mb-0 text-white">1. Pengaturan</h4>
            </div>

            <div class="card-body">
                <div class="mb-3">
                    <label for="bulanTahun" class="form-label fw-semibold">Pilih Bulan & Tahun</label>
                    <input type="month" id="bulanTahun" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="kuotaHarian" class="form-label fw-semibold">Kuota Petugas Per Hari</label>
                    <input type="number" id="kuotaHarian" class="form-control" value="3" min="1" max="10" required>
                </div>

                <div class="mb-3">
                    <label for="daftarUser" class="form-label fw-semibold">Daftar User (Format: ID | Nama)</label>
                    <textarea id="daftarUser" class="form-control" rows="8" placeholder="Contoh:&#10;USR-01 | Andi&#10;USR-02 | Budi"></textarea>
                    <small class="text-muted">Pisahkan ID dan Nama dengan tanda ( | ).</small>
                </div>

                <button onclick="generateJadwal()" class="btn btn-primary w-100 fw-bold py-2 mb-2">⚡ Generate Otomatis</button>
                <button onclick="bersihkanForm()" class="btn btn-outline-danger w-100 btn-sm">Reset</button>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card mb-4" style="box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <div class="card-header bg-primary">
                <div class="d-flex justify-content-between align-items-center mb-0">
                    <h4 class="m-0 text-white" id="judulHasil">2. Hasil Jadwal Piket</h4>
                    <button onclick="simpanDanExportJSON()" class="btn btn-success fw-semibold" id="btnSimpan" disabled>💾 Simpan Jadwal</button>
                </div>
            </div>
            <div class="card-body">
                <div id="alertPesan">
                    <div class="alert alert-info">Silakan isi pengaturan di sebelah kiri, lalu klik tombol **Generate Otomatis**.</div>
                </div>

                <div class="accordion mb-4" id="accordionJadwal">
                </div>

                <div id="sectionJsonOutput" style="display: none;">
                    <hr>
                    <h5 class="text-secondary mb-2 mt-3">📋 Data JSON Hasil Jadwal</h5>
                    <p class="text-muted small">Data di bawah ini mencerminkan kondisi terakhir kalender (termasuk hasil edit manual Anda).</p>
                    <textarea id="jsonOutput" class="form-control font-monospace mb-2" rows="10" readonly></textarea>
                    <button onclick="salinJsonKeClipboard()" class="btn btn-dark btn-sm">📋 Salin JSON</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('base.js')
<script>
    const hariIni = new Date();
    document.getElementById('bulanTahun').value = hariIni.toISOString().substring(0, 7);
    let dataUser = `
@foreach($user as $users)
{{ $users->id_user }} | {{ $users->name }}
@endforeach`.trim();
    document.getElementById('daftarUser').value = dataUser;
    let masterDaftarUser = [];

    function dapatkanDaftarUserDariInput() {
        const textUser = document.getElementById('daftarUser').value.trim();
        if (!textUser) return [];
        return textUser.split('\n').map(baris => {
            const indeksPemisah = baris.lastIndexOf(" | ");
            if (indeksPemisah !== -1) {
                return {
                    id: baris.substring(0, indeksPemisah).trim(),
                    nama: baris.substring(indeksPemisah + 3).trim()
                };
            } else {
                const parts = baris.split('|');
                return parts.length >= 2 ? {
                    id: parts[0].trim(),
                    nama: parts.slice(1).join('|').trim()
                } : {
                    id: "ID?",
                    nama: baris.trim()
                };
            }
        }).filter(user => user.nama !== "");
    }

    function generateJadwal() {
        const bulanTahunInput = document.getElementById('bulanTahun').value;
        const kuota = parseInt(document.getElementById('kuotaHarian').value) || 3;
        masterDaftarUser = dapatkanDaftarUserDariInput();

        if (!bulanTahunInput || masterDaftarUser.length === 0) {
            tingkatkanAlert("Harap isi bulan dan daftar user terlebih dahulu!", "danger");
            return;
        }
        if (masterDaftarUser.length < kuota) {
            tingkatkanAlert(`Jumlah user terdaftar kurang dari kuota harian (${kuota})!`, "warning");
            return;
        }

        // UPDATE: Judul statis tanpa nama cabang
        document.getElementById('judulHasil').innerText = `2. Hasil Jadwal Piket`;

        const [tahun, bulan] = bulanTahunInput.split('-');
        const jumlahHari = new Date(tahun, bulan, 0).getDate();

        document.getElementById('accordionJadwal').innerHTML = '';
        document.getElementById('alertPesan').innerHTML = '';
        document.getElementById('btnSimpan').disabled = false;
        document.getElementById('sectionJsonOutput').style.display = 'none';

        let userSudahPiketMingguIni = [];
        let nomorMinggu = 1;
        let dataMingguan = {};

        for (let hari = 1; hari <= jumlahHari; hari++) {
            const tanggalObj = new Date(tahun, bulan - 1, hari);
            const namaHari = tanggalObj.toLocaleDateString('id-ID', {
                weekday: 'long'
            });

            if (namaHari === "Senin" && hari !== 1) {
                nomorMinggu++;
                userSudahPiketMingguIni = [];
            }
            if (hari === 1) userSudahPiketMingguIni = [];

            if (!dataMingguan[nomorMinggu]) dataMingguan[nomorMinggu] = [];

            let petugasHariIni = [];
            let kandidatUser = [...masterDaftarUser];
            let userBelumPiket = kandidatUser.filter(u => !userSudahPiketMingguIni.some(s => s.id === u.id));

            for (let i = 0; i < kuota; i++) {
                let sumberPool = userBelumPiket.length >= (kuota - i) ? userBelumPiket : kandidatUser;
                if (sumberPool.length === 0) {
                    sumberPool = [...masterDaftarUser];
                }

                const indexAcak = Math.floor(Math.random() * sumberPool.length);
                const terpilih = sumberPool.splice(indexAcak, 1)[0];

                petugasHariIni.push(terpilih || {
                    id: '',
                    nama: ''
                });
                userSudahPiketMingguIni.push(terpilih);

                kandidatUser = kandidatUser.filter(u => u.id !== terpilih.id);
                userBelumPiket = userBelumPiket.filter(u => u.id !== terpilih.id);
            }

            const idHariContainer = `petugas-hari-${hari}`;
            let slotPetugasHTML = '';
            for (let j = 0; j < kuota; j++) {
                slotPetugasHTML += buatBarisPetugasHTML(petugasHariIni[j].id, petugasHariIni[j].nama);
            }

            const kartuHariHTML = `
                <div class="col-md-6 mb-3 hari-piket-card" data-tanggal="${tahun}-${bulan}-${String(hari).padStart(2, '0')}" data-hari="${namaHari}">
                    <div class="card h-100 border-start border-primary border-4 p-3 bg-white">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <span class="badge bg-primary me-1">${namaHari}</span>
                                <span class="fw-bold text-dark">${hari} ${tanggalObj.toLocaleDateString('id-ID', { month: 'short' })}</span>
                            </div>
                            <button type="button" class="btn btn-outline-success btn-xs py-0 px-1" style="font-size:0.75rem;" onclick="tambahPetugasKeHari('${idHariContainer}')">+ Petugas</button>
                        </div>
                        <div class="vstack gap-1" id="${idHariContainer}">
                            ${slotPetugasHTML}
                        </div>
                    </div>
                </div>
            `;
            dataMingguan[nomorMinggu].push(kartuHariHTML);
        }

        for (const [minggu, listKartu] of Object.entries(dataMingguan)) {
            const isShow = minggu === "1" ? "show" : "";
            const isCollapsed = minggu === "1" ? "" : "collapsed";

            const itemAccordion = `
                <div class="accordion-item mb-2 border rounded">
                    <h2 class="accordion-header" id="headingMinggu${minggu}">
                        <button class="accordion-button ${isCollapsed}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMinggu${minggu}">
                            📅 Minggu ke-${minggu}
                        </button>
                    </h2>
                    <div id="collapseMinggu${minggu}" class="accordion-collapse collapse ${isShow}" data-bs-parent="#accordionJadwal">
                        <div class="accordion-body bg-light-subtle">
                            <div class="row row-cols-1 row-cols-md-2">
                                ${listKartu.join('')}
                            </div>
                        </div>
                    </div>
                </div>
            `;
            document.getElementById('accordionJadwal').insertAdjacentHTML('beforeend', itemAccordion);
        }
    }

    function buatBarisPetugasHTML(idTerpilih = '', namaTerpilih = '') {
        if (masterDaftarUser.length === 0) masterDaftarUser = dapatkanDaftarUserDariInput();

        let pilihanUserHTML = `<option value="" data-id="">-- Pilih Petugas --</option>`;
        masterDaftarUser.forEach(user => {
            const dipilih = (user.id === idTerpilih && user.nama === namaTerpilih) ? 'selected' : '';
            pilihanUserHTML += `<option value="${user.nama}" data-id="${user.id}" ${dipilih}>[${user.id}] | ${user.nama}</option>`;
        });

        return `
            <div class="input-group input-group-sm baris-petugas-input mb-1">
                <span class="input-group-text bg-secondary-subtle text-secondary-emphasis font-monospace label-id-piket" style="min-width: 80px; justify-content: center;">${idTerpilih || 'ID'}</span>
                <select class="form-select form-select-sm select-petugas-data" onchange="updateIdLabel(this)">
                    ${pilihanUserHTML}
                </select>
                <button class="btn btn-outline-danger" type="button" onclick="hapusPetugasIni(this)">&times;</button>
            </div>
        `;
    }

    function updateIdLabel(dropdownElement) {
        const opsiTerpilih = dropdownElement.options[dropdownElement.selectedIndex];
        const idUser = opsiTerpilih.getAttribute('data-id');
        const labelId = dropdownElement.closest('.baris-petugas-input').querySelector('.label-id-piket');
        if (labelId) labelId.textContent = idUser ? idUser : 'ID';
    }

    function tambahPetugasKeHari(containerId) {
        const container = document.getElementById(containerId);
        container.insertAdjacentHTML('beforeend', buatBarisPetugasHTML('', ''));
    }

    function hapusPetugasIni(tombol) {
        const baris = tombol.closest('.baris-petugas-input');
        if (baris) baris.remove();
    }

    function simpanDanExportJSON() {
        const semuaKartuHari = document.querySelectorAll('.hari-piket-card');
        let dataJadwalBulanIni = [];

        semuaKartuHari.forEach(kartu => {
            const tanggal = kartu.getAttribute('data-tanggal');
            const hari = kartu.getAttribute('data-hari');

            const semuaDropdownPetugas = kartu.querySelectorAll('.select-petugas-data');
            let daftarPetugas = [];

            semuaDropdownPetugas.forEach(select => {
                const opsiTerpilih = select.options[select.selectedIndex];
                const nama = select.value;
                const id = opsiTerpilih.getAttribute('data-id');

                if (nama && id) {
                    daftarPetugas.push({
                        id: id,
                        nama: nama
                    });
                }
            });

            dataJadwalBulanIni.push({
                tanggal: tanggal,
                hari: hari,
                jumlah_petugas: daftarPetugas.length,
                petugas: daftarPetugas
            });
        });

        // UPDATE: Properti 'cabang' dihapus dari output objek JSON
        const outputFinal = {
            total_hari: dataJadwalBulanIni.length,
            jadwal: dataJadwalBulanIni
        };
        $.ajax({
            url: "{{ route('master_piket_setup_save') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "jadwal": dataJadwalBulanIni,
            },
            dataType: 'html',
        }).done(function(data) {
            Swal.fire('Berhasil!', 'Data Jadwal Sudah dibuat', 'success').then(() => {
                // location.reload();
                console.log(dataJadwalBulanIni);
            });
        }).fail(function() {
            console.log('eror');
        });
        const jsonString = JSON.stringify(outputFinal, null, 4);
        document.getElementById('jsonOutput').value = jsonString;
        document.getElementById('sectionJsonOutput').style.display = 'block';

        document.getElementById('sectionJsonOutput').scrollIntoView({
            behavior: 'smooth'
        });


    }

    function salinJsonKeClipboard() {
        const jsonTextarea = document.getElementById('jsonOutput');
        jsonTextarea.select();
        navigator.clipboard.writeText(jsonTextarea.value);
        alert("Data JSON berhasil disalin ke clipboard!");
    }

    function tingkatkanAlert(pesan, tipe) {
        const alertPesan = document.getElementById('alertPesan');
        alertPesan.innerHTML = `<div class="alert alert-${tipe} alert-dismissible fade show" role="alert">
            ${pesan} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`;
    }

    function bersihkanForm() {
        document.getElementById('daftarUser').value = '';
        document.getElementById('accordionJadwal').innerHTML = '';
        document.getElementById('btnSimpan').disabled = true;
        document.getElementById('sectionJsonOutput').style.display = 'none';
        document.getElementById('judulHasil').innerText = '2. Hasil Jadwal Piket';
        document.getElementById('alertPesan').innerHTML = `<div class="alert alert-info">Silakan isi pengaturan di sebelah kiri, lalu klik tombol **Generate Otomatis**.</div>`;
        masterDaftarUser = [];
    }
</script>
@endsection
