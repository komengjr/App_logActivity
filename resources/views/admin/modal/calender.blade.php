<form action="#">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="form-group">
        <label for="input-1">Pilih Kinerja</label>

        <select name="txt_name" id="txt_name" class="form-control single-select">
            <option value="">Pilih Salah Satu</option>
            @foreach ($data as $item)
                <option value="{{$item->kd_kinerja}}" data-nama="{{$item->kinerja}}">{{$item->kinerja}}</option>
            @endforeach

        </select>
    </div>
    <div class="form-group">
        <label for="input-2">Batas Akhir</label>
        <input  type="date" name="title" id="date" class="form-control" placeholder="Enter Your Email Address" />
    </div>
    <div class="form-group">
        <label for="input-2">Keterangan</label>
        <textarea name="" class="form-control" id="" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <div class="icheck-material-warning">
            <input type="checkbox" id="user-checkbox1" />
            <label for="user-checkbox1">Remember me</label>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn-info form-control bg-info" data-dismiss="modal" id="simpan" >
            <i class="fa fa-save"></i> Simpan
        </button>
    </div>
</form>
<script>
    $(document).ready(function() {
        $('.single-select').select2();
      });

</script>

<script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

            $("#simpan").click(function() {

                var title = document.getElementById('txt_name').value;
                var tglskrng = document.getElementById('date').value;

                $("#calendar").fullCalendar("unselect");

            });

</script>
