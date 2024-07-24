<div id="menu-maintenance-bulanan"></div>
<div class="card">
    <div class="card-header border-0">
        Data Periode
        <div class="card-action">
            <div class="dropdown">
                <a href="javascript:void();" class="btn btn-dark btn-sm dropdown-toggle-nocaret" data-toggle="dropdown">
                    <i class="fa fa-tasks text-white"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    {{-- <a class="dropdown-item" href="javascript:void();">Action</a>
                                                    <a class="dropdown-item" href="javascript:void();">Another action</a>
                                                    <a class="dropdown-item" href="javascript:void();">Something else here</a> --}}
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" id="button-tambah-maintenance-bulanan"
                        data-id="{{ $kd_cabang }}"><i class="fa fa-check-square-o"></i> Tambah Baru</a>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive pt-3 pb-3">
        <table class="table align-items-center table-flush" id="default-table-custom-task" border="1"
            style="text-align: justify;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Periode</th>
                    <th>Awal Periode</th>
                    <th>Akhir Periode</th>
                    <th>Verifikator</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($data as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->periode }}</td>
                        <td>{{ $data->awal_periode }}</td>
                        <td>{{ $data->akhir_periode }}</td>
                        <td>{{ $data->verifikator }}</td>
                        <td>
                            <button class="btn-dark"><i class="fa fa-tasks"></i></button>
                            <button class="btn-primary"><i class="fa fa-print"></i></button>
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
