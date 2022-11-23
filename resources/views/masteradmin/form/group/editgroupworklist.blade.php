<form action="" method="post" id="formpostgroupworklistbaru">
    @csrf
    <div class="row">
        <div class="col-2">
            <label for="">Id Group Worklist</label>
            <input type="text" class="form-control" name="id_group_worklist" value="{{$data[0]->id_group_worklist}}">
        </div>
       
        <div class="col-12 col-lg-6 col-xl-5">
            <label for="">Nama Group</label>
            <select name="kd_group" id="" class="form-control single-select">
                <option value="{{$data[0]->kd_group}}">Pilih Group</option>
                @foreach ($group as $group)
                <option value="{{$group->kd_group}}">{{$group->nama_group}}</option>
                @endforeach  
            </select>
        </div>
        <div class="col-12 col-lg-6 col-xl-5">
            <label for="">Data Worklist</label>
            <select name="kd_worklist" id="" class="form-control single-selectx">
                <option value="{{$data[0]->kd_worklist}}">Pilih Type</option>
                @foreach ($worklist as $worklist)
                <option value="{{$worklist->kd_worklist}}" style="font-size: 7px;">{{$worklist->nama_worklist}}</option>
                @endforeach  
            </select>
        </div>
      
        <div class="col-12 mt-3">
            <div class="text-right">
                <button class="btn-danger" id="hapusdatagroupworklistbaru" data-url="{{ url('masteradmin/datagroupworklist/postdata/hapus', []) }}"><i class="fa fa-save"></i> hapus</button>
                <button class="btn-info" id="editdatagroupworklistbaru" data-url="{{ url('masteradmin/datagroupworklist/postdata/edit', []) }}"><i class="fa fa-save"></i> Update</button>
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