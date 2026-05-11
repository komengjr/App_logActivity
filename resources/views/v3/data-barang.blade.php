<div class="mb-3">
    <label class="form-label">Pilih Hardware</label>
    <select class="form-select select-search-barang" name="data_barang" required>
        <option value="">Cari Data...</option>
        @foreach ($newsData as $newsDatas)
        <option value="{{ $newsDatas->inventaris_data_code }}">{{ $newsDatas->inventaris_data_number }} - {{ $newsDatas->inventaris_data_name }}</option>
        @endforeach
    </select>
    <div class="error-msg">Silakan pilih Data.</div>
</div>
<script>
    $(document).ready(function() {
        // Inisialisasi Select2
        $('.select-search-barang').select2({
            placeholder: "Ketik nama cabang...",
            allowClear: true
        });

        // FIX: Masalah Select2 hilang saat validasi/perpindahan step
        // Karena Select2 menyembunyikan element asli, kita perlu trigger ulang validasi
        $('.select-search-barang').on('change', function() {
            if (this.checkValidity()) {
                $(this).removeClass("is-invalid");
                $(this).next('.select2-container').find('.select2-selection').css('border-color', '#dee2e6');
                $(this).siblings(".error-msg").fadeOut();
            }
        });

        // ... sisanya adalah script wizard kamu yang sudah ada ...
    });
</script>
