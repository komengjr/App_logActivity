<div class="body">
    <div class="col-lg-12">
        <div id="accordion1">
            <div class="card mb-5">
                <div class="card-header">
                    <button class="btn btn-link shadow-none collapsed" data-toggle="collapse" data-target="#collapse-1"
                        aria-expanded="true" aria-controls="collapse-1">
                        {{ $tbl_tiket_task->kinerja }}
                    </button>
                    @if ($tbl_tiket_task_log->isempty())
                    <span class="badge badge-danger badge-xl" style="float: right;">Unfinished</span>
                    @elseif($tbl_tiket_task_log[0]->status_task_log == 1)
                    <span class="badge badge-warning badge-xl" style="float: right;">Proses</span>
                    @endif

                </div>

                <div id="collapse-1" class="collapse" data-parent="#accordion1">
                    <div class="card-body">
                        <div class="card-title text-uppercase">Deskripsi Task :</div>
                        @php
                            echo $tbl_tiket_task->deskripsi_task;
                        @endphp
                    </div>
                    <div class="card-body mb-5 pb-5">
                        <div class="card-title text-uppercase">Penyelesaian Task :</div>
                        @if ($tbl_tiket_task_log->isempty())
                            <span class="badge badge-danger badge-xl">Unfinished</span>
                        @else
                            @php
                                echo $tbl_tiket_task_log[0]->deskripsi_task_log;
                            @endphp
                        @endif

                    </div>
                    <div class="footer pt-3">
                        @if ($tbl_tiket_task_log[0]->nilai_task != "")
                        <button class="btn-dark" style="float: right;" disabled>Selesai</button>
                        @else
                        <form action="{{ url('user/userleader/table/detailtask/penilaian', []) }}" method="post">
                            @csrf
                            <div class="row pb-2">
                                <select name="nilai" id="" class="form-control" required>
                                    <option value="">Pilih Nilai</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                                <input type="text" name="id_laporan" value="{{$tbl_tiket_task_log[0]->kd_tiket_task}}">
                            </div>
                            <button type="submit" class="btn-dark" style="float: right;">Verif task</button>
                        </form>
                        @endif

                    </div>
                </div>
            </div>
            {{-- <div class="card mb-2">
            <div class="card-header">
                <button class="btn btn-link shadow-none collapsed" data-toggle="collapse" data-target="#collapse-2" aria-expanded="false" aria-controls="collapse-2">
                  Accordion Group Item #2
                </button>
            </div>
            <div id="collapse-2" class="collapse" data-parent="#accordion1">
              <div class="card-body">
                <div class="card-title text-uppercase">Some title example here</div>
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
                <button class="btn btn-link shadow-none collapsed" data-toggle="collapse" data-target="#collapse-3" aria-expanded="false" aria-controls="collapse-3">
                  Accordion Group Item #3
                </button>
            </div>
            <div id="collapse-3" class="collapse" data-parent="#accordion1">
              <div class="card-body">
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
              </div>
            </div>
          </div> --}}
        </div>
    </div>
</div>
