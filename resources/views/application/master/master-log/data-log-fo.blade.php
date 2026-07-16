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
        <div class="table-responsive">
            <table id="example" class="table table-striped" style="width:100%">
                <thead class="bg-300 fs--1">
                    <tr>
                        <th>No</th>
                        <th>Tanggal Log</th>
                        <th>Status</th>
                        <th>Nama User (Pusat)</th>
                        <th>Usernam (Lokal)</th>
                    </tr>
                </thead>
                <tbody class="fs--1">
                    @php
                    $no = 1;
                    @endphp
                    @foreach($logs as $index => $log)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $log->Log_FoDate ?? '-' }}</td>
                        <td>{{ $log->Log_FoCode ?? '-' }}</td>
                        <td><strong>{{ $log->nama_user }}</strong></td>
                        <td>{{ $log->username }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            dom: "<'row mb-3'<'col-md-6 d-flex justify-content-start'B><'col-md-6 d-flex justify-content-end'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row mt-3'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 d-flex justify-content-end'p>>",
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
                    title: 'Log Login Data',
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
