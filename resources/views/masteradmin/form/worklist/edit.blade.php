<form action="" method="post" id="formpostworklistedit">
    @csrf
    <div class="row">
        <div class="col-4">
            <label for="">Id Worklist</label>
            <input type="text" class="form-control" name="id" value="{{$data[0]->id_worklist}}">
        </div>
       
        <div class="col-12 col-lg-6 col-xl-8">
            <label for="">Nama Worklist</label>
            <input type="text" class="form-control" name="nama_worklist" value="{{$data[0]->nama_worklist}}">
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <label for="">Point Worklist</label>
            <input type="number" class="form-control" name="point_worklist" value="{{$data[0]->point_worklist}}">
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <label for="">Type Worklist</label>
            <select name="type" id="" class="form-control">
                <option value="{{$data[0]->type_worklist}}">{{$data[0]->type_worklist}}</option>
                @foreach ($type as $type)
                <option value="{{$type->type_worklist}}">{{$type->type_worklist}} - {{$type->kriteria_worklist}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <label for="">Type Worklist</label>
            <select name="jenis" id="" class="form-control">
                <option value="{{$data[0]->jenis_worklist}}">{{$data[0]->jenis_worklist}}</option>
                <option value="1">Personal</option>
                <option value="2">Group</option>
                 
            </select>
        </div>
      
        <div class="col-12 mt-3">
            <div class="text-right">
                <button class="btn-danger" id="hapusdataworklistbaru" data-url="{{ url('masteradmin/dataworklist/postdata/hapus', []) }}"><i class="fa fa-trash"></i> hapus</button>
                <button class="btn-info" id="editdataworklistbaru" data-url="{{ url('masteradmin/dataworklist/postdata/edit', []) }}"><i class="fa fa-save"></i> Update</button>
            </div>
        </div>
    </div>
</form> 