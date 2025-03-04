<div class="modal-header bg-primary">
    <h5 class="modal-title text-white">
        Data Laporan
    </h5>
    <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    <div class="row pb-3">
        @if ($data)
        <div class="col-md-12">
            <label for="">Deskripsi Laporan</label>
            @php
                echo $data->deskripsi_laporan;
            @endphp
        </div>
        <div class="col-md-12">
            <label for="">Deskripsi Penyelesaian</label>
            @php
                echo $data->deskripsi_penyelesaian;
            @endphp
        </div>
        @else
            <span class="badge badge-danger">Data Tidak bisa di Baca</span>
        @endif

    </div>
    <span id="show-laporan-verifikator"></span>
</div>

<div class="modal-footer">

</div>



<script>
    $(document).ready(function() {
        $('.single-select').select2();
    });
</script>

