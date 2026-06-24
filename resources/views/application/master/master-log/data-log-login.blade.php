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
    new DataTable('#example', {
        responsive: true
    });
</script>
