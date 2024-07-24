<table class="table align-items-center table-flush" id="default-table-custom-task" border="1"
    style="text-align: justify;">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Brang</th>
            <th>No Barang</th>
            <th>Tanggal Maintenances</th>
            <th>Status Petugas</th>
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
                <td>{{$data->status_maintenance_sub}}</td>
                <td>
                    <button class="btn-warning"><i class="fa fa-pencil"></i></button>
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
