<div class="modal-content border-danger" >
    <div class="modal-header bg-info">
        <h5 class="modal-title text-white">Data Semua Worklist :  </h5>
        <span>
            <button class="btn-success text-float-right" id="buttontambahtiketbaru"><i class="fa fa-plus"></i> Buat Tiket</button>
            <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </span>

    </div>
    <div class="modal-body" id="divtableworklist">
        <div class="row">
            <table class="styled-table" id="default-datatablex22">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Tiket</th>
                        <th>Deskripsi Tugas</th>
                        <th>Tanggal Buat</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($data as $item)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$item->no_tiket}}</td>
                            <td>{{$item->nama_worklist}}</td>
                            <td>{{$item->created_at}}</td>
                            <td class="text-center">
                                @if ($item->status_tiket == 0)
                                    <button disabled="disabled" class="btn btn-danger btn-sm">unfinished</button>
                                @elseif ($item->status_tiket == 1)
                                    <button disabled="disabled" class="btn btn-info btn-sm">Proses</button>
                                @elseif ($item->status_tiket == 2)
                                    <button disabled="disabled" class="btn btn-success btn-sm">finish</button>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button
                                      class="dropdown-toggle dropdown-toggle-nocaret btn-warning"
                                      data-toggle="dropdown">Option

                                  </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                      <a class="dropdown-item" href="javascript:void();" ><i class="fa fa-eye"></i> Show</a>
                                      <a class="dropdown-item" href="javascript:void();"><i class="fa fa-pencil"></i> Edit</a>
                                      <a class="dropdown-item" href="javascript:void();"><i class="fa fa-trash"></i> Hapus</a>
                                      {{-- <a class="dropdown-item" href="javascript:void();"
                                        >Something else here</a>
                                      <div class="dropdown-divider"></div>
                                      <a class="dropdown-item" href="javascript:void();"
                                        >Separated link</a> --}}
                                    </div>
                                </div>
                            </td>
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

        $('#default-datatablex22').DataTable();
        var table = $('#example').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
        });
        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');

    });
</script>
