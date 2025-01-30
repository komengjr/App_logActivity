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
    $(document).on("click", "#submit-button-verifikator-user", function(e) {
        e.preventDefault();
        var data = $("#form-modal-verifikator-view").serialize();
        $("#show-laporan-verifikator").html(
            "<br><br><br><img src='loading.gif'  style='display: block; margin: auto;'>"
        );
        $.ajax({
                url: 'postverifikator/datagraphic/posttask',
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf"]').attr("content"),
                },
                type: "POST",
                data: data,
                dataType: "html",
            })
            .done(function(datapdf) {
                $("#show-laporan-verifikator").html('<iframe src="data:application/pdf;base64, ' + datapdf +
                    '" style="width:100%;; height:500px;" frameborder="0"></iframe>');
            })
            .fail(function() {
                $("#show-laporan-verifikator").html(
                    'Gagal Bacssa'
                );
            });
    });
</script>
