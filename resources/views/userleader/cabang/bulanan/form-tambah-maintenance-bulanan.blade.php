<div class="card">
    <div class="card-body">
        <div class="card-title d-flex align-items-center">
            <div><i class="bx bxs-user me-1 font-22 text-white"></i>
            </div>
            <h5 class="mb-0">Form Periode</h5>
        </div>
        <hr>
        <form class="row g-3" id="form-post-maintenance-bulanan">
            @csrf
            <div class="col-md-12 mb-2">
                <label for="inputLastName2" class="form-label">Periode</label>
                <input type="text" class="form-control" name="periode" id="">
                <input type="text" class="form-control" name="kd_cabang" value="{{$id}}" hidden>
            </div>
            <div class="col-md-6 mb-2">
                <label for="inputLastName2" class="form-label">Awal Periode</label>
                <input type="date" class="form-control" name="awal_periode" id="">
            </div>
            <div class="col-md-6 mb-2">
                <label for="inputLastName2" class="form-label">Akhir Periode</label>
                <input type="date" class="form-control" name="akhir_periode" id="">
            </div>
            {{-- <div class="col-md-6">
                <label for="inputLastName2" class="form-label">Awal Periode</label>
                <select name="kategori_task" class="form-control single-select-kinerja" id="">
                    <option value="">Pilih Periode</option>
                    <option value="hardware">Januari</option>
                    <option value="software">Februari</option>
                </select>
            </div> --}}
            <div class="col-md-12 mb-2">
                <label for="inputLastName2" class="form-label">Verifikator</label>
                <div class="input-group"> <span class="input-group-text"><i class="fa fa-user-o"></i></span>
                    <input type="text" name="verifikator" class="form-control border-start-0" id="inputLastName2" placeholder="Sukiman">
                    {{-- <input type="text" name="kd_cabang" id="" value="{{$kd_cabang}}" hidden> --}}
                </div>
            </div>
            <div class="col-12 pt-3">
                <button type="button" id="button-tambah-maintenance-bulanan-send" class="btn btn-primary px-5">Simpan</button>
            </div>
        </form>
    </div>

</div>
<script>
    $(document).ready(function() {
        $('.single-select-kinerja').select2();
    });
</script>
