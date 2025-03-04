<div class="modal-header bg-primary">
    <h5 class="modal-title text-white">
        Data Record
    </h5>
    <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form id="form-modal-verifikator-view">
    @csrf
    <div class="modal-body">
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
        <span id="show-laporan-verifikator"></span>
    </div>
</form>
<div class="modal-footer">
    {{-- <button class="btn-primary" id="submit-button-laporan-user-coba">
            <i class="fa fa-print" ></i> Print coba
        </button> --}}
    <button class="btn-primary" id="submit-button-verifikator-user-view">
        <i class="fa fa-print"></i> Preview
    </button>
    <button class="btn-dark" id="submit-button-verifikator-user">
        <i class="fa fa-print"></i> Print PDF
    </button>
</div>



<script>
    $(document).ready(function() {
        $('.single-select').select2();
    });
</script>
<script>

</script>
