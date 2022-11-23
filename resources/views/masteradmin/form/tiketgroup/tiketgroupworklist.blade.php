<div class="modal-header bg-info">
    <h5 class="modal-title text-white">Data Tiket Group Worklist</h5> 
    <span>
        {{-- <button class="btn-success text-float-right" id="buttontambahuserbaru" data-url="{{ url('masteradmin/datauser/tambah', []) }}"><i class="fa fa-plus"></i> Tambah User</button> --}}
        <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </span>
    
</div>
<div class="modal-body" id="divtableuser">
    <div class="body p-3" id="divinputuser">  
        
    </div>
    <div class="body pt-2" >
        <table class="styled-table" id="default-tiketgroupworklist">
            <thead>
                <tr>
                    <th>No</th>
                    <th>no Tiket</th>
                    <th>Nama Worklist</th>
                    <th>Tgl Tugas</th>
                    <th>status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no=1;
                @endphp
                @foreach ($data as $data)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$data->no_tiket}}</td>
                    <td>{{$data->nama_worklist}}</td>
                    <td>{{$data->tgl_buat}}</td>
                    <td>{{$data->status_tiket}}</td>
                    <td class="text-center">
                        {{-- <button class="btn-warning" id="buttoneditgroupworklist" data-url="{{ url('masteradmin/datagroupworklist/edit', ['id'=>$data->id_group_worklist]) }}"><i class="fa fa-pencil"></i></button> --}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn-dark" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
</div>
<script>
    $(document).ready(function() {

        $('#default-tiketgroupworklist').DataTable();
        var table = $('#group1').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
        });
        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');

    });
</script>