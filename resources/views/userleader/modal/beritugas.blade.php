<div class="modal-header bg-primary">
    <h5 class="modal-title text-white">
        Task baru
    </h5>
    <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form action="{{ asset('user/userleader/buattikettask') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <div class="col">
            <label for="">User Cabang</label>
            <select name="usercabang" id="" class="form-control single-select" required>
                <option value="">Pilih User Cabang</option>
                @foreach ($groupcabang as $groupcabang)
                    <option value="{{ $groupcabang->kd_cabang }}">{{ $groupcabang->nama_cabang }}</option>
                @endforeach
            </select>
        </div>
        <div class="col">
            <label for="">Task</label>
            <select name="kd_kinerja" class="form-control single-select1" required>
                <option value="">Pilih Task Kinerja</option>
                @foreach ($kinerja as $item)
                    <option value="{{ $item->kd_kinerja }}">{{ $item->kinerja }}</option>
                @endforeach
            </select>
        </div>
        <div class="col">
            <label>Date Range</label>
            <div id="dateragne-picker">
                <div class="input-daterange input-group">
                    <input type="text" class="form-control" name="start" style="cursor: pointer;" required/>
                    <div class="input-group-prepend">
                        <span class="input-group-text">Sampai</span>
                    </div>
                    <input type="text" name="end" class="form-control datepicker" id="date" autocomplete="off" style="cursor: pointer;" required/>
                </div>
            </div>
        </div>
        <div class="col">
            <label for="">Penyelesaian</label>
            <textarea name="keterangan" class="form-control" id="summernoteEditor" cols="5" rows="10" required></textarea>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn-primary">
            <i class="fa fa-check-square-o"></i> Simpan
        </button>
    </div>

</form>
<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js', []) }}"></script>
<script src="{{ asset('assets/plugins/summernote/dist/summernote-bs4.min.js', []) }}"></script>
<script>
    $('#summernoteEditor').summernote({
        height: 400,
        tabsize: 2
    });
    $(document).ready(function() {
        $('.single-select1').select2();
        $('.single-select').select2();
    });
</script>

<script type="text/javascript">
    $('#dateragne-picker .input-daterange').datepicker({
        autoclose: true,
        startDate: new Date(),
        todayHighlight: true
    });
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
