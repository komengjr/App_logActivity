<form action="" method="post" id="formpostgroupuserbaru">
    @csrf
    <div class="row">
        <div class="col-12">
            <label for="">Nama User</label>
            <select class="form-control single-select" name="id_user">
                <option>Pilih Nama User</option>
                @foreach ($data as $item)
                @php
                    $cekdata = DB::table('group_user')
                    ->where('id_user',$item->id_user)
                    ->count();
                @endphp
                @if ($cekdata == 0)
                <option value="{{$item->id_user}}">{{$item->name}}</option>
                @endif
                    
                @endforeach
            </select>
            <input type="text" name="id" value="{{$id}}" id="" hidden>
        </div>
      
        <div class="col-12 mt-3">
            <div class="text-right">
                <button class="btn-success" id="simpandatagroupuserbaru" data-url="{{ url('masteradmin/datagroup/post/tambah/userbaru', []) }}"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div>
    </div>
</form> 
<script>
    $(document).ready(function() {
        $('.single-select').select2();
      });

</script>
