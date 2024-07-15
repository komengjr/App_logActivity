<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama Field</th>
            <th scope="col">Type Field</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($data as $data)
            <tr>
                <th scope="row">{{ $no++ }}</th>
                <td>{{ $data->nama_form }}</td>
                <td>{{ $data->type_form }}</td>
                <td>
                    <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
