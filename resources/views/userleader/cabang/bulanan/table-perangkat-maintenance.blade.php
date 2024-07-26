<table class="table align-items-center table-flush" id="default-table-custom-task" border="1"
    style="text-align: justify;">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Brang</th>
            <th>No Barang</th>
            <th>Tanggal Maintenances</th>
            {{-- <th>Status Petugas</th> --}}
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
                <td>{{$data->nama_inventaris}}</td>
                <td>{{$data->no_inventaris}}</td>
                <td>{{$data->tgl_maintenance_sub}}</td>
                {{-- <td>{{$data->status_maintenance_sub}}</td> --}}
                <td>
                    @if ($data->status_maintenance_sub == 0)
                    <button class="btn-warning" id="button-detail-perangkat-maintenance" data-id="{{$data->id_inventaris}}" data-kode="{{$data->id_maintenance_sub}}"><i class="fa fa-pencil"></i></button>
                    @else
                    <button class="btn-success" disabled><i class="fa fa-check-square"></i></button>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(document).ready(function() {

        $('#default-table-custom-task').DataTable();

    });
</script>
