<form action="" method="post" id="formpostgroupcabangbaru">
    @csrf
    <div class="row">
        <div class="col-12">
            <label for="">Nama Cabang</label>
            <select class="form-control single-select" name="kd_cabang">
                <option>Pilih Cabang</option>
                @foreach ($data as $item)
                @php
                    $cekdata = DB::table('handler_cabang')
                    ->where('kd_cabang',$item->kd_cabang)
                    ->count();
                @endphp
                @if ($cekdata == 0)
                <option value="{{$item->kd_cabang}}">{{$item->nama_cabang}} - {{$item->city}}</option>
                @endif
                    
                @endforeach
            </select>
            <input type="text" name="id" value="{{$id}}" id="" hidden>
        </div>
      
        <div class="col-12 mt-3">
            <div class="text-right">
                <button class="btn-success" id="simpandatagroupcabangbaru" data-url="{{ url('masteradmin/datagroup/post/tambah/cabangbaru', []) }}"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div>
    </div>
</form> 
<script>
    $(document).ready(function() {
        $('.single-select').select2();
      });

</script>
