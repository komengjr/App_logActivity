<div class="">
    <table id="example3" class="styled-table table-striped table-bordered" style="width:100%; text-align: left;"
        border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Tiket</th>
                <th>Cabang</th>
                <th>Nama Pelapor</th>
                <th>Tanggal Melapor</th>
                <th>No Hp</th>
                <th>Email</th>
                <th>Status Laporan</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($data as $data)
                <tr>
                    <td data-label="No">{{ $no++ }}</td>
                    <td>{{ $data->tiket_laporan }}</td>
                    <td>{{ $data->nama_cabang }}</td>
                    <td>{{ $data->nama_user }}</td>
                    <td>{{ $data->tgl_laporan }}</td>
                    <td>{{ $data->no_hp }}</td>
                    <td>{{ $data->email }}</td>
                    <td>
                        @if ($data->status_laporan == 2)
                            <span class="badge badge-success">Selesai</span>
                        @else
                            <span class="badge badge-danger">Belum Selesai</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn-outline-primary waves-effect waves-light dropdown-toggle"
                                data-toggle="dropdown" aria-expanded="false">
                                Option
                                <span class="caret"></span>
                            </button>
                            <div class="dropdown-menu">
                                <a href="javaScript:void();" class="dropdown-item" data-toggle="modal"
                                    data-target="#modal-monitoring-telegram" id="button-edit-monitoring-telegram"
                                    data-id="{{ $data->id_laporan }}"><i class="zmdi zmdi-edit"></i> Edit</a>
                                <a href="javaScript:void();" class="dropdown-item" data-toggle="modal"
                                    data-target="#modal-monitoring-telegram" id="button-detail-monitoring-telegram"
                                    data-id="{{ $data->id_laporan }}"><i class="zmdi zmdi-eye"></i> Detail</a>
                                <a href="javaScript:void();" class="dropdown-item">Something else
                                    here</a>
                                <div class="dropdown-divider"></div>
                                <a href="javaScript:void();" class="dropdown-item"><i class="zmdi zmdi-mail-send"></i>
                                    Kirim
                                    Ulang</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
</div>
<script>
    $(document).ready(function() {
        var table = $('#example3').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
        });

        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');

    });
</script>
