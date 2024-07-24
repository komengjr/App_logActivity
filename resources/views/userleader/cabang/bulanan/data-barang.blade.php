<form class="row g-3" id="form-post-data-inventaris-maintenance-perangkat">
    @csrf
    <div class="row m-1">
        <div class="col-md-6">
            <label for="">No Inventaris</label>
            <input type="text" class="form-control" name="no_inventaris" id="" value="{{ $no }}">
        </div>
        <div class="col-md-6">
            <label for="">Nama Inventaris</label>
            <input type="text" class="form-control" name="nama_inventaris" id=""
                value="{{ $nama }}">
        </div>
        <div class="col-md-6">
            <label for="">Type</label>
            <input type="text" class="form-control" name="no_inventaris" id="" value="{{ $type }}">
        </div>
        <div class="col-md-6">
            <label for="">Tanggal Maintenance</label>
            <input type="date" class="form-control" name="tgl_maintenance" id="">
        </div>
        <div class="col-12 pt-4">
            <button type="button" class="btn-primary" id="button-save-pilih-barang-maintenance"><i
                    class="fa fa-save"></i>
                Simpans</button>
        </div>
    </div>
</form>
<script>

</script>
