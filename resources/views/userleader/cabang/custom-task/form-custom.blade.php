<div class="card">
    <div class="card-body">
        <div class="card-title d-flex align-items-center">
            <div><i class="bx bxs-user me-1 font-22 text-white"></i>
            </div>
            <h5 class="mb-0">Form Custom</h5>
        </div>
        <hr>
        <form class="row g-3" id="form-post-custom-task">
            @csrf
            <div class="col-md-6">
                <label for="inputLastName1" class="form-label">Point Kinerja</label>

                    <select name="kd_kinerja" class="form-control single-select-kinerja" id="">
                        <option value="">Pilih Point Kinerja</option>
                        @foreach ($kinerja as $kinerja)
                            <option value="{{$kinerja->kd_kinerja}}">{{$kinerja->kinerja}}</option>
                        @endforeach
                    </select>

            </div>
            <div class="col-md-6">
                <label for="inputLastName2" class="form-label">Kategori</label>
                <select name="kategori_task" class="form-control single-select-kinerja" id="">
                    <option value="">Pilih Kategori</option>
                    <option value="hardware">Hardware</option>
                    <option value="software">Software</option>
                </select>
            </div>
            <div class="col-md-12">
                <label for="inputLastName2" class="form-label">Judul Tugas</label>
                <div class="input-group"> <span class="input-group-text"><i class="fa fa-cog"></i></span>
                    <input type="text" name="judul_task" class="form-control border-start-0" id="inputLastName2" placeholder="Maintenance Bulanan">
                    <input type="text" name="kd_cabang" id="" value="{{$kd_cabang}}" hidden>
                </div>
            </div>

            <div class="col-12">
                <label for="inputAddress3" class="form-label">Deskripsi Tugas</label>
                <textarea class="form-control" name="desk_task" id="inputAddress3" placeholder="Maintenance Bulanan Alat Inventaris" rows="3"></textarea>
            </div>

            <div class="col-12 pt-3">
                <button type="button" id="button-simpan-custom-task-user" class="btn btn-primary px-5">Simpan</button>
            </div>
        </form>
    </div>

</div>
<script>
    $(document).ready(function() {
        $('.single-select-kinerja').select2();
    });
</script>
