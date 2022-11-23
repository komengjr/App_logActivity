<div class="modal-header bg-info">
    <h5 class="modal-title text-white">Type Worklist</h5> 
    <span>
        <button class="btn-success text-float-right" id="buttontambahtypeworklistbaru" data-url="{{ url('masteradmin/datatypeworklist/tambah', []) }}"><i class="fa fa-plus"></i> Tambah Data</button>
        <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </span>
    
</div>
<div class="modal-body" id="divtabletypeworklist">
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
</div>
<div class="modal-footer">
    <button type="button" class="btn-dark" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
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