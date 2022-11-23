<div class="body p-3 " id="divinputuser">  
        
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