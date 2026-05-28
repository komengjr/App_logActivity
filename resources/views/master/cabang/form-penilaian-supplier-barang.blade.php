<div class="modal-body p-0">
    <div class="bg-300 rounded-top-lg py-3 ps-4 pe-6">
        <h4 class="mb-1" id="staticBackdropLabel">Penilaian Supplier Barang</h4>
        <p class="fs--2 mb-0">Support by <a class="link-600 fw-semi-bold" href="#!">Transforma</a></p>
    </div>
    <div class="p-4" id="menu-detail-penilaian-supplier">
        <table id="data_penilaian" class="table table-striped" style="width:100%">
            <thead class="bg-200 text-700">
                <tr>
                    <th>No</th>
                    <th>Periode Cabang</th>
                    <th>Kepala Cabang</th>
                    <th>Manager SDM</th>
                    <th>Team Penilai</th>
                    <th>Log Penilai</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no = 1;
                @endphp
                @foreach ($data as $datas)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $datas->log_master_periode }}</td>
                    <td>{{ $datas->log_master_kacab }}</td>
                    <td>{{ $datas->log_master_mgr }}</td>
                    <td>
                        @php
                        $team = DB::table('log_master_team')->where('log_master_code',$datas->log_master_code)->get();
                        @endphp
                        @foreach ($team as $teams)
                        <li>{{ $teams->log_master_team_name }}<br><small>{{ $teams->log_master_team_nip }}<br>{{ $teams->log_master_team_jabatan }}</small></li>
                        @endforeach
                    </td>
                    <td>
                        @php
                        $count = DB::table('log_penilaian_cab')->where('log_master_code',$datas->log_master_code)->count();
                        @endphp
                        {{ $count }}
                    </td>
                    <td class="text-center">
                        <div class="btn-group" role="group">
                            <button class="btn btn-sm btn-falcon-primary dropdown-toggle" id="btnGroupVerticalDrop2" type="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span
                                    class="fas fa-align-left me-1" data-fa-transform="shrink-3"></span>Option</button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop2">
                                <button class="dropdown-item"
                                    id="button-data-penilaian-barang" data-code="{{$datas->log_master_code}}"><span class="far fa-file-alt"></span>
                                    Penilaian Barang</button>
                                <button class="dropdown-item"
                                    id="button-data-penilaian-jasa" data-code="{{$datas->log_master_code}}"><span class="far fa-file-alt"></span>
                                    Penilaian Jasa</button>
                                <div class="dropdown-divider"></div>
                                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-cabang"
                                    id="button-data-barang-cabang" data-code="123"><span
                                        class="far fa-folder-open"></span> History</button>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    new DataTable('#data_penilaian', {
        responsive: true
    });
</script>
