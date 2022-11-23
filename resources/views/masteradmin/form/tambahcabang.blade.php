<form action="" method="post" id="formpostcabangbaru">
    @csrf
    <div class="row">
        <div class="col-4">
            <label for="">Kode Cabang</label>
            <input type="text" class="form-control" name="kd_cabang">
        </div>
       
        <div class="col-8">
            <label for="">Nama Cabang</label>
            <input type="text" class="form-control" name="nama_cabang">
        </div>
        <div class="col-6">
            <label for="">Latitude</label>
            <input type="text" class="form-control" name="latitude">
        </div>
       
        <div class="col-6">
            <label for="">longtitude</label>
            <input type="text" class="form-control" name="longtitude">
        </div>
        <div class="col-6">
            <label for="">City</label>
            <input type="text" class="form-control" name="city">
        </div>
        <div class="col-6">
            <label for="">Phone</label>
            <input type="text" class="form-control" name="phone">
        </div>
       
        <div class="col-12">
            <label for="">Alamat</label>
            <textarea name="alamat" id="" cols="30" rows="10" class="form-control"></textarea>
        </div>
      
        <div class="col-12 mt-3">
            <div class="text-right">
                <button class="btn-success" id="simpandatacabangbaru" data-url="{{ url('masteradmin/datacabang/postdata/tambah', []) }}"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div>
    </div>
</form> 