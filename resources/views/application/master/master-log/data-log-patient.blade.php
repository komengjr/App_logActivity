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
    new DataTable('#example', {
        responsive: true
    });
</script>
