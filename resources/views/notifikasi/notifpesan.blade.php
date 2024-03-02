<li class="list-group-item d-flex justify-content-between align-items-center">
    {{-- Kamu Punya 123 Task Yang harus diselesaikan
    <span class="badge badge-primary">213</span> --}}
</li>
@foreach ($dataschedule as $dataschedule)
    <li class="list-group-item bg-danger">
        <a href="#" data-toggle="modal" data-target="#modal-laporan-user" id="task_kinerja_admin"
            data-id="{{ $dataschedule->kd_schedule }}">
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
    </li>

@endforeach
<div class="pt-2"></div>
@foreach ($datapesan as $data)
    <li class="list-group-item bg-warning">
        <a href="#" data-toggle="modal" data-target="#modal-laporan-user" id="task_kinerja"
            data-id="{{ $data->tiket_laporan }}">
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
    </li>
@endforeach
@if ($datapesan->isEmpty())
    <li class="list-group-item d-flex justify-content-between align-items-center">
        Kamu Belum Mempunyai Task apapun
        <span class="badge badge-primary"> 0</span>
    </li>
@else
    <li class="list-group-item text-center">
        <a href="#">See All Messages</a>
    </li>
@endif
