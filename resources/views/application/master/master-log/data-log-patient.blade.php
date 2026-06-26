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
                    <th>Log Time</th>
                    <th>Log_PatientCode</th>
                    <th>Log_PatientJson</th>
                    <th>Log_PatientJsonBefore</th>
                    <th>Log_PatientUserID</th>
                </tr>
            </thead>
            <tbody class="fs--1">
                @php
                $no = 1;
                @endphp
                @foreach ($log as $logs)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $logs->Log_PatientDate }}</td>
                    <td>{{ $logs->Log_PatientCode }}</td>
                    <td class="fs--2">
                        @php
                        $json = $logs->Log_PatientJson;

                        $data = json_decode($json, true);

                        // Looping untuk menampilkan semua key dan value
                        foreach ($data as $key => $value) {
                        echo "<strong>$key:</strong> " . ($value ?? 'NULL') . "<br>";
                        }
                        @endphp
                    </td>
                    <td class="fs--2">
                        @php
                        $json_data = $logs->Log_PatientJsonBefore;

                        $patient_array = json_decode($json_data, true) ?? [];

                        // Looping untuk menampilkan semua key dan value
                        foreach ($patient_array as $key => $value) {
                        echo "<strong>$key:</strong> " . ($value ?? 'NULL') . "<br>";
                        }
                        @endphp
                    </td>
                    <td>{{ $logs->Log_PatientUserID }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
