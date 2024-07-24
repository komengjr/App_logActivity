<div id="menu-maintenance-bulanan"></div>
<div class="card">
    <div class="card-header border-0">
        Data Periode {{$data->periode}}
        <div class="card-action">
            <div class="dropdown">
                <a href="javascript:void();" class="btn btn-dark btn-sm dropdown-toggle-nocaret" data-toggle="dropdown">
                    <i class="fa fa-tasks text-white"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    {{-- <a class="dropdown-item" href="javascript:void();">Action</a>
                                                    <a class="dropdown-item" href="javascript:void();">Another action</a>
                                                    <a class="dropdown-item" href="javascript:void();">Something else here</a> --}}
                    {{-- <div class="dropdown-divider"></div> --}}
                    <a class="dropdown-item" href="#" id="button-tambah-detail-maintenance-bulanan"
                        data-id="{{$data->kd_schedule_maintenance}}"><i class="fa fa-check-square-o"></i> Tambah Perangkat</a>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive pt-3 pb-3" id="data-table-detail-periode-maintenance">
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

            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {

        $('#default-table-custom-task').DataTable();

    });
</script>
