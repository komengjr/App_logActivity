<form action="" method="post" id="formpostgroupbaru">
    @csrf
    <div class="row">
        <div class="col-6">
            <label for="">Kode Group</label>
            <input type="text" class="form-control" name="kd_group">
        </div>
       
        <div class="col-6">
            <label for="">Nama Group</label>
            <input type="text" class="form-control" name="nama_group">
        </div>
      
        <div class="col-12 mt-3">
            <div class="text-right">
                <button class="btn-success" id="simpandatagroupbaru" data-url="{{ url('masteradmin/datagroup/postdata/tambah', []) }}"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div>
    </div>
</form> 
