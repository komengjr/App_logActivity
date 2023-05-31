<link href="{{ url('assets/plugins/select2/css/select2.min.css', []) }}" rel="stylesheet"/>
<div class="row">
    <div class="col-12 mt-2">
        <label for="">Pilih Kategori</label>
        <select name="kategori" id="kategori" class="form-control">
            <option value="-">Pilih</option>
            <option value="1">Individu</option>
            <option value="2">Group</option>

        </select>
    </div>
    <div class="col-12">
        <label for="">Pilih Kinerja</label>
        <select name="type_tiket" class="form-control single-select12" onchange="getDataOptionKinerja();" id="datakinerja" required>
            <option value="">Pilih Salah satu</option>
            @foreach ($kinerja as $item)
            <option value="{{$item->kd_kinerja}}">{{$item->kinerja}}</option>
            @endforeach

        </select>
    </div>
</div>
<div class="body" id="optionkinerjaadmin">

</div>

<script src="{{ url('assets/plugins/select2/js/select2.min.js', []) }}"></script>
<script>
    $(document).ready(function() {
        $('.single-select12').select2();




      });

</script>
