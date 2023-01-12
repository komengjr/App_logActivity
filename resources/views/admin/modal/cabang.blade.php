<div class="modal-content border-danger" >    
    <div class="modal-header bg-info">
        <h5 class="modal-title text-white">Data Cabang : <strong style="color: black;">{{$datacabang[0]->nama_cabang}}</strong></h5> 
        <span>
            {{-- <button class="btn-success text-float-right" id="buttontambahworklistbaru" data-url="{{ url('masteradmin/dataworklist/tambah', []) }}"><i class="fa fa-plus"></i> Tambah User</button> --}}
            <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </span>
        
    </div>
    <div class="modal-body" id="divtableworklist">
        <div class="body p-3" id="divinputworklist">  
            
        </div>
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
            
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javaScript:void();">Data Cabang</a></li>
                    <li class="breadcrumb-item"><a href="#" onclick="notifikasi();">Table</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Personal</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <table class="styled-table" id="default-datatablex">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Tiket</th>
                        <th>Nama Tugas</th>
                        <th>Nama User</th>
                        <th>Tanggal Tiket</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($tiket_personal as $tiket_personal)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$tiket_personal->no_tiket}}</td>
                            <td>{{$tiket_personal->nama_worklist}}</td>
                            <td>{{$tiket_personal->name}}</td>
                            <td>{{$tiket_personal->tgl_buat}}</td>
                            <td>
                                @if ($tiket_personal->status_tiket == 0)
                                    <button class="btn-danger" disabled>Belum Selesai</button>
                                @elseif($tiket_personal->status_tiket == 1)
        
                                @elseif($tiket_personal->status_tiket == 2)
                                <button class="btn-success" disabled>Selesai</button>
                                @endif
                            </td>
                            <td class="text-center"><button class="btn-info"><i class="fa fa-eye"></i></button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <hr>
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
        
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javaScript:void();">Data Cabang</a></li>
                    <li class="breadcrumb-item"><a href="#" onclick="notifikasi();">Table</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Group</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <table class="styled-table" id="default-datatablex1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Tiket</th>
                        <th>Nama Tugas</th>
                        <th>Nama User</th>
                        <th>Tanggal Tiket</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no=1;
                    @endphp
                    @foreach ($tiket_group as $tiket_group)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$tiket_group->no_tiket}}</td>
                            <td>{{$tiket_group->nama_worklist}}</td>
                            <td>{{$tiket_group->name}}</td>
                            <td>{{$tiket_group->tgl_buat}}</td>
                            <td>
                                @if ($tiket_group->status_tiket == 0)
                                    <button class="btn-danger" disabled>Belum Selesai</button>
                                @elseif($tiket_group->status_tiket == 1)
        
                                @elseif($tiket_group->status_tiket == 2)
                                <button class="btn-success" disabled>Selesai</button>
                                @endif
                            </td>
                            <td><button class="btn-info"><i class="fa fa-eye"></i></button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <hr>
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
            
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javaScript:void();">Data Cabang</a></li>
                    <li class="breadcrumb-item"><a href="#" onclick="notifikasi();">Table</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Laporan</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <table class="styled-table" id="default-datatablex2">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Akses</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
        
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