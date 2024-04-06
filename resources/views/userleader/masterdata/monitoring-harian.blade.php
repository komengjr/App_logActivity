<div class="modal-header bg-primary">
    <h5 class="modal-title text-white">
        Laporan Monitoring Harian
    </h5>
    <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form id="form-monitoring-harian">
    @csrf
    <div class="modal-body bg-white">
        @if (Auth::user()->kd_akses == 2)
        <div class="row pb-3">
            <div class="col-md-4">
                <label for="">Pilih Cabang</label>
                <select name="cabang" class="form-control single-select" id="">
                    <option value=""></option>
                    <option value="*">ALL</option>
                    @foreach ($cabang as $cabang)
                    <option value="{{$cabang->kd_cabang}}">{{$cabang->nama_cabang}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="">Start Date</label>
                <input type="date" name="start" id="" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="">End Date</label>
                <input type="date" name="end" id="" class="form-control">
            </div>
        </div>
        @else
        <div class="row pb-3">
            <div class="col-md-6">
                <label for="">Start Date</label>
                <input type="date" name="start" id="" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="">End Date</label>
                <input type="date" name="end" id="" class="form-control">
            </div>
        </div>
        @endif
        <span id="show-monitoring-harian"></span>
    </div>
</form>
    <div class="modal-footer">
        <button class="btn-primary" id="submit-button-laporan-user-coba">
            <i class="fa fa-print" ></i> Preview Backup Harian
        </button>
        <button class="btn-primary" id="button-privew-monitoring-harian">
            <i class="fa fa-print" ></i> Preview Laporan Kritis
        </button>
    </div>



<script>
    $(document).ready(function() {
        $('.single-select').select2();
      });
</script>
