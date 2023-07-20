<div class="modal-content border-danger" >
    <div class="modal-header bg-info">
        <button class="btn-primary"><i class="fa fa-refresh"></i></button>
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
                        <th>Kinerja</th>
                        <th>Tanggal Start</th>
                        <th>Tanggal end</th>
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
                            <td>{{$item->kinerja}}</td>
                            <td>{{$item->tgl_start}}</td>
                            <td>{{$item->tgl_akhir}}</td>
                            <td class="text-center">
                                @if ($item->status_schedule == 1)

                                    @if (substr($item->tgl_akhir, 0, 10) < date('Y-m-d'))
                                    <span class="badge badge-danger badge-xl">Expierd</span>
                                    @else
                                    <span class="badge badge-danger badge-xl">Unfinished</span>
                                    @endif


                                @elseif ($item->status_schedule == 2)
                                <span class="badge badge-primary badge-xl">Proses</span>
                                @elseif ($item->status_schedule == 3)
                                <span class="badge badge-succes badge-xl">Done</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button
                                      class="dropdown-toggle dropdown-toggle-nocaret btn-warning"
                                      data-toggle="dropdown">Option

                                  </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                      <a class="dropdown-item" href="javascript:void();" id="buttonuserpengerjaantask" data-id="{{$item->kd_schedule}}"><i class="fa fa-eye"></i> Lihat Pengerjaan</a>
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
    {{-- <div class="modal-footer">
        <button type="button" class="btn-dark" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
    </div> --}}
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
