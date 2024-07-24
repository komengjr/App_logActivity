<div id="menu-maintenance-bulanan"></div>
<div class="card">
    <div class="card-header border-0">
        Data Maintenance {{ $data->periode }}
        <div class="card-action">
            <div class="dropdown">
                <a href="javascript:void();" class="btn btn-dark btn-sm dropdown-toggle-nocaret" data-toggle="dropdown">
                    <i class="fa fa-tasks text-white"></i> Option
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    {{-- <a class="dropdown-item" href="javascript:void();">Action</a>
                                                    <a class="dropdown-item" href="javascript:void();">Another action</a>
                                                    <a class="dropdown-item" href="javascript:void();">Something else here</a> --}}
                    {{-- <div class="dropdown-divider"></div> --}}
                    <a class="dropdown-item" href="#" id="button-tambah-detail-maintenance-bulanan"
                        data-id="{{ $data->kd_schedule_maintenance }}"><i class="fa fa-check-square-o"></i> Tambah
                        Perangkat</a>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive pt-3 pb-3" id="data-table-detail-periode-maintenance">
        <table class="table align-items-center table-flush" id="default-table-custom-task" border="1" >
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Brang</th>
                    <th>No Barang</th>
                    <th>Tanggal Maintenance</th>
                    <th>Status Petugas</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($dataperangkat as $dataperangkat)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $dataperangkat->nama_inventaris }}</td>
                        <td>{{ $dataperangkat->no_inventaris }}</td>
                        <td>{{ $dataperangkat->tgl_maintenance_sub }}</td>
                        <td>{{ $dataperangkat->status_maintenance_sub }}</td>
                        <td>
                            <button class="btn-warning" id="button-detail-perangkat-maintenance"><i class="fa fa-pencil"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {

        $('#default-table-custom-task').DataTable();

    });
</script>
