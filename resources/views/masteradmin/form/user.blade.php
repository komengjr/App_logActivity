<div class="modal-header bg-info">
    <h5 class="modal-title text-white">Data User</h5> 
    <span>
        <button class="btn-success text-float-right" id="buttontambahuserbaru" data-url="{{ url('masteradmin/datauser/tambah', []) }}"><i class="fa fa-plus"></i> Tambah User</button>
        <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </span>
    
</div>
<div class="modal-body" id="divtableuser">
    <div class="body p-3" id="divinputuser">  
        
    </div>
    <div class="body pt-2" >
        <table class="styled-table" id="default-datatable">
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
                @php
                    $no=1;
                @endphp
                @foreach ($data as $item)
                    <tr>
                        <td data-label='no'>{{$no++}}</td>
                        <td data-label="Username">{{$item->email}}</td>
                        <td data-label="Nama">{{$item->name}}</td>
                        <td data-label="Akses">{{$item->nama_akses}}</td>
                        <td>
                            <button class="btn-warning" id="editdatauserbaru" data-url="{{ url('masteradmin/datauser/edit', ['id'=>$item->id]) }}"><i class="fa fa-pencil"></i> edit</button>
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

        $('#default-datatable').DataTable();
        var table = $('#example').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
        });
        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');

    });
</script>