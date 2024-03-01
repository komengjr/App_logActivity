<div class="modal-content border-danger">
    <div class="modal-header bg-info">
        <h5 class="modal-title text-white">
            <span class="badge badge-secondary p-2">{{$data->nama_cabang}}</span>
        </h5>
        <span>
            <button class="btn-success text-float-right" id="button-tambah-user-handle-cabang" data-id="{{$data->kd_cabang}}"><i class="fa fa-plus"></i> Handle User</button>
            <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </span>

    </div>
    <div class="modal-body" id="menu-data-user-handle-cabang">
        <div class="row" >
            <table class="styled-table" id="default-datatablex2">
                <thead>
                    <tr>
                        <th style="width: 2px;" class="text-center">No</th>
                        <th>User</th>
                        <th>Tanggal Handle Cabang</th>
                        <th>Tanggal Buat</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no =1;
                    @endphp
                    @foreach ($datarecord as $item)
                        <tr>
                            <td  style="width: 2px;">{{$no++}}</td>
                            <td>{{$item->nama_lengkap}}</td>
                            <td>{{$item->tgl_hendler_backup}}</td>
                            <td>{{$item->created_at}}</td>
                            <td><button class="btn-warning">edit</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <script>
            $(document).ready(function() {

                $('#default-datatablex').DataTable();
                $('#default-datatablex1').DataTable();
                $('#default-datatablex2').DataTable();
                var table = $('#example').DataTable({
                    lengthChange: false,
                    buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
                });
                table.buttons().container()
                    .appendTo('#example_wrapper .col-md-6:eq(0)');

            });
        </script>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn-dark" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
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
