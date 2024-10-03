<table border="1" style="font-size: 9px;">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Massage</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($data as $data)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->logDate }}</td>
                <td>
                    @php
                        $data = str_replace('UP', '<br>UP', $data->logMessage);
                        $data1 = str_replace('Service :', '<br>Service :', $data);
                        $data2 = str_replace('Pacs', '<br>Pacs', $data1);
                        $data3 = str_replace('Web Server', '<br>Web Server', $data2);
                        $data4 = str_replace('Report Server', '<br>Report Server', $data3);
                        $data5 = str_replace('MariaDB Server', '<br>MariaDB Server', $data4);
                        $data6 = str_replace('----------', '<br>----------', $data5);
                        $data7 = str_replace('Resource :', '<br>Resource :', $data6);
                        $data8 = str_replace('folder', '<br>folder', $data7);
                        $data9 = str_replace('Connectivity:', '<br>Connectivity:<br>', $data8);
                        echo $data9;
                    @endphp
                </td>
            </tr>
        @endforeach

    </tbody>
</table>
