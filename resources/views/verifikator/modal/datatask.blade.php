<div class="modal-content border-danger">
    <div class="modal-header bg-dark">
        @if ($data->status_task == 2)
            <form action="{{ asset('verifikator/datatask/user/pdf') }}" target="print_popup" method="post"
                enctype="multipart/form-data"
                onsubmit="window.open('about:blank','print_popup','width=1000,height=800');">
                @csrf
                <input type="text" name="id" id="" value="{{ $data->kd_tiket_task }}" hidden>
                <button type="submit" class="btn-info"><i class="fa fa-print"></i> Cetak</button>
            </form>
        @endif


        <span>

            <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </span>

    </div>
    <div class="modal-body" id="divtableworklist">
        <div class="row pt-2 pb-2">
            <div class="col-sm-12">
                <h5 class="page-title">Deskripsi Tugas :</h4>

            </div>

        </div>
        <div class="card p-3">
            @php
                echo $data->deskripsi_task;
            @endphp
        </div>
        <div class="row pt-2 pb-2">
            <div class="col-sm-12">
                <h5 class="page-title">Penyelesaian Tugas :</h4>

            </div>

        </div>
        <div class="card p-3">
            @php
                $cekjawaban = DB::table('tbl_tiket_task_log')
                    ->where('kd_tiket_task', $data->kd_tiket_task)
                    ->first();
            @endphp
            @if ($cekjawaban)
                @php
                    echo $cekjawaban->deskripsi_task_log;
                @endphp
            @else
                <span class="badge badge-danger badge-xl">Unfinished</span>
            @endif
        </div>
    </div>
    <div class="modal-footer">
        @if ($cekjawaban)
            @if ($data->status_task == 1)
                <div class="dropdown">
                    <button class="dropdown-toggle dropdown-toggle-nocaret btn-success" data-toggle="dropdown"><i
                            class="fa fa-cog"></i> Verify

                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <form action="{{ asset('verifikator/datatask/user/verif') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="kd_task" id="" value="{{ $data->kd_tiket_task }}"
                                hidden>
                            <button class="dropdown-item" type="submit" class="btn-success"><i class="fa fa-save"></i>
                                Selesai</button>
                        </form>

                        <form action="{{ asset('verifikator/datatask/user/unverif') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <button class="dropdown-item" type="submit" class="btn-success"><i class="fa fa-save"></i>
                                Tidak Selesai</button>
                        </form>

                    </div>
                </div>
            @endif
        @else
        @endif


    </div>
</div>
