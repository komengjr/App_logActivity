<div class="card py-3">
    <table id="table-detail" class="styled-table table-striped table-bordered ">
        <thead>
            <tr>
                <th style="width: 2%;">No</th>
                <th style="width: 2%;">Gambar</th>
                <th>User</th>
                <th>NIP</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($data as $data)
                <tr>
                    <td>{{$no++}}</td>
                    <td class="text-center"><img src="{{ asset('storage/'.$data->gambar) }}" alt="" width="50"></td>
                    <td>{{$data->nama_lengkap}}</td>
                    <td>{{$data->nip}}</td>
                    <td class="text-center">
                        <button class="btn-danger" onclick="window.location = '{{route('removejadwalpiketnasionalindividu',['id'=>$data->tiket_piket_user])}}';"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="card p-3">
    <form action="{{ route('simpanjadwalpiketnasionalindividu') }}" method="post">
        @csrf
        <div class="form-group">
            <label>Pilih User</label>
            <input type="text" name="code" value="{{$id}}" hidden>
            <select class="form-control single-select" name="user" required>
                <option value="">Choos</option>
                @foreach ($user as $user)
                    <option value="{{ $user->id_user }}">{{ $user->nama_lengkap }} - {{ $user->nip }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-primary float-right"><i class="fa fa-save"></i>Simpan</button>
    </form>
</div>
<script>
    $(document).ready(function() {
        var table = $('#table-detail').DataTable({
            lengthChange: false,
            // buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
        });

        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');

    });
</script>
<script>
    $(document).ready(function() {
        $('.single-select').select2();
    });
</script>
