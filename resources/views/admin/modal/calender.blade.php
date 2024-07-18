<form action="#">

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="form-group">
        <label for="input-1">Pilih Kinerja Form</label>

        <select name="txt_name" id="txt_name" class="form-control single-select" onchange="getDataOptionKinerjax();">
            <option value="">Pilih Salah Satu</option>
            @foreach ($data as $item)
                <option value="{{ $item->kd_kinerja_detail }}">{{ $item->kinerja }} -  FORM : {{$item->kinerja_detail}}</option>
            @endforeach

        </select>
    </div>
    <div class="form-group">
        <label for="input-1">Pilih Tujuan Cabang</label>

        <select name="cabang" id="cabang" class="form-control single-select1">
            <option value="">Pilih Tujuan Cabang</option>
            @foreach ($cabang as $cabang)
                <option value="{{ $cabang->kd_cabang }}">{{ $cabang->nama_cabang }}</option>
            @endforeach

        </select>
    </div>
    <div class="body" id="optionkinerjaadminx">

    </div>
    <div class="form-group">
        <label>Date Range</label>
        <div id="dateragne-picker">
            <div class="input-daterange input-group">
                <input type="text" class="form-control" name="start" style="cursor: pointer;"
                    value="{{ $id }}" disabled />
                <div class="input-group-prepend">
                    <span class="input-group-text">Sampai</span>
                </div>
                <input type="text" name="date" class="form-control datepicker" id="date" autocomplete="off" />
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="input-2">Deskripsi Tugas</label>
        <textarea name="ket" class="form-control" id="ket" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <div class="icheck-material-warning">
            <input type="checkbox" id="user-checkbox1" />
            <label for="user-checkbox1">Remember me</label>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn-primary btn-block" data-dismiss="modal" id="simpan">
            <i class="fa fa-save"></i> Simpan
        </button>
    </div>
</form>
<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js', []) }}"></script>
<script src="{{ asset('assets/plugins/summernote/dist/summernote-bs4.min.js', []) }}"></script>
<script type="text/javascript">
    $('.single-select').select2();
    $('.single-select1').select2();


    $('#dateragne-picker .input-daterange').datepicker({
        autoclose: true,
        startDate: new Date('{{ $id }}'),
        todayHighlight: true
    });
    $('#ket').summernote({
        height: 400,
        tabsize: 2
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
<script>
    function getDataOptionKinerjax() {
        var datakinerja = document.getElementById('txt_name').value;
        // var kategori = document.getElementById('kategori').value;
        // e.preventDefault();
        // var url = $(this).data('url');
        // console.log(datakode);
        $.ajax({

                url: "admin/tiket/getdataoptionkinerjax/" + datakinerja,
                type: 'GET',
                dataType: 'html'
            })
            .done(function(data) {
                $('#optionkinerjaadminx').html(data);
            })
            .fail(function() {
                $('#optionkinerjaadminx').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                );
            });
    };
</script>
<script>
    var d = new Date();
    var hours = d.getHours();
    console.log("now:" + hours);



    $("#datepicker").click(function(e) {
        e.preventDefault();
    }).datepicker({
        dateFormat: "yy-mm-dd",
        beforeShowDay: function(date) {
            var date = '2023-05-01';
            return date.getDay() == 2 ? [false, " disabled"] : [true, " enabled"];
        }
    });
</script>
