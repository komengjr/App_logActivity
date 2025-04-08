@foreach ($dataschedule as $dataschedule)
    <li class="list-group-item bg-light.bg-gradient">
        <div class="card m-0 p-0">
            <div class="card-body"data-toggle="modal" data-target="#modal-laporan-user" id="task_kinerja_admin"
                data-id="{{ $dataschedule->kd_schedule }}">
                <a>
                    <div class="media">
                        <div class="alert-icon contrast-alert m-2">
                            <button><i class="fa fa-envelope"></i></button>
                        </div>
                        <div class="media-body">

                            <p class="msg-info" style="margin: 0px;">Admin</p>
                            <small style="color: #000000;">Tanggal Terbit : {{ $dataschedule->tgl_start }} Sampai
                                {{ $dataschedule->tgl_akhir }} </small>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </li>
@endforeach
@foreach ($datapesan as $data)
    <li class="list-group-item bg-light.bg-gradient">
        <div class="card m-0 p-0">
            <div class="card-body" data-toggle="modal" data-target="#modal-laporan-user"
                id="task_kinerja"data-id="{{ $data->tiket_laporan }}">
                <a>
                    <div class="media">
                        <div class="alert-icon contrast-alert m-2">
                            <button><i class="fa fa-envelope"></i></button>
                        </div>
                        <div class="media-body">

                            <p class="msg-info" style="margin: 0px;">{{ $data->nama_user }}</p>
                            <small style="color: #000000;">Tanggal Terbit : {{ $data->tgl_laporan }} </small>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </li>
@endforeach
@if ($piket)
    @foreach ($datanasional as $datanasionals)
        <li class="list-group-item bg-light.bg-gradient">
            <div class="card m-0 p-0">
                <div class="card-body" data-toggle="modal" data-target="#modal-laporan-user"
                    id="task_kinerja"data-id="{{ $datanasionals->tiket_laporan }}">
                    <a>
                        <div class="media">
                            <div class="alert-icon contrast-alert m-2">
                                <button><i class="fa fa-envelope"></i></button>
                            </div>
                            <div class="media-body">

                                <p class="msg-info" style="margin: 0px;">{{ $datanasionals->nama_user }}</p>
                                <small style="color: #000000;">Tanggal Terbit : {{ $datanasionals->tgl_laporan }}
                                </small><br>
                                <small style="color: #000000;">Cabang : {{ $datanasionals->nama_cabang }}
                                </small>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </li>
    @endforeach

@endif
@if ($datapesan->isEmpty())
    <li class="list-group-item d-flex justify-content-between align-items-center">
        Kamu Belum Mempunyai Task apapun
        <span class="badge badge-primary"> 0</span>
    </li>
@else
    <li class="list-group-item text-center bg-light.bg-gradient">
        <a href="{{ url('master-data-user', []) }}">See All Messages</a>
    </li>
@endif
<style>
    #task_kinerja_admin:hover {
        background: rgb(41, 155, 151);
        cursor: pointer;
    }

    #task_kinerja:hover {
        background: rgb(28, 194, 92);
        cursor: pointer;
    }
</style>
