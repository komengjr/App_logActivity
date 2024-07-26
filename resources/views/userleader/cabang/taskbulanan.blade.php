<style>
    #acording-button:hover {
        background: rgb(147, 162, 162);
        cursor: pointer;
    }
</style>
<div class="card">
    {{-- <img src="https://via.placeholder.com/800x500" class="card-img-top" alt="Card image cap"> --}}
    <div class="card-body" style="background: rgb(68, 114, 146);">
        <h5 style="color: white;"><span class="badge badge-dark">TUGAS BULANAN IT
                {{ $cabang->nama_cabang }}</span></h5>

        {{-- <p class="card-text">{{$item->alamat}}</p> --}}
    </div>
    <ul class="list-group list-group-flush list shadow-none">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div id="accordion1">
                        <div class="card mb-2">
                            <div class="card-header" data-toggle="collapse" data-target="#collapse-1"
                                id="acording-button">
                                <h5><span class="badge badge-primary">1</span> <span class="badge badge-dark">RENCANA MAINTENANCE BULANAN</span></h5>
                            </div>

                            <div id="collapse-1" class="collapse" data-parent="#accordion1">

                                <div class="card-body" id="menu-data-maintenance">
                                    <div id="menu-maintenance-bulanan"></div>
                                    <div class="card">
                                        <div class="card-header border-0">
                                            Data Periode
                                            <div class="card-action">
                                                <div class="dropdown">
                                                    <a href="javascript:void();"
                                                        class="btn btn-dark btn-sm dropdown-toggle-nocaret"
                                                        data-toggle="dropdown">
                                                        <i class="fa fa-tasks text-white"></i> Option
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        {{-- <a class="dropdown-item" href="javascript:void();">Action</a>
                                                    <a class="dropdown-item" href="javascript:void();">Another action</a>
                                                    <a class="dropdown-item" href="javascript:void();">Something else here</a> --}}
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#"
                                                            id="button-tambah-maintenance-bulanan"
                                                            data-id="{{ $cabang->kd_cabang }}"><i
                                                                class="fa fa-check-square-o"></i> Tambah Baru</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive pt-3 pb-3">
                                            <table class="table align-items-center table-flush"
                                                id="default-table-custom-task" border="1"
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
                                                                <button class="btn-primary"
                                                                    id="button-detail-maintenance-bulanan"
                                                                    data-id="{{ $data->kd_schedule_maintenance }}"><i
                                                                        class="fa fa-eye"></i></button>
                                                                <button class="btn-secondary"><i
                                                                        class="fa fa-print"></i></button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-1">
                            <div class="card-header " data-toggle="collapse" data-target="#collapse-2"
                                id="acording-button">
                                <h5><span class="badge badge-primary">2</span> <span class="badge badge-dark">BACKUP DATA BISONE BULANAN </span></h5>
                            </div>
                            <div id="collapse-2" class="collapse" data-parent="#accordion1">
                                <form action="{{ url('user/user/handledatacabang/postrecorddatabackup', []) }}"
                                    method="post">
                                    @csrf
                                    <div class="card-body pb-0 mb-0">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="">SISTEM</label>
                                                <select name="sistem_backup" class="form-control" id=""
                                                    required>
                                                    <option value="">Pilih Status</option>
                                                    <option value="OK">OK</option>
                                                    <option value="NOT OK">NOT OK</option>
                                                </select>
                                                <input type="text" name="kd_cabang" id=""
                                                    value="{{ $cabang->kd_cabang }}" hidden>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="">PROSES BACK UP</label>
                                                <select name="proses_backup" class="form-control" id=""
                                                    required>
                                                    <option value="">Pilih Status</option>
                                                    <option value="OK">OK</option>
                                                    <option value="NOT OK">NOT OK</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="">Deskripsi</label>
                                                <textarea name="deskripsi_backup" class="form-control" id="summernoteEditor" cols="5" rows="10" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body text-right pt-0">
                                        <button type="submit" class="btn-success">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </ul>
    <div class="card-body text-right modal-footer">
        <button class="btn-dark" data-dismiss="modal">Tutup</button>

    </div>
</div>
<script src="{{ asset('assets/plugins/summernote/dist/summernote-bs4.min.js', []) }}"></script>
<script>
    $('#summernoteEditor').summernote({
        height: 200,
        tabsize: 2
    });
</script>
<script>
    $(document).ready(function() {

        $('#default-table-custom-task').DataTable();

    });
</script>
