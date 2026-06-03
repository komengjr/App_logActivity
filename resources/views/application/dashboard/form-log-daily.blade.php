<div class="modal-body p-0">
    <div class="bg-primary rounded-top-lg py-3 ps-4 pe-6">
        <h4 class="mb-1" style="color: white;" id="staticBackdropLabel">Form Log Today</h4>
        <p class="fs--2 mb-0" style="color: white;">Support by <a class="link-600 fw-semi-bold" href="#!">Transforma</a>
        </p>
    </div>
    <div class="p-2 pb-3" id="menu-add-data-pr-all">
        <div class="card-body">
            <table id="data_log" class="table table-bordered" style="width:100%">
                <thead class="bg-300 fs--1">
                    <tr>
                        <th>No</th>
                        <th>Kode Kinerja</th>
                        <th>Nama Kinerja</th>
                        <th>Tanggal Record</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="fs--1">
                    @php
                    $no = 1;
                    @endphp
                    @foreach ($data as $datas)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $datas->kd_kinerja_sub }}</td>
                        <td>{{ $datas->kinerja_sub }}</td>
                        <td>{{ $datas->tgl_record }}</td>
                        <td class="text-center">{{ $datas->ket_kinerja_sub }}</td>
                        <td class="text-center">
                            <button class="btn btn-danger btn-sm" id="button-remove-daily" data-code="{{ $datas->id }}"><span class="fas fa-trash"></span></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal-footer px-4 bg-300">

</div>
<script>
    new DataTable('#data_log', {
        responsive: true
    });
</script>
