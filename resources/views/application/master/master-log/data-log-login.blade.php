<div class="card mb-3 border border-success">
    <div class="card-header bg-primary">
        <div class="d-flex justify-content-between">
            <div>
              <h5>Log Data</h5>
            </div>
            <div class="d-flex">

            </div>
        </div>
    </div>
    <div class="card-body">
        <table id="example" class="table table-striped" style="width:100%">
            <thead class="bg-300 fs--1">
                <tr>
                    <th>No</th>
                    <th>Login Time</th>
                    <th>Login IP</th>
                    <th>Login Type</th>
                    <th>Login Status</th>
                    <th>User Login</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="fs--1">
                @php
                $no = 1;
                @endphp
                @foreach ($log as $logs)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $logs->Log_LoginDateTime }}</td>
                    <td>{{ $logs->Log_LoginIP }}</td>
                    <td>{{ $logs->Log_LoginType }}</td>
                    <td>{{ $logs->Log_LoginStatus }}</td>
                    <td>{{ $logs->Log_LoginLogin }}</td>
                    <td>{{ $logs->Log_LoginIsActive }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            dom: 'Bfrtip', // Menentukan posisi tombol eksport (B = Buttons, f = filtering, r = processing, t = table, i = info, p = pagination)
            buttons: [{
                    extend: 'copy',
                    className: 'btn btn-secondary btn-sm'
                },
                {
                    extend: 'csv',
                    className: 'btn btn-secondary btn-sm'
                },
                {
                    extend: 'excel',
                    className: 'btn btn-success btn-sm',
                    title: 'Log Patient Data'
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-danger btn-sm',
                    title: 'Log Patient Data',
                    orientation: 'landscape', // Opsional: dibuat landscape karena kolomnya cukup lebar
                    pageSize: 'A4'
                },
                {
                    extend: 'print',
                    className: 'btn btn-info btn-sm'
                }
            ],
            language: {
                // Opsional: Untuk mengubah teks pencarian menjadi bahasa Indonesia
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                zeroRecords: "Data tidak ditemukan",
                info: "Menampilkan halaman _PAGE_ dari _PAGES_",
                infoEmpty: "Tidak ada data tersedia",
                infoFiltered: "(disaring dari _MAX_ total data)"
            }
        });
    });
</script>
