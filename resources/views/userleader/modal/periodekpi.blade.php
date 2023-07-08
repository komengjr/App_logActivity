<div class="modal-header bg-primary">
    <h5 class="modal-title text-white">
        Pilih Periode KPI
    </h5>
    <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form action="{{ asset('user/userleader/pdf/kpi') }}" target="print_popup" method="post" enctype="multipart/form-data" onsubmit="window.open('about:blank','print_popup','width=1000,height=800');">
    @csrf
    <div class="modal-body">

         <label for="">Pilih Periode</label>
         <select name="periode" id="" class="form-control single-select" required>
            <option value="">Pilih Periode KPI</option>
            @foreach ($tbl_periode as $tbl_periode)
                <option value="{{$tbl_periode->id_periode}}">{{$tbl_periode->bulan}} - {{$tbl_periode->tahun}}</option>
            @endforeach
         </select>

    </div>
    <div class="modal-footer">
        <button type="submit" class="btn-primary">
            <i class="fa fa-print"></i> Print Preview
        </button>
    </div>

</form>

<script>
    $(document).ready(function() {
        $('.single-select').select2();
      });
</script>
