<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Update Id </th>
            <th>Chat Id </th>
            <th>Nama Depan</th>
            <th>Nama Belakang</th>
            <th>Text</th>
            <th>date</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($data as $data)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data['update_id'] }}</td>
                <td>{{ $data['chat_id'] }}</td>
                <td>{{ $data['first_name'] }}</td>
                <td>{{ $data['last_name'] }}</td>
                <td>{{ $data['text'] }}</td>
                <td>{{ $data['date'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
