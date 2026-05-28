<div class="modal-body p-0">
    <div class="bg-300 rounded-top-lg py-3 ps-4 pe-6">
        <h4 class="mb-1" id="staticBackdropLabel">Detail Penilaian Suplier</h4>
        <p class="fs--2 mb-0">Support by <a class="link-600 fw-semi-bold" href="#!">Pramita</a></p>
    </div>
    <div class="p-2" id="menu-table-data-penilaian-supplier">
        @if ($data->isEmpty())
            <button class="btn btn-danger float-end m-3" id="button-remove-permanent-supplier" data-code="{{ $code }}"> Hapus Supplier Permanenly {{ $code }}</button>
        @else
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
                    <td>{{ $datas->m_barang_name }}</td>
                    <td>
                        @php
                        $value = DB::table('log_penilaian_cab')
                        ->join('t_penilaian_detail','t_penilaian_detail.t_penilaian_detail_code','=','log_penilaian_cab.t_penilaian_detail_code')
                        ->where('log_penilaian_cab.log_master_code',$datas->log_master_code)
                        ->where('log_penilaian_cab.m_supplier_code',$datas->m_supplier_code)
                        ->where('log_penilaian_cab.m_barang_code',$datas->m_barang_code)
                        ->where('log_penilaian_cab.master_cabang_code',$datas->master_cabang_code)
                        ->get();
                        @endphp
                        @foreach ($value as $val)
                        <li>{{ $val->t_penilaian_detail_name }} : {{ $val->log_penilaian_cab_score }}</li>
                        @endforeach
                    </td>
                    <td>{{ $datas->data_supp_brg_cab_score }}</td>
                    <td>
                        <button class="btn btn-danger btn-sm" id="button-remove-log-penilaian-supplier"
                            data-log="{{ $datas->log_master_code }}" data-supplier="{{ $datas->m_supplier_code }}" data-barang="{{ $datas->m_barang_code }}" data-cabang="{{ $datas->master_cabang_code }}">Reset</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
<script>
    new DataTable('#data_penilaian', {
        responsive: true
    });
</script>
