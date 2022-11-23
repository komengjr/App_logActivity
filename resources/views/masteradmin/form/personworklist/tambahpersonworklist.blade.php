<form action="" method="post" id="formpostpersonworklistbaru">
    @csrf
    <div class="row">
        {{-- <div class="col-4">
            <label for="">Kode Worklist</label>
            <input type="text" class="form-control" name="kd_worklist">
        </div> --}}
       
        <div class="col-12 col-lg-6 col-xl-6">
            <label for="">Nama User</label>
            <select name="id_user" id="" class="form-control single-select">
                <option value="">Pilih User</option>
                @foreach ($user as $user)
                <option value="{{$user->id_user}}">{{$user->name}}</option>
                @endforeach  
            </select>
        </div>
        <div class="col-12 col-lg-6 col-xl-6">
            <label for="">Data Worklist</label>
            <select name="kd_worklist" id="" class="form-control single-selectx">
                <option value="">Pilih Type</option>
                @foreach ($worklist as $worklist)
                <option value="{{$worklist->kd_worklist}}" style="font-size: 7px;">{{$worklist->nama_worklist}}</option>
                @endforeach  
            </select>
        </div>
      
        <div class="col-12 mt-3">
            <div class="text-right">
                <button class="btn-success" id="simpandatapersonworklistbaru" data-url="{{ url('masteradmin/datapersonworklist/postdata/tambah', []) }}"><i class="fa fa-save"></i> Simpan</button>
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