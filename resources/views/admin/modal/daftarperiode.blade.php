
<div class="modal-content border-danger" >
    <div class="modal-header bg-info">
        <h5 class="modal-title text-white">Data Periode</h5>
        <span>
            <button class="btn-success text-float-right" id="buttontambahperiodebaru"><i class="fa fa-plus"></i> Tambah Periode</button>
            <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </span>

    </div>
    <div class="modal-body" id="divtableworklist">
        <div class="row">
            <table class="styled-table" id="default-datatablex2">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Bulan</th>
                        <th>Tahun</th>
                        <th>Periode Awal</th>
                        <th>Periode Akhir</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no=1;
                    @endphp
                    @foreach ($dataperiode as $item)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$item->bulan}}</td>
                            <td>{{$item->tahun}}</td>
                            <td>{{$item->awal_tgl}}</td>
                            <td>{{$item->akhir_tgl}}</td>
                            <td><button class="btn-info"><i class="fa fa-copy"></i></button></td>
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
