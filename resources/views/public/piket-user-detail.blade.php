<div class="modal-header">
    <h5 class="modal-title">User Detail</h5>
    <button class="btn-danger" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
<div class="modal-body">
    <div class="card-body">
        <table id="example" class="table table-striped nowrap" style="width:100%">
            <thead class="bg-200 text-700">
                <tr>
                    <th style="width: 1%;">No</th>
                    <th>Nama Pelapor</th>
                    <th>Tiket Laporan</th>
                    <th>Tanggal Pelapor</th>
                    <th>Terima Laporan</th>
                    <th>Status Laporan</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($data as $datas)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$datas->nama_user}}</td>
                        <td>{{$datas->tiket_laporan}}</td>
                        <td>{{$datas->tgl_laporan}}</td>
                        <td>{{$datas->tgl_respon_laporan}}</td>
                        <td class="text-center">
                            @if ($datas->status_laporan == 2)
                                <span class="badge bg-success">Selesai</span>
                            @else
                                <span class="badge bg-warning">Prosess</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn-dark" data-dismiss="modal"><i class="fa fa-times"></i>
        Close</button>
</div>
<script>
    new DataTable('#example', {
        responsive: true
    });
</script>
