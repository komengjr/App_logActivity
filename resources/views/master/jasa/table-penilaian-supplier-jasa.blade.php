<table id="data_penilaian" class="table table-striped" style="width:100%">
    <thead class="bg-200 text-700">
        <tr>
            <th>No</th>
            <th>Cabang Penilai</th>
            <th>Peridoe Penilaian</th>
            <th>Supplier</th>
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
            <td>{{ $datas->m_supplier_name }}</td>
            <td>{{ $datas->m_jasa_name }}</td>
            <td>
                @php
                $value = DB::table('log_penilaian_jasa_cab')
                ->join('t_penilaian_detail','t_penilaian_detail.t_penilaian_detail_code','=','log_penilaian_jasa_cab.t_penilaian_detail_code')
                ->where('log_penilaian_jasa_cab.log_master_code',$datas->log_master_code)
                ->where('log_penilaian_jasa_cab.m_supplier_code',$datas->m_supplier_code)
                ->where('log_penilaian_jasa_cab.m_jasa_code',$datas->m_jasa_code)
                ->where('log_penilaian_jasa_cab.master_cabang_code',$datas->master_cabang_code)
                ->get();
                @endphp
                @foreach ($value as $val)
                <li>{{ $val->t_penilaian_detail_name }} : {{ $val->penilaian_jasa_cab_score }}</li>
                @endforeach
            </td>
            <td>{{ $datas->data_supp_jasa_cab_score }}</td>
            <td>
                <button class="btn btn-danger btn-sm" id="button-remove-log-penilaian-jasa"
                    data-log="{{ $datas->log_master_code }}" data-supplier="{{ $datas->m_supplier_code }}" data-jasa="{{ $datas->m_jasa_code }}" data-cabang="{{ $datas->master_cabang_code }}">Reset</button>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
