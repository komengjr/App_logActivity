<div class="row">
    <div class="col-12 col-lg-12">
        <span id="menu-form-custom-task"></span>
        <div class="card">
            <div class="card-header border-0">
                Recent Order Task
                <div class="card-action">
                    <div class="dropdown">
                        <a href="javascript:void();" class="btn btn-dark btn-sm dropdown-toggle-nocaret"
                            data-toggle="dropdown">
                            <i class="fa fa-tasks text-white"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            {{-- <a class="dropdown-item" href="javascript:void();">Action</a>
                            <a class="dropdown-item" href="javascript:void();">Another action</a>
                            <a class="dropdown-item" href="javascript:void();">Something else here</a> --}}
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" id="button-tambah-custom-task"><i
                                    class="fa fa-check-square-o"></i> Tambah Baru</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-flush" id="default-table-custom-task" border="1">
                    <thead>
                        <tr>
                            <th>Icon</th>
                            <th>Kinerja</th>
                            <th>Nama Task</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $data)
                            <tr>
                                <td>
                                    <img alt="Image placeholder" src="https://via.placeholder.com/110x110"
                                        class="product-img">
                                </td>
                                <td>{{ $data->kinerja }}</td>
                                <td>{{ $data->nama_task }}</td>
                                <td>
                                    @if ($data->status_custom_task == 0)
                                        <span class="badge-dot">
                                            <i class="bg-danger"></i> Proses
                                        </span>
                                    @else
                                        <span class="badge-dot">
                                            <i class="bg-success"></i> Selesai
                                        </span>
                                    @endif

                                </td>

                                <td class="text-center">
                                    {{-- <button class="btn-warning" >Lengkapi</button> --}}
                                    <div class="dropdown">
                                        <a href="javascript:void();"
                                            class="btn btn-info btn-sm dropdown-toggle-nocaret"
                                            data-toggle="dropdown">
                                            <i class="fa fa-tasks text-white"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            {{-- <a class="dropdown-item" href="javascript:void();">Action</a>
                                                    <a class="dropdown-item" href="javascript:void();">Another action</a>
                                                    <a class="dropdown-item" href="javascript:void();">Something else here</a> --}}
                                            {{-- <div class="dropdown-divider"></div> --}}
                                            <a class="dropdown-item" href="#" id="button-lengkapi-custon-task" data-id="{{ $data->kd_custom_task }}"><i class="fa fa-check-square-o"></i> Checklist Komputer PC</a>
                                        </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        $('#default-table-custom-task').DataTable();

    });
</script>
