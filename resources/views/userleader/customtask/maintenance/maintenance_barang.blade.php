<div class="table-responsive">
    <table id="default-datatable" class="table table-bordered">
        <thead>
            <tr style="background: rgb(53, 161, 161);">
                <th>No</th>
                <th>Nama Barang</th>
                <th>No Inventaris</th>
                <th>Spesifikasi</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($newsData as $newsData)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $newsData->nama_barang }}</td>
                    <td>{{ $newsData->no_inventaris }}</td>
                    <td>
                        {{ $newsData->merk }}
                        <br>{{ $newsData->type }}
                        <br>{{ $newsData->no_seri }}
                    </td>
                    <td>
                        <button class="btn-primary" id="button-pilih-barang-maintenance" data-id="{{$newsData->id_inventaris}}" data-nama="{{$newsData->nama_barang}}" data-no="{{$newsData->no_inventaris}}"><i class="fa fa-pencil"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
     //Default data table
      $('#default-datatable').DataTable();


      var table = $('#example').DataTable( {
       lengthChange: false,
       buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis' ]
     } );

    table.buttons().container()
       .appendTo( '#example_wrapper .col-md-6:eq(0)' );

     } );

   </script>

