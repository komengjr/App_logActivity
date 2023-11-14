<div class="modal-header bg-primary">
    <h5 class="modal-title text-white">
        Laporan Kinerja
    </h5>
    <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form method="post" enctype="multipart/form-data" id="form-laporan-user">
    @csrf
    <div class="modal-body">
        <table class="styled-table" id="default-datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tugas</th>
                    <th>Tanggal Penugasan</th>
                    <th>Penyelesaian</th>
                    <th>Waktu Penyelesaian</th>
                </tr>
            </thead>
        </table>
    </div>
    <div class="modal-footer">

    </div>
</form>

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
