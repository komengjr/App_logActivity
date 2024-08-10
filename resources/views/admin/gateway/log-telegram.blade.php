<table id="example2" class="styled-table table-striped table-bordered" style="width:100%; text-align: left;"
    border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>Update ID</th>
            <th>Chat ID</th>
            <th>Nama Depan</th>
            <th>Nama Belakang</th>
            <th>Isi Pesan</th>
            <th>Tanggal Chat</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($data as $data)
            <tr>
                <td data-label="No">{{ $no++ }}</td>
                <td>{{ $data->update_id  }}</td>
                <td>{{ $data->chat_id }}</td>
                <td>{{ $data->first_name }}</td>
                <td>{{ $data->last_name }}</td>
                <td>{{ $data->text }}</td>
                <td>{{ date('d-m-Y H:i:s', $data->date) }}</td>
                <td class="text-center">
                    <div class="btn-group">
                        <button type="button" class="btn-outline-primary waves-effect waves-light dropdown-toggle"
                            data-toggle="dropdown" aria-expanded="false">
                            <i class="zmdi zmdi-settings"></i>
                            <span class="caret"></span>
                        </button>
                        <div class="dropdown-menu">
                            <a href="javaScript:void();" class="dropdown-item"><i class="zmdi zmdi-edit"></i> Edit</a>
                            <a href="javaScript:void();" class="dropdown-item"><i class="zmdi zmdi-eye"></i> Detail</a>
                            <a href="javaScript:void();" class="dropdown-item">Something else
                                here</a>
                            <div class="dropdown-divider"></div>
                            <a href="javaScript:void();" class="dropdown-item"><i class="zmdi zmdi-mail-send"></i> Kirim
                                Ulang</a>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>

</table>
<script>
    $(document).ready(function() {
        var table = $('#example2').DataTable({
            lengthChange: false,
            // buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
        });

        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');

    });
</script>
