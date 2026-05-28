<div class="mb-4">
    <label class="form-label fw-semibold d-block text-secondary mb-2">
        <i class="fas fa-box me-1"></i> Pilih Inventaris untuk Bulan Terpilih:
    </label>

    <!-- INPUT PENCARIAN BARANG -->
    <div class="input-group mb-2 shadow-sm">
        <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-search"></i></span>
        <input type="text" id="searchBarang" class="form-control border-start-0 ps-0" placeholder="Cari Nama atau ID Barang..." onkeyup="filterCheckboxInventaris()">
    </div>

    <!-- BOX CONTAINER CHECKBOX DENGAN SCROLLBAR FIXED -->
    <div class="scrollable-checkbox-container" id="containerCheckbox">
        <!-- Item 1 -->
        @foreach ($data as $datas)
        <div class="form-check mb-2 item-wrapper" data-id="{{ $datas->inventaris_data_code }}" data-nama="{{ $datas->inventaris_data_name }}">
            <input class="form-check-input check-barang" type="checkbox" value="Genset Utama 500KVA" data-id="{{ $datas->inventaris_data_code }}" id="{{ $datas->inventaris_data_code }}">
            <label class="form-check-label fw-medium" for="{{ $datas->inventaris_data_code }}">
                <span class="badge bg-secondary text-white badge-id me-1">{{ $datas->inventaris_data_code }}</span> {{ $datas->inventaris_data_name }}
            </label>
        </div>
        @endforeach
        <!-- Item 2 -->
        <div class="form-check mb-2 item-wrapper" data-id="MNT-002" data-nama="AC Central (Chiller)">
            <input class="form-check-input check-barang" type="checkbox" value="AC Central (Chiller)" data-id="MNT-002" id="b2">
            <label class="form-check-label fw-medium" for="b2">
                <span class="badge bg-secondary text-white badge-id me-1">MNT-002</span> AC Central (Chiller)
            </label>
        </div>
        <!-- Item 3 -->
        <div class="form-check mb-2 item-wrapper" data-id="MNT-003" data-nama="Pompa Hidran Kebakaran">
            <input class="form-check-input check-barang" type="checkbox" value="Pompa Hidran Kebakaran" data-id="MNT-003" id="b3">
            <label class="form-check-label fw-medium" for="b3">
                <span class="badge bg-secondary text-white badge-id me-1">MNT-003</span> Pompa Hidran Kebakaran
            </label>
        </div>
        <!-- Item 4 -->
        <div class="form-check mb-2 item-wrapper" data-id="MNT-004" data-nama="Lift Penumpang Utama">
            <input class="form-check-input check-barang" type="checkbox" value="Lift Penumpang Utama" data-id="MNT-004" id="b4">
            <label class="form-check-label fw-medium" for="b4">
                <span class="badge bg-secondary text-white badge-id me-1">MNT-004</span> Lift Penumpang Utama
            </label>
        </div>
        <!-- Item 5 -->
        <div class="form-check mb-2 item-wrapper" data-id="MNT-005" data-nama="Panel Listrik LVMDP">
            <input class="form-check-input check-barang" type="checkbox" value="Panel Listrik LVMDP" data-id="MNT-005" id="b5">
            <label class="form-check-label fw-medium" for="b5">
                <span class="badge bg-secondary text-white badge-id me-1">MNT-005</span> Panel Listrik LVMDP
            </label>
        </div>
        <!-- Item 6 -->
        <div class="form-check item-wrapper" data-id="MNT-006" data-nama="Sistem CCTV Server">
            <input class="form-check-input check-barang" type="checkbox" value="Sistem CCTV Server" data-id="MNT-006" id="b6">
            <label class="form-check-label fw-medium" for="b6">
                <span class="badge bg-secondary text-white badge-id me-1">MNT-006</span> Sistem CCTV Server
            </label>
        </div>

        <!-- Notifikasi Status -->
        <div id="notifSemuaTerpilih" class="text-muted text-center py-2 small" style="display: none;">
            <i class="bi bi-lock-fill text-warning d-block fs-4 mb-1"></i> Semua barang sudah terjadwal di bulan lain.
        </div>
        <div id="notifTidakDitemukan" class="text-muted text-center py-2 small" style="display: none;">
            <i class="bi bi-patch-question text-secondary d-block fs-4 mb-1"></i> Barang tidak ditemukan.
        </div>
    </div>
</div>

<!-- Tombol Submit -->
<button type="submit" id="btnSubmit" class="btn btn-primary w-100 fw-bold py-2">
    <i class="bi bi-plus-square me-1"></i> Tambahkan ke Rencana
</button>
