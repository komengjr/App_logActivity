@extends('layouts.template')
@section('content')
<div class="card mb-3">
    <div class="card-body border-top">
        <div class="d-flex">
            <div class="flex-1">
                <h5 class="fw-bold text-dark"><i class="bi bi-calendar-week text-primary"></i>Backup Bulanan IT</h5>
                <p class="text-muted mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae veritatis ut repellat error fuga fugit ea facere, id quia dolorum delectus illo optio? Dignissimos velit, libero et aliquam veritatis cum..</p>
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-center g-3">


    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="col-lg-5">
        <div class="card shadow-sm border-0 rounded-3 mb-5">
            <div class="card-header bg-primary text-white pb-2 rounded-top-3">
                <h5 class="fw-bold text-white"><i class="fas fa-cloud-arrow-up-fill me-2"></i>Form Upload Backup Bulanan</h5>
            </div>
            <div class="card-body p-4">

                <form action="{{ route('menu_backup_bulanan_save') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    <div class="mb-3">
                        <label for="cabang" class="form-label fw-semibold">Cabang Perusahaan</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-building"></i></span>
                            <select class="form-select form-select-lg" id="cabang" name="cabang" required>
                                <option value="" selected disabled>Pilih Cabang Terlebih Dahulu...</option>
                                @foreach ($cabang as $cab)
                                <option value="{{ $cab->kd_cabang }}">{{ $cab->nama_cabang }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Silakan pilih cabang terlebih dahulu.</div>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-sm-6">
                            <label for="bulan" class="form-label fw-semibold">Bulan</label>
                            <select class="form-select" id="bulan" name="bulan" required>
                                <option value="" selected disabled>Pilih Bulan...</option>
                                @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $bln)
                                <option value="{{ $bln }}">{{ $bln }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <label for="tahun" class="form-label fw-semibold">Tahun</label>
                            <select class="form-select" id="tahun" name="tahun" required>
                                <option value="" selected disabled>Pilih Tahun...</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-semibold">Deskripsi / Catatan Backup</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Tuliskan detail info data..." required></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="screenshot" class="form-label fw-semibold">File Screenshot Bukti</label>
                        <input type="file" class="form-control" id="screenshot" name="screenshot" accept="image/*" required>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="reset" class="btn btn-danger px-3 text-white me-md-2">Reset</button>
                        <button type="submit" class="btn btn-primary px-3">Kirim Data Backup</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-dark text-white pb-2 rounded-top-3 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <h5 class="fw-bold text-white"><i class="fas fa-unlock-alt me-3"></i>Daftar Hasil Upload</h5>

                <div class="d-flex align-items-center gap-2">
                    <label for="filterCabang" class="text-white-50 small text-nowrap"><i class="bi bi-funnel-fill me-1"></i>Filter:</label>
                    <select class="form-select form-select-sm bg-secondary text-white border-0" id="filterCabang" style="min-width: 180px;">
                        <option value="Semua">Semua Cabang</option>
                        @foreach ($cabang as $cab)
                        <option value="{{ $cab->kd_cabang }}">{{ $cab->nama_cabang }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="tabelBackup">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col" class="ps-3" style="width: 5%">#</th>
                                <th scope="col">Cabang</th>
                                <th scope="col">Periode</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Screenshot</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="panduanAwal">
                                <td colspan="5" class="text-center text-muted p-4">
                                    <i class="bi bi-arrow-up-circle me-1"></i> Silakan pilih cabang terlebih dahulu pada filter di atas untuk melihat data.
                                </td>
                            </tr>
                            @forelse($backups as $index => $backup)
                            <tr class="baris-data" data-cabang="{{ $backup->kd_cabang }}" style="display: none;">
                                <th scope="row" class="ps-3 nomor-urut">{{ $index + 1 }}</th>
                                <td><span class="fw-semibold nama-cabang">{{ $backup->kd_cabang }}</span></td>
                                <td>{{ $backup->nama_backup_bulanan }} {{ $backup->tahun_backup_bulanan }}</td>
                                <td><small class="text-muted">
                                        @php
                                        echo $backup->deskripsi;
                                        @endphp
                                    </small></td>
                                <td>
                                    @if ($backup->screenshot == "")

                                    @else
                                    <a href="{{ asset('storage/screenshots/' . $backup->screenshot) }}" target="_blank" class="btn btn-sm btn-outline-secondary py-1 px-2">
                                        <i class="bi bi-image me-1"></i>Lihat
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted p-4">Belum ada data backup yang diupload.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection
@section('base.js')
<script>
    // Script Validasi Bootstrap
    (() => {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
<script>
    document.getElementById('filterCabang').addEventListener('change', function() {
        const cabangTerpilih = this.value;
        const semuaBaris = document.querySelectorAll('.baris-data');
        const panduanAwal = document.getElementById('panduanAwal');
        const tidakDitemukan = document.getElementById('tidakDitemukan');

        // 1. Sembunyikan pesan panduan awal setelah user melakukan klik pertama kali
        if (panduanAwal) {
            panduanAwal.style.display = 'none';
        }

        let dataDitemukan = false;
        let nomorBaru = 1;

        // 2. Filter data berdasarkan cabang yang dipilih
        semuaBaris.forEach(baris => {
            const cabangBaris = baris.getAttribute('data-cabang');

            if (cabangBaris === cabangTerpilih) {
                baris.style.display = ''; // Tampilkan baris yang cocok

                // Urutkan kembali nomor tabel dari angka 1
                baris.querySelector('.nomor-urut').textContent = nomorBaru;
                nomorBaru++;

                dataDitemukan = true;
            } else {
                baris.style.display = 'none'; // Sembunyikan baris yang tidak cocok
            }
        });

        // 3. Tampilkan pesan jika cabang tersebut belum memiliki riwayat upload
        if (tidakDitemukan) {
            if (!dataDitemukan) {
                tidakDitemukan.style.display = '';
            } else {
                tidakDitemukan.style.display = 'none';
            }
        }
    });
</script>
@endsection
