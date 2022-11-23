<div class="body p-3" id="divinputtypeworklist">  
        
</div>
<div class="body pt-2" >
    <table class="styled-table" id="default-datatable1">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Type Worklist</th>
                <th>kriteria Worklist</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
          @php $no=1; @endphp
          @foreach ($data as $data)
              <tr>
                <td>{{$no++}}</td>
                <td>{{$data->type_worklist}}</td>
                <td>{{$data->kriteria_worklist}}</td>
                <td class="text-center">
                    <button class="btn-warning"><i class="fa fa-pencil"></i></button>
                    <button class="btn-danger"><i class="fa fa-trash"></i></button>
                </td>
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