<div class="body p-3" id="divinputgroupworklist">  
        
</div>
<div class="body pt-2" >
    <table class="styled-table" id="default-datatable1">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Group</th>
                <th>Kode Worklist</th>
                <th>Nama Group</th>
                <th>Detail Worklist</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php $no=1; @endphp
            @foreach ($data as $data)
                <tr>
                  <td>{{$no++}}</td>
                  <td>{{$data->kd_group}}</td>
                  <td>{{$data->kd_worklist}}</td>
                  <td>{{$data->nama_group}}</td>
                  <td>{{$data->nama_worklist}}</td>
                  <td>{{$data->status_worklist}}</td>
                  <td class="text-center"><button class="btn-warning" id="buttoneditgroupworklist" data-url="{{ url('masteradmin/datagroupworklist/edit', ['id'=>$data->id_group_worklist]) }}"><i class="fa fa-pencil"></i></button></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {

        $('#default-datatable1').DataTable();
        var table = $('#example').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
        });
        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');

    });
</script>