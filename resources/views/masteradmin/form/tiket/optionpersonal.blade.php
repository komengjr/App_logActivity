 <form action="{{ url('masteradmin/buattiket/personal', []) }}" method="post">
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
            <label for="">Pilih Personal</label>    
            <select id="" class="form-control single-select" name="id_user" required>
                    <option value="">Pilih User</option>
                    <option value="all">All Personal</option>
                @foreach ($person as $person)
                    <option value="{{$person->id_user}}">{{$person->name}}</option>
                @endforeach
            </select>
        </div>  
        <div class="col-12 mt-4 text-right" >
        <button class="btn-info"><i class="fa fa-save"></i> Tambah Tugas</button>
        </div>
    </div>  
</form>
<script>
    $(document).ready(function() {
        $('.single-select').select2();
      });

</script>
