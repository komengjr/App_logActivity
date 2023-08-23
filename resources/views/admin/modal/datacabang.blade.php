<div class="modal-content border-danger">
    <div class="modal-header bg-info">
        <h5 class="modal-title text-white">
            <button class="btn-primary"><i class="fa fa-refresh"></i></button>
        </h5>
        <span>
            <button class="btn-success text-float-right" id="buttontambahcabangbaru"><i class="fa fa-plus"></i> Tambah
                Cabang</button>
            <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </span>

    </div>
    <div class="modal-body" id="divtablecabangadmin">
        <div class="row">
            <table class="styled-table" id="default-datatablex2">
                <thead>
                    <tr>
                        <th style="width: 2px;" class="text-center">No</th>
                        <th style="width: 300px;">Nama Cabang</th>
                        <th>User</th>
                        <th style="width: 200px;">Verifikator</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($datacabang as $datacabang)
                        <tr>
                            <td  class="text-center">{{ $no++ }}</td>
                            <td>
                                <i class="fa fa-home"> </i> - {{ $datacabang->nama_cabang }}
                            </td>

                            <td>
                                @php
                                    $user = DB::table('tbl_biodata')->where('kd_cabang',$datacabang->kd_cabang)->first();
                                @endphp
                                @if ($user)
                                <i class="fa fa-user-o"> </i> - {{$user->nama_lengkap}}
                                @endif
                            </td>
                            <td>
                                @php
                                    $verif = DB::table('users')->where('cabang',$datacabang->kd_cabang)->where('kd_akses','>','4')->get();
                                @endphp
                                @if ($verif->isEmpty())
                                @else
                                <table border="1" class="table">
                                    @foreach ($verif as $verif)
                                        @if ($verif->kd_akses == 5)
                                        <tr>
                                            <td>Verifikator</td>
                                            <td>:</td>
                                            <td>{{$verif->name}}</td>
                                        </tr>
                                        @elseif ($verif->kd_akses == 6)
                                        <tr>
                                            <td>Verify</td>
                                            <td>:</td>
                                            <td>{{$verif->name}}</td>
                                        </tr>
                                        @endif

                                    @endforeach
                                </table>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="dropdown-toggle dropdown-toggle-nocaret btn-warning"
                                        data-toggle="dropdown">Option

                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#" id="buttontambahverifikator" data-id="{{$datacabang->kd_cabang}}"><i class="fa fa-user"></i>
                                            Tambah Verifikator</a>


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

        $('#default-datatable').DataTable();
        var table = $('#example').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
        });
        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');

    });
</script>
