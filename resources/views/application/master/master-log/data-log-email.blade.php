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
                    <th>Deskrispsi</th>
                </tr>
            </thead>
            <tbody class="fs--1">
                @php
                $no = 1;
                @endphp
                @foreach ($log as $logs)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $logs->Result_HandOverEmailLogDateTime }}</td>
                    <td>
                        @php
                        $json_data = $logs->Result_HandOverEmailLogJSON ;

                        $data = json_decode($json_data, true);

                        echo "<ul>";
                            foreach ($data as $kunci => $nilai) {
                            echo "<li><strong>" . $kunci . ":</strong> " . $nilai . "</li>";
                            }
                            echo "</ul>";
                        @endphp
                    </td>
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
