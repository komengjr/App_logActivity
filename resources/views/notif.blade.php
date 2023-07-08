<li class="list-group-item d-flex justify-content-between align-items-center">
    {{-- Kamu Punya 123 Task Yang harus diselesaikan
    <span class="badge badge-primary">213</span> --}}
</li>

@foreach ($datachedule as $item)
    @if (substr($item->tgl_start, 0, 10) >= date('Y-m-d'))
    @php
        $cekdata = DB::table('tbl_schadule_log')->where('kd_schedule',$item->kd_schedule)->where('id_user',auth::user()->id_user)->count();
    @endphp
        @if ($cekdata == 0)
            <li class="list-group-item">
                <a href="#"  data-toggle="modal" data-target="#primarymodal" id="task_kinerja" data-id="{{$item->kd_schedule}}">
                    <div class="media">
                        <div class="avatar">
                            <img class="align-self-start mr-3" src="https://via.placeholder.com/50x50" alt="user avatar" />
                        </div>
                        <div class="media-body">

                            <p class="msg-info" style="margin: 0px;">{{ $item->kinerja }}</p>
                            <small style="color: #000000;">Batas Waktu : {{ $item->tgl_start }} sampai
                                {{ $item->tgl_akhir }}</small>
                        </div>
                    </div>
                </a>
            </li>
        @endif
    @endif
@endforeach
@if ($datachedule->isEmpty())
<li class="list-group-item d-flex justify-content-between align-items-center">
    Kamu Belum Mempunyai Task apapun
    <span class="badge badge-primary">0</span>
</li>
@else
<li class="list-group-item text-center">
    <a href="javaScript:void();">See All Messages</a>
</li>
@endif

<div class="modal fade" id="task_schedule">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-danger">

         gfd

        </div>
    </div>
</div>
