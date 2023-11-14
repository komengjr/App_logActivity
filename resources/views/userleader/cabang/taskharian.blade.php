<form action="{{ url('user/user/handledatacabang/postrecorddata', []) }}" method="post">
    @csrf
    <div class="card">
        {{-- <img src="https://via.placeholder.com/800x500" class="card-img-top" alt="Card image cap"> --}}
        <div class="card-body bg-dark">
            <h5 class="card-title" style="color: white;">Monitoring Harian {{$cabang->nama_cabang}}</h5>
            <input type="text" name="kd_cabang" value="{{$cabang->kd_cabang}}" id="" hidden>
            {{-- <p class="card-text">{{$item->alamat}}</p> --}}
        </div>
        <ul class="list-group list-group-flush list shadow-none">
            @foreach ($data as $item)

            <li class="list-group-item d-flex justify-content-between align-items-center">{{$item->kinerja_sub}}
                <span>
                    @php
                        $cekdata = DB::table('users_handler_record_log')
                        ->where('kd_kinerja_sub',$item->kd_kinerja_sub)
                        ->where('kd_cabang',$cabang->kd_cabang)
                        ->where('tgl_record',date('Y-m-d'))->first();
                    @endphp
                    @if ($cekdata)
                        @if ($cekdata->ket_kinerja_sub == 'N')
                            <span class="badge badge-success m-1">Normal</span>
                        @elseif ($cekdata->ket_kinerja_sub == 'I')
                            <span class="badge badge-warning m-1">Interminten</span>
                        @elseif ($cekdata->ket_kinerja_sub == 'TN')
                            <span class="badge badge-danger m-1">Tidak Normal</span>
                        @endif
                    @else
                    <select class="form-control" name="data{{$item->kd_kinerja_sub}}" id="" required>
                        <option value="">Pilih Kondisi</option>
                        <option value="N">Normal</option>
                        <option value="I">Interminten</option>
                        <option value="TN">Tidak Normal</option>
                    </select>
                    @endif

                </span>
            </li>

            @endforeach
        </ul>
        <div class="card-body text-right">
            <button type="submit" class="btn-success">Simpan</button>
            {{-- <a href="javascript:void();" class="card-link">Another link</a> --}}
        </div>
    </div>
</form>
