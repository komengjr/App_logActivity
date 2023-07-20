<div class="modal-content border-danger">
    <div class="modal-header bg-info">
        <h5 class="modal-title text-white">Data Group</h5>
        <span>
            <button class="btn-success text-float-right" id="buttontambahgroupbaru"><i class="fa fa-plus"></i> Tambah
                Group</button>
            <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </span>

    </div>
    <div id="menugroup"></div>
    <div class="modal-body" id="divtableworklist">
        <div class="row">
            <table class="styled-table" id="default-datatablex2">
                <thead>
                    <tr>
                        <th style="width: 10px;">No</th>
                        <th>Nama Group</th>
                        <th>User Cabang</th>
                        <th>Cabang</th>

                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($data as $item)
                        <tr>
                            <td style="width: 10px;">{{ $no++ }}</td>
                            <td>{{ $item->nama_group }}</td>
                            @php
                                $user = DB::table('users')
                                    ->join('group_user', 'group_user.id_user', '=', 'users.id_user')
                                    ->where('group_user.kd_group', $item->kd_group)
                                    ->get();
                            @endphp
                            <td>
                                @foreach ($user as $user)
                                    <li><strong>{{ $user->name }}</strong> Sebagai
                                        @if ($user->kd_akses == 3)
                                            <strong>Leader User</strong>
                                        @else
                                            <strong>User</strong>
                                        @endif
                                    </li>
                                @endforeach
                            </td>

                            <td>
                                @php
                                    $cabang = DB::table('tbl_cabang')
                                        ->join('handler_cabang', 'handler_cabang.kd_cabang', '=', 'tbl_cabang.kd_cabang')
                                        ->where('handler_cabang.kd_group', $item->kd_group)
                                        ->get();
                                @endphp
                                @foreach ($cabang as $cabang)
                                    <li>{{ $cabang->nama_cabang }}
                                        @php
                                            $cekusercabang = DB::table('users')
                                                ->join('tbl_biodata', 'tbl_biodata.id_user', '=', 'users.id_user')
                                                ->where('tbl_biodata.kd_cabang', $cabang->kd_cabang)
                                                ->get();
                                        @endphp
                                        @if ($cekusercabang->isEmpty())
                                            <a href=""><i class="fa fa-plus"></i></a>
                                        @else
                                            ({{ $cekusercabang[0]->nama_lengkap }})
                                        @endif

                                    </li>
                                @endforeach
                            </td>

                            <td class="text-center">
                                <div class="dropdown p-1">
                                    <button class="dropdown-toggle dropdown-toggle-nocaret btn-primary"
                                        data-toggle="dropdown"><i class="fa fa-plus"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="javascript:void();" id="buttonusertable"
                                            data-id="{{ $item->kd_group }}"><i class="fa fa-cog"></i> Tambah User</a>
                                        <a class="dropdown-item" href="javascript:void();" id="buttoncabangtable"
                                            data-id="{{ $item->kd_group }}"><i class="fa fa-cog"></i> Tambah Cabang</a>
                                    </div>
                                </div>
                                <div class="dropdown p-1">
                                    <button class="dropdown-toggle dropdown-toggle-nocaret btn-danger"
                                        data-toggle="dropdown"><i class="fa fa-trash"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="javascript:void();" id="buttonusertable"
                                            data-id="{{ $item->kd_group }}"><i class="fa fa-cog"></i> Tambah User</a>
                                        <a class="dropdown-item" href="javascript:void();" id="buttoncabangtable"
                                            data-id="{{ $item->kd_group }}"><i class="fa fa-cog"></i> Tambah Cabang</a>
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
