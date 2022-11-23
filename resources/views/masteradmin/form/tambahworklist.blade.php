<form action="" method="post" id="formpostworklistbaru">
    @csrf
    <div class="row">
        {{-- <div class="col-4">
            <label for="">Kode Worklist</label>
            <input type="text" class="form-control" name="kd_worklist">
        </div> --}}
       
        <div class="col-12 col-lg-6 col-xl-6">
            <label for="">Nama Worklist</label>
            <input type="text" class="form-control" name="nama_worklist">
        </div>
        <div class="col-12 col-lg-6 col-xl-6">
            <label for="">Point Worklist</label>
            <input type="number" class="form-control" name="point_worklist">
        </div>
        <div class="col-12 col-lg-6 col-xl-6">
            <label for="">Type Worklist</label>
            <select name="type" id="" class="form-control">
                <option value="">Pilih Type</option>
                @foreach ($type as $type)
                <option value="{{$type->type_worklist}}">{{$type->kriteria_worklist}}</option>
                @endforeach  
            </select>
        </div>
        <div class="col-12 col-lg-6 col-xl-6">
            <label for="">Type Worklist</label>
            <select name="jenis" id="" class="form-control">
                <option value="">Pilih Jenis</option>
                <option value="1">Personal</option>
                <option value="2">Group</option>
                 
            </select>
        </div>
      
        <div class="col-12 mt-3">
            <div class="text-right">
                <button class="btn-success" id="simpandataworklistbaru" data-url="{{ url('masteradmin/dataworklist/postdata/tambah', []) }}"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div>
    </div>
</form> 