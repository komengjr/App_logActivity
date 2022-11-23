<div class="body p-3" id="divinputworklist">  
        
</div>
<div class="body pt-2" >
    <table class="styled-table" id="default-datatable">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Worklist</th>
                <th>Nama Worklist</th>
                <th>Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
           @foreach ($data as $data)
               <tr>
                    <td>{{$no++}}</td>
                    <td>{{$data->kd_worklist}}</td>
                    <td>{{$data->nama_worklist}}</td>
                    <td>
                        @php
                            $kriteria = DB::table('type_worklist')->where('type_worklist',$data->type_worklist)->get();
                        @endphp
                        {{$kriteria[0]->kriteria_worklist}}
                    </td>
                    <td><button class="btn-warning"><i class="fa fa-pencil"></i></button></td>
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