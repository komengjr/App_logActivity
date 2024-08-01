<div class="modal-header bg-dark">
    <h5 class="modal-title text-white">
        Laporan Rencana Maintenance
    </h5>
    <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"><i class="fa fa-times"></i></span>
    </button>
</div>
<div class="modal-body bg-white">
    <table id="table-rencana" class="styled-table table-striped table-bordered" style="width:100%; text-align: left;"
        border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Periode</th>
                <th>Tanggal Awal Periode</th>
                <th>Tanggal Akhir Periode</th>
                <th>Verifikator</th>
                <th>Cabang</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($data as $data)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$data->periode}}</td>
                <td>{{$data->awal_periode}}</td>
                <td>{{$data->akhir_periode}}</td>
                <td>{{$data->verifikator}}</td>
                <td>{{$data->nama_cabang}}</td>
                <td>{{$data->status_schedule_maintenance}}</td>
                <td>
                    <button class="btn-dark"><i class="fa fa-print"></i></button>
                    <button class="btn-warning"><i class="fa fa-print"></i></button>
                    <button class="btn-primary"><i class="fa fa-print"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal-footer">

</div>
<script>
    $(document).ready(function() {
        //Default data table
        $('#default-datatable').DataTable();
        $('#default-datatable1').DataTable();
        $('#default-datatable2').DataTable();


        var table = $('#table-rencana').DataTable({
            lengthChange: false,
            // buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
        });

        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');

    });
</script>
