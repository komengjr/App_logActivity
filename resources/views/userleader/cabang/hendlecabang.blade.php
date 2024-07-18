<style>
    #badge-pointer:hover {
        background: #000428;
        color: #fcfcfc;
        border: 0;
    }
</style>
<div class="modal-body" id="body-hendler-cabang-user">
    <div class="row">
        @foreach ($data as $item)
            @php
                $cekjadwal = DB::table('users_handler_backup')
                    ->where('kd_cabang', $item->kd_cabang)
                    ->where('tgl_hendler_backup', date('Y-m-d'))
                    ->first();
            @endphp
            @if ($cekjadwal)
            @else
                <div class="col-md-6">
                    <div class="card">
                        {{-- <img src="https://via.placeholder.com/800x500" class="card-img-top" alt="Card image cap"> --}}
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->nama_cabang }}</h5>
                            <p class="card-text">{{ $item->alamat }}</p>
                        </div>
                        <ul class="list-group list-group-flush list shadow-none">
                            <li class="list-group-item d-flex justify-content-between align-items-center"><i
                                    class="fa fa-tasks"></i> <a href="#" id="task-harian-hendler-user"
                                    data-id="{{ $item->kd_cabang }}"> <span class="badge badge-info p-2" id="badge-pointer">Monitoring
                                        Harian</span></a>
                                <span class="badge badge-info badge-pill" >
                                    @php
                                        $datarecord = DB::table('users_handler_record_log')
                                            ->where('kd_cabang', $item->kd_cabang)
                                            ->where('tgl_record', date('Y-m-d'))
                                            ->count();
                                    @endphp
                                    {{ $datarecord }}
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center"><i
                                    class="fa fa-tasks"></i> <a href="#" id="task-custom-hendler-user"
                                    data-id="{{ $item->kd_cabang }}"><span class="badge badge-primary p-2" id="badge-pointer">Tugas Team</span></a>
                                <span class="badge badge-danger badge-pill">
                                    0
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center"><i
                                    class="fa fa-tasks"></i> <a href="#" id="task-custom-hendler-user"
                                    data-id="{{ $item->kd_cabang }}"><span class="badge badge-warning p-2" id="badge-pointer">Custom Task</span></a>
                                <span class="badge badge-danger badge-pill">
                                    0
                                </span>
                            </li>
                            {{-- <li class="list-group-item d-flex justify-content-between align-items-center"><i
                                    class="fa fa-tasks"></i> <a href="#" id="task-tahunan-hendler-user"
                                    data-id="{{ $item->kd_cabang }}">Monitoring Tahunan</a>
                                <span class="badge badge-danger badge-pill">
                                    0
                                </span>
                            </li> --}}
                        </ul>
                        <div class="card-body text-right">
                            <button class="btn-dark" data-dismiss="modal">Tutup</button>
                            {{-- <a href="javascript:void();" class="card-link">Another link</a> --}}
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
        @foreach ($cekdata as $cekdata)
        <div class="col-md-6">
            <div class="card">
                {{-- <img src="https://via.placeholder.com/800x500" class="card-img-top" alt="Card image cap"> --}}
                <div class="card-body">
                    <h5 class="card-title">{{ $cekdata->nama_cabang }}</h5>
                    <p class="card-text">{{ $cekdata->alamat }}</p>
                </div>
                <ul class="list-group list-group-flush list shadow-none">
                    <li class="list-group-item d-flex justify-content-between align-items-center"><i
                            class="fa fa-tasks"></i> <a href="#" id="task-harian-hendler-user"
                            data-id="{{ $cekdata->kd_cabang }}"> <span class="badge badge-info p-2" id="badge-pointer">Monitoring
                                Harian</span></a>
                        <span class="badge badge-info badge-pill">
                            @php
                                $datarecord = DB::table('users_handler_record_log')
                                    ->where('kd_cabang', $cekdata->kd_cabang)
                                    ->where('tgl_record', date('Y-m-d'))
                                    ->count();
                            @endphp
                            {{ $datarecord }}
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center"><i
                            class="fa fa-tasks"></i> <a href="#" id="task-custom-hendler-user"
                            data-id="{{ $item->kd_cabang }}" id="badge-pointer">Custom Task</a>
                        <span class="badge badge-danger badge-pill">
                            0
                        </span>
                    </li>
                    {{-- <li class="list-group-item d-flex justify-content-between align-items-center"><i
                            class="fa fa-tasks"></i> <a href="#" id="task-tahunan-hendler-user"
                            data-id="{{ $cekdata->kd_cabang }}">Monitoring Tahunan</a>
                        <span class="badge badge-danger badge-pill">
                            0
                        </span>
                    </li> --}}
                </ul>
                <div class="card-body text-right">
                    <button class="btn-dark" data-dismiss="modal">Tutup</button>
                    {{-- <a href="javascript:void();" class="card-link">Another link</a> --}}
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
{{-- <div class="modal-footer">
    <button type="submit" class="btn-primary">
        <i class="fa fa-check-square-o"></i> Simpan
    </button>
</div> --}}
