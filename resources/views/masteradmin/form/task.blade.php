<style>
    .tengah {
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
<div class="modal-header bg-info">
    <h5 class="modal-title text-white">Data Task Master Admin</h5>
    <span>

        <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </span>

</div>
<div class="modal-body" id="divtableworklist">
    <div class="body p-3" id="divinputworklist">

    </div>
    <div class="body pt-2">
        <table class="styled-table" id="default-datatable">
            <thead>
                <tr>
                    <th>No</th>
                    {{-- <th>Tiket Task</th> --}}
                    <th>Nama Pemberi Tugas</th>
                    <th>Cabang</th>
                    <th>Kinerja</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Berakhir</th>
                    <th>Verifikator</th>
                    <th>Status Task</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($data as $item)
                    <tr>
                        <td data-label="No">{{ $no++ }}</td>
                        {{-- <td data-label="No">{{$item->kd_tiket_task}}</td> --}}
                        <td data-label="Pemberi Tugas">
                            @php
                                $nama = DB::table('users')
                                    ->where('id_user', $item->id_leader)
                                    ->first();
                            @endphp
                            {{ $nama->name }}
                        </td>
                        <td data-label="Cabang">{{ $item->nama_cabang }}</td>
                        <td data-label="Kinerja">{{ $item->kinerja }}</td>
                        <td data-label="Tzanggal Mulai">{{ $item->tgl_start }}</td>
                        <td data-label="Tanggal Berakhir">{{ $item->tgl_end }}</td>
                        <td data-label="Verifikator">
                            @php
                                $namav = DB::table('users')
                                    ->where('id_user', $item->user_v)
                                    ->first();
                            @endphp
                            @if ($namav)
                                {{ $namav->name }}
                            @endif
                        </td>
                        <td data-label="Status Task"></td>
                        <td data-label="Action"><button class="btn-warning" id="tampildatataskuser"
                                data-url="{{ url('masteradmin/datatask/showdata', ['id' => $item->kd_tiket_task]) }}">
                                <i class="fa fa-pencil"></i></button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn-dark" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
</div>
<script>
    $(document).ready(function() {

        $('#default-datatable').DataTable();
        var table = $('#example').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
        });
        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');

    });
</script>
