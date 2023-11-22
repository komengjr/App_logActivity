<hr>
<div class="row pt-2 pb-2">
    <div class="col-sm-12">
        {{-- <h4 class="page-title">Report Data Monitoring</h4> --}}
        <ol class="breadcrumb bg-dark">
            {{-- <li class="breadcrumb-item"><a href="javaScript:void();">Report</a></li>
            <li class="breadcrumb-item"><a href="javaScript:void();">Data</a></li> --}}
            <li class="breadcrumb-item active text-white" aria-current="page">{{$tglstart}} Sampai {{$tglend}}</li>
        </ol>
    </div>

</div>
<div class="card pt-3 pb-3">
    <table id="default-datatablex" class="styled-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Cabang</th>
                <th>Total Harian</th>
                <th>Total Bulanan</th>
                <th>Total Tahunan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($datacabang as $datacabang)
                <tr>
                    <td data-label="No">{{$no++}}</td>
                    <td>{{$datacabang->nama_cabang}}</td>
                    <td class="text-right">
                        @php
                            $monitoring = DB::table('users_handler_record_log')
                            ->join('tbl_kinerja_sub','tbl_kinerja_sub.kd_kinerja_sub','users_handler_record_log.kd_kinerja_sub')
                            ->where('users_handler_record_log.kd_cabang',$datacabang->kd_cabang)
                            ->where('tbl_kinerja_sub.jenis_kinerja_sub',1)
                            ->whereBetween('users_handler_record_log.tgl_record', [$tglstart, $tglend])
                            ->count();
                        @endphp
                        {{$monitoring}} Task
                    </td>
                    <td></td>
                    <td ></td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {

        $('#default-datatablex').DataTable();

    });
</script>
