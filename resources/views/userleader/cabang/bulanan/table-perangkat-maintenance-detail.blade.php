<table class="table align-items-center table-flush" id="default-table-custom-task" border="1"
    style="text-align: justify;">
    <thead>
        <tr>
            <th>No</th>
            <th>Parameter</th>
            <th>Parameter Value</th>
            <th>Tgl Input</th>
            {{-- <th>Action</th> --}}
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($dataperangkat as $dataperangkat)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $dataperangkat->parameter }}</td>
                <td>{{ $dataperangkat->parameter_value }}</td>
                <td>{{ $dataperangkat->tgl_input }}</td>
                {{-- <td>
                    <button class="btn-danger"><i class="fa fa-pencil"></i></button>
                </td> --}}
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(document).ready(function() {

        $('#default-table-custom-task').DataTable();

    });
</script>
