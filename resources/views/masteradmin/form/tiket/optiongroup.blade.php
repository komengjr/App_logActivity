<form action="{{ url('masteradmin/buattiket/group', []) }}" method="post">
    @csrf
    <div class="row">
        <div class="col-12 mt-2">
            <label for="">Pilih Tugas</label>    
            <select id="" class="form-control single-select" name="kd_tugas" required>
                    <option value="">Pilih Tugas</option>
                    <option value="all">All Tugas</option>
                @foreach ($data as $data)
                    <option value="{{$data->kd_worklist}}">{{$data->nama_worklist}}</option>
                @endforeach
            </select>
        </div>  
        <div class="col-12 mt-2">
            <label for="">Pilih Group Cabang</label>    
            <select id="" class="form-control single-select" name="kd_group" required>
                    <option value="">Pilih Group</option>
                    <option value="all">All Group</option>
                @foreach ($group as $group)
                    <option value="{{$group->kd_group}}">{{$group->nama_group}} - {{$group->nama_cabang}}</option>
                @endforeach
            </select>
        </div>  
        <div class="col-12 mt-4 text-right" >
        <button class="btn-info"><i class="fa fa-save"></i> Tambah Tugas Group</button>
        </div>
    </div>  
</form>
<script>
    $(document).ready(function() {
        $('.single-select').select2();
      });

</script>
