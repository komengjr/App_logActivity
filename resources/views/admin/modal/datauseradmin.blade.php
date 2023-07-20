<div class="modal-content border-danger" >
    <div class="modal-header bg-info">
        <h5 class="modal-title text-white">
            <button class="btn-primary"><i class="fa fa-refresh"></i></button>
        </h5>
        <span>
            <button class="btn-success text-float-right" id="buttontambahuserbaru" ><i class="fa fa-plus"></i> Tambah User</button>
            <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </span>

    </div>
    <div class="modal-body" id="divtableuseradmin">
        <div class="row">
            <table class="styled-table" id="default-datatablex2">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Akses</th>
                        <th>Cabang</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $user)
                        <tr>
                            <td>
                                <i class="fa fa-user-circle-o"> </i>  - {{$user->name}}
                            </td>
                            <td>{{$user->email}}</td>
                            <td>
                                @if ($user->kd_akses == 3)
                                    User Leader
                                @elseif ($user->kd_akses == 4)
                                    User
                                @elseif ($user->kd_akses == 5)
                                    Verifikator
                                @endif
                            </td>
                            <td>
                                @php
                                    $cekbio = DB::table('tbl_biodata')
                                    ->join('tbl_cabang','tbl_cabang.kd_cabang','=','tbl_biodata.kd_cabang')
                                    ->where('id_user',$user->id_user)
                                    ->first();
                                @endphp
                                @if ($cekbio)
                                {{$cekbio->nama_cabang}}
                                @endif
                            </td>
                            <td class="text-center">
                              <div class="dropdown">
                                <button
                                  class="dropdown-toggle dropdown-toggle-nocaret btn-warning"
                                  data-toggle="dropdown">Option

                              </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                  <a class="dropdown-item" href="javascript:void();" id="buttonshowdetailuser" data-id="{{$user->id_user}}"><i class="fa fa-eye"></i> Show</a>

                                  <a class="dropdown-item" href="javascript:void();"><i class="fa fa-key"></i> Reset Password</a>
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

        $('#default-datatable').DataTable();
        var table = $('#example').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
        });
        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');

    });
</script>
