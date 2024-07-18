@if ($data)
    <div class="form-group col-md-6 mb-0">
        <label for="">Nomor Tiket</label>
        <input type="text" class="form-control wizard-required" value="{{ $data->tiket_laporan }}" disabled>
        <div class="wizard-form-error"></div>
        <input type="text" class="form-control wizard-required" style="display: none">
    </div>
    <div class="form-group col-md-6 mb-0">
        <label for="">Nama Pembuat Laporan</label>
        <input type="text" class="form-control wizard-required" value="{{ $data->nama_user }}" disabled>
        <div class="wizard-form-error"></div>
        <input type="text" class="form-control wizard-required" style="display: none">
    </div>
    <div class="form-group col-md-6 mb-0">
        <label for="">NIP</label>
        <input type="text" class="form-control wizard-required" value="{{ $data->nip_user }}" disabled>
        <div class="wizard-form-error"></div>
        <input type="text" class="form-control wizard-required" style="display: none">
    </div>
    <div class="form-group col-md-6 mb-0">
        <label for="">Divisi</label>
        <input type="text" class="form-control wizard-required" value="{{ $data->divisi }}" disabled>
        <div class="wizard-form-error"></div>
        <input type="text" class="form-control wizard-required" style="display: none">
    </div>
    <div class="form-group col-md-6 mb-0">
        <label for="">Tanggal Buat</label>
        <input type="text" class="form-control wizard-required" value="{{ $data->tgl_laporan }}" disabled>
        <div class="wizard-form-error"></div>
        <input type="text" class="form-control wizard-required" style="display: none">
    </div>
    <div class="form-group col-md-6 mb-0">
        <label for="">Tanggal Selesai</label>
        <input type="text" class="form-control wizard-required" value="{{ $data->tgl_selesai_laporan }}" disabled>
        <div class="wizard-form-error"></div>
        <input type="text" class="form-control wizard-required" style="display: none">
    </div>
    <div class="form-group col-md-6 mb-0">
        <label for="">Kasus :</label>
        <br>
        @php
            echo $data->deskripsi_laporan;
        @endphp
    </div>
    <div class="form-group col-md-6 mb-0">
        <label for="">Penyelesaian</label>
        @if ($penyelesaian)
            <br>
            @php
                echo $penyelesaian->deskripsi_penyelesaian;
            @endphp
        @else
            <br>
            <span class="badge badge-warning">Belum Selesai</span>
        @endif
    </div>
@else
    <div class="form-group col-md-12 mb-0">
        <span class="badge badge-warning m-2">Data Tiket Tidak ditemukan !!</span>
    </div>
@endif
