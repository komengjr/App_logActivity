<div class="modal-header bg-primary">
    <h5 class="modal-title text-white">
        Laporan User
    </h5>
    <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form method="post" enctype="multipart/form-data" id="form-laporan-user">
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
        <span id="show-laporan-user"></span>
    </div>
    <div class="modal-footer">
        <button class="btn-primary" id="submit-button-laporan-user">
            <i class="fa fa-print" ></i> Print Preview
        </button>
    </div>

</form>

<script>
    $(document).ready(function() {
        $('.single-select').select2();
      });
</script>
