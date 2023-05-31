<div class="modal-content border-danger" >
    <div class="modal-header bg-info">
        <h5 class="modal-title text-white">Detail User</h5>
        <span>
            {{-- <button class="btn-success text-float-right" id="buttontambahworklistbaru" data-url="{{ url('masteradmin/dataworklist/tambah', []) }}"><i class="fa fa-plus"></i> Tambah User</button> --}}
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
                        <th>Worklist</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $user)
                        <tr>
                            <td>
                                    <i class="fa fa-user-circle-o"> </i>  - {{$user->name}}
                                {{-- <span class="list-group-item" >
                                    <div class="media align-items-center" style="text-decoration:none;">
                                    <div class="icon-box border ">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="media-body ml-3">
                                        <h6 class="mb-0">{{$user->name}}</h6>
                                    </div>
                                    <div class="date">Wrok List: 250</div>
                                    </div>
                                </span> --}}
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
                                    $cekdatatugasgrup = DB::table('tbl_tiket_group_worklist')
                                    ->where('id_user',$user->id_user)
                                    ->count();
                                    $cekdatatugaspersonal = DB::table('tbl_tiket_person_worklist')
                                    ->where('tbl_tiket_person_worklist.id_user',$user->id_user)
                                    ->count();
                                    $cekdatatugasgrupselesai = DB::table('tbl_tiket_group_worklist')
                                    ->where('id_user',$user->id_user)
                                    ->where('status_tiket',2)
                                    ->count();
                                    $cekdatatugaspersonalselesai = DB::table('tbl_tiket_person_worklist')
                                    ->where('tbl_tiket_person_worklist.id_user',$user->id_user)
                                    ->where('status_tiket',2)
                                    ->count();
                                    $total = $cekdatatugasgrup + $cekdatatugaspersonal ;
                                    $selesai = $cekdatatugasgrupselesai + $cekdatatugaspersonalselesai ;

                                @endphp
                                total : <button class="btn-social btn-outline-facebook btn-social-circle waves-effect waves-light m-1">{{$total}}</button> <br>
                                Selesai : <button class="btn-social btn-outline-facebook btn-social-circle waves-effect waves-light m-1">{{$selesai}}</button> <br>
                                tidak selesai : <button class="btn-social btn-outline-facebook btn-social-circle waves-effect waves-light m-1">{{$total-$selesai}}</button>
                            </td>
                            <td>
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
