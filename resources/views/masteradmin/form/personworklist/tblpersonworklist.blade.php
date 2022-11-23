<div class="body p-3" id="divinputpersonworklist">  
        
</div>
<div class="body pt-2" >
    <table class="styled-table" id="default-datatablepersonworklist">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode worklist</th>
                <th>ID User</th>
                <th>Nama User</th>
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
                <td>{{$data->kd_worklist}}</td>
                <td>{{$data->id_user}}</td>
                <td>{{$data->name}}</td>
                <td>{{$data->nama_worklist}}</td>
                <td>{{$data->status_worklist}}</td>
                <td class="text-center">
                    <button class="btn-warning" id="buttoneditdatapersonworklist" data-url="{{ url('masteradmin/datapersonworklist/edit', ['id'=>$data->id_worklist_person]) }}"><i class="fa fa-pencil"></i></button>
                </td>
              </tr>
          @endforeach
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {

        $('#default-datatablepersonworklist').DataTable();
        var table = $('#example').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
        });
        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');

    });
</script>