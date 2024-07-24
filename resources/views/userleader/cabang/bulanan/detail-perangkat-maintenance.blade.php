<div class="card p-2">
    <form id="form-post-data-inventaris-maintenance-perangkat">
        @csrf
        <div class="row m-1">
            <div class="col-lg-6">
                <label for="">No Inventaris</label>
                <input type="text" class="form-control" name="no_inventaris" id="" >

            </div>
            <div class="col-lg-6">
                <label for="">Nama Inventaris</label>
                <input type="text" class="form-control" name="nama_inventaris" id="" >

            </div>

            <div class="col-6 pt-4">
                <button type="button" class="btn-primary" id="button-save-pilih-barang-maintenance"><i
                        class="fa fa-save"></i>
                    Simpan</button>
            </div>
        </div>
    </form>
</div>
<div class="card">
    <div class="card-header border-0">
        Nama Perangkat :

    </div>
    <div class="table-responsive pt-3 pb-3">
        <table class="table align-items-center table-flush" id="default-table-custom-task" border="1"
            style="text-align: justify;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Periode</th>
                    <th>Awal Periode</th>
                    <th>Akhir Periode</th>
                    <th>Verifikator</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {

        $('#default-table-custom-task').DataTable();

    });
</script>
