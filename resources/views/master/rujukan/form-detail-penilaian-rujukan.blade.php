<div class="modal-body p-0">
    <div class="bg-300 rounded-top-lg py-3 ps-4 pe-6">
        <h4 class="mb-1" id="staticBackdropLabel">Detail Penilaian Jasa</h4>
        <p class="fs--2 mb-0">Support by <a class="link-600 fw-semi-bold" href="#!">Pramita</a></p>
    </div>
    <div class="p-2" id="menu-table-data-penilaian-rujukan">
        <table id="data_penilaian" class="table table-striped" style="width:100%">
            <thead class="bg-200 text-700">
                <tr>
                    <th>No</th>
                    <th>Cabang Penilai</th>
                    <th>Peridoe Penilaian</th>
                    <th>Rujukan</th>
                    <th>Barang</th>
                    <th>value</th>
                    <th>Score</th>
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
                    <td>{{ $datas->master_cabang_name }}</td>
                    <td>{{ $datas->log_master_periode }}</td>
                    <td>{{ $datas->m_rujukan_name }}</td>
                    <td>{{ $datas->m_pemeriksaan_name }}</td>
                    <td>
                        @php
                        $value = DB::table('log_penilaian_rujukan_cab')
                        ->join('t_penilaian_detail','t_penilaian_detail.t_penilaian_detail_code','=','log_penilaian_rujukan_cab.t_penilaian_detail_code')
                        ->where('log_penilaian_rujukan_cab.log_master_code',$datas->log_master_code)
                        ->where('log_penilaian_rujukan_cab.m_rujukan_code',$datas->m_rujukan_code)
                        ->where('log_penilaian_rujukan_cab.m_pemeriksaan_code',$datas->m_pemeriksaan_code)
                        ->where('log_penilaian_rujukan_cab.master_cabang_code',$datas->master_cabang_code)
                        ->get();
                        @endphp
                        @foreach ($value as $val)
                        <li>{{ $val->t_penilaian_detail_name }} : {{ $val->penilaian_rujukan_cab_score }}</li>
                        @endforeach
                    </td>
                    <td>{{ $datas->data_supp_rujukan_cab_score }}</td>
                    <td>
                        <button class="btn btn-danger btn-sm" id="button-remove-log-penilaian-rujukan"
                            data-log="{{ $datas->log_master_code }}" data-rujukan="{{ $datas->m_rujukan_code }}" data-pemeriksaan="{{ $datas->m_pemeriksaan_code }}" data-cabang="{{ $datas->master_cabang_code }}">Reset</button>
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
