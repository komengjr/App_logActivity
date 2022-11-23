<form action="" method="post" id="formposttypeworklistbaru">
    @csrf
    <div class="row">
        {{-- <div class="col-4">
            <label for="">Kode Worklist</label>
            <input type="text" class="form-control" name="kd_worklist">
        </div> --}}
       
        <div class="col-12 col-lg-6 col-xl-6">
            <label for="">kode Type Worklist</label>
            <input type="text" name="type_worklist" id="" class="form-control">
        </div>
        <div class="col-12 col-lg-6 col-xl-6">
            <label for="">Kriteria Worklist</label>
            <input type="text" name="kriteria_worklist" class="form-control">
        </div>
      
        <div class="col-12 mt-3">
            <div class="text-right">
                <button class="btn-success" id="simpandatatypeworklistbaru" data-url="{{ url('masteradmin/datatypeworklist/postdata/tambah', []) }}"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div>
    </div>
</form> 
