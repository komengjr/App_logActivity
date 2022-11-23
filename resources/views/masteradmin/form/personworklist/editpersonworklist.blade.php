<form action="" method="post" id="formpostpersonworklistbaru">
    @csrf
    <div class="row">
        <div class="col-2">
            <label for="">Id Worklist Person</label>
            <input type="text" class="form-control" name="id_worklist_person" value="{{$data[0]->id_worklist_person}}">
        </div>
       
        <div class="col-12 col-lg-6 col-xl-5">
            <label for="">Nama User</label>
            <select name="id_user" id="" class="form-control single-select">
                <option value="{{$data[0]->id_user}}">{{$data[0]->id_user}}</option>
                @foreach ($user as $user)
                <option value="{{$user->id_user}}">{{$user->name}}</option>
                @endforeach  
            </select>
        </div>
        <div class="col-12 col-lg-6 col-xl-5">
            <label for="">Data Worklist</label>
            <select name="kd_worklist" id="" class="form-control single-selectx">
                <option value="{{$data[0]->kd_worklist}}">{{$data[0]->kd_worklist}}</option>
                @foreach ($worklist as $worklist)
                <option value="{{$worklist->kd_worklist}}" style="font-size: 7px;">{{$worklist->nama_worklist}}</option>
                @endforeach  
            </select>
        </div>
      
        <div class="col-12 mt-3">
            <div class="text-right">
                <button class="btn-danger" id="hapusdatapersonworklistbaru" data-url="{{ url('masteradmin/datapersonworklist/postdata/hapus', []) }}"><i class="fa fa-trash"></i> Hapus</button>
                <button class="btn-info" id="editdatapersonworklistbaru" data-url="{{ url('masteradmin/datapersonworklist/postdata/edit', []) }}"><i class="fa fa-save"></i> Update</button>
            </div>
        </div>
    </div>
</form> 
<script>
    $(document).ready(function() {
        $('.single-select').select2();
        $('.single-selectx').select2();
      });

</script>