<div class="modal-content border-danger" >
    <div class="modal-header bg-info">
        <h5 class="modal-title text-white">Data Cabang : <strong style="color: black;"></strong></h5>
        <span>
            {{-- <button class="btn-success text-float-right" id="buttontambahworklistbaru" data-url="{{ url('masteradmin/dataworklist/tambah', []) }}"><i class="fa fa-plus"></i> Tambah User</button> --}}
            <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fa fa-close"></i></span>
            </button>
        </span>

    </div>
    <div class="modal-body">
        <form action="#" method="post" id="form-dashboard-admin">
            @csrf
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
        </form>
        <span id="show-modal-view-dashboard"></span>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn-primary" id="button-monitoring-user"><i class="fa fa-print"></i> View Monitoring</button>
        <button type="button" class="btn-primary"><i class="fa fa-print"></i> Cetak</button>
    </div>
</div>

<script>
    $(document).ready(function() {

        $('#default-datatable').DataTable();
        var table = $('#example').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
        });
        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');

    });
</script>
