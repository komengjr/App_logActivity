{{-- <div class="modal-header bg-primary">
    <h5 class="modal-title text-white">
        Task baru
    </h5>
    <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div> --}}
<div class="modal-body" id="body-hendler-cabang-user">
    <div class="row">
        @foreach ($data as $item)
        <div class="col">
            <div class="card">
                {{-- <img src="https://via.placeholder.com/800x500" class="card-img-top" alt="Card image cap"> --}}
                <div class="card-body">
                    <h5 class="card-title">{{$item->nama_cabang}}</h5>
                    <p class="card-text">{{$item->alamat}}</p>
                </div>
                <ul class="list-group list-group-flush list shadow-none">
                    <li class="list-group-item d-flex justify-content-between align-items-center"><a href="#" id="task-harian-hendler-user" data-id="{{$item->kd_cabang}}">Monitoring Harian</a>
                        <span class="badge badge-info badge-pill">
                            @php
                                $datarecord = DB::table('users_handler_record_log')
                                ->where('kd_cabang',$item->kd_cabang)
                                ->where('tgl_record',date('Y-m-d'))->count();
                            @endphp
                            {{$datarecord}}
                        </span>
                    </li>
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
