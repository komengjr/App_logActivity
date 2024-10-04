<style>
    #acording-button:hover {
        background: rgb(147, 162, 162);
        cursor: pointer;
    }
</style>
<div class="card">
    {{-- <img src="https://via.placeholder.com/800x500" class="card-img-top" alt="Card image cap"> --}}
    <div class="card-body bg-dark">
        <h5 style="color: white;"><span class="badge badge-info">MONITORING HARIAN
                {{ $cabang->nama_cabang }}</span></h5>

        {{-- <p class="card-text">{{$item->alamat}}</p> --}}
    </div>
    <ul class="list-group list-group-flush list shadow-none">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div id="accordion1">
                        <div class="card mb-2">
                            <div class="card-header" data-toggle="collapse" data-target="#collapse-1"
                                id="acording-button">
                                <h5><span class="badge badge-primary">1</span> <span class="badge badge-dark">CHECKLIST
                                        LAPORAN KRITIS</span></h5>
                            </div>

                            <div id="collapse-1" class="collapse" data-parent="#accordion1">
                                <form action="{{ url('user/user/handledatacabang/postrecorddata', []) }}"
                                    method="post">
                                    @csrf
                                    <input type="text" name="kd_cabang" value="{{ $cabang->kd_cabang }}"
                                        id="" hidden>
                                    <div class="card-body">
                                        @foreach ($data as $item)
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center">
                                                {{ $item->kinerja_sub }}
                                                <span>
                                                    @php
                                                        $cekdata = DB::table('users_handler_record_log')
                                                            ->where('kd_kinerja_sub', $item->kd_kinerja_sub)
                                                            ->where('kd_cabang', $cabang->kd_cabang)
                                                            ->where('tgl_record', date('Y-m-d'))
                                                            ->first();
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
                                                        <select class="form-control"
                                                            name="data{{ $item->kd_kinerja_sub }}" focus
                                                            id="data{{ $item->kd_kinerja_sub }}" autofocus required>
                                                            <option value="">Pilih Kondisi</option>
                                                            <option value="N">Normal</option>
                                                            <option value="I">Interminten</option>
                                                            <option value="TN">Tidak Normal</option>
                                                        </select>
                                                    @endif

                                                </span>
                                            </li>
                                        @endforeach
                                    </div>
                                    <div class="card-body text-right">
                                        <button type="submit" class="btn-success">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card mb-1">
                            <div class="card-header " data-toggle="collapse" data-target="#collapse-2"
                                id="acording-button">
                                <h5><span class="badge badge-primary">2</span> <span class="badge badge-dark">CHECKLIST
                                        SISTEM SERVER & BACKUP DATA BISONE HARIAN</span></h5>
                            </div>
                            <div id="collapse-2" class="collapse" data-parent="#accordion1">
                                @php
                                    $cekbackup = DB::table('users_backup_harian')
                                        ->where('kd_cabang', $cabang->kd_cabang)
                                        ->where('tgl_backup_harian', date('Y-m-d'))
                                        ->first();
                                @endphp
                                @if ($cekbackup)
                                    <div class="card-body">
                                        <i class="fa fa-check-circle"></i>
                                    </div>
                                @else
                                    <form action="{{ url('user/user/handledatacabang/postrecorddatabackup', []) }}"
                                        method="post">
                                        @csrf
                                        <div class="card-body pb-0 mb-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="">SISTEM</label>
                                                    <select name="sistem_backup" class="form-control" id=""
                                                        required>
                                                        <option value="">Pilih Status</option>
                                                        <option value="OK">OK</option>
                                                        <option value="NOT OK">NOT OK</option>
                                                    </select>
                                                    <input type="text" name="kd_cabang" id=""
                                                        value="{{ $cabang->kd_cabang }}" hidden>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">PROSES BACK UP</label>
                                                    <select name="proses_backup" class="form-control" id=""
                                                        required>
                                                        <option value="">Pilih Status</option>
                                                        <option value="OK">OK</option>
                                                        <option value="NOT OK">NOT OK</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="">Deskripsi</label>
                                                    @php
                                                        $data = DB::connection('second_db')
                                                            ->table('log')
                                                            ->where('logBranchCode', $cabang->kd_cabang)
                                                            ->Where('logDate','like', '%' . date('Y-m-d') . '%',)
                                                            ->first();

                                                    @endphp
                                                    @if ($data)
                                                    <textarea name="deskripsi_backup" class="form-control" id="summernoteEditor" cols="5" rows="10" required>
                                                        @php
                                                            $data = str_replace('UP', '<br>UP', $data->logMessage);
                                                            $data1 = str_replace('Service :', '<br>Service :', $data);
                                                            $data2 = str_replace('Pacs', '<br>Pacs', $data1);
                                                            $data3 = str_replace('Web Server', '<br>Web Server', $data2);
                                                            $data4 = str_replace('Report Server', '<br>Report Server', $data3);
                                                            $data5 = str_replace('MariaDB Server', '<br>MariaDB Server', $data4);
                                                            $data6 = str_replace('----------', '<br>----------', $data5);
                                                            $data7 = str_replace('Resource :', '<br>Resource :', $data6);
                                                            $data8 = str_replace('folder', '<br>folder', $data7);
                                                            $data9 = str_replace('Connectivity:', '<br>Connectivity:<br>', $data8);
                                                            echo $data9;
                                                        @endphp
                                                    </textarea>
                                                    @else
                                                    <textarea name="deskripsi_backup" class="form-control" id="summernoteEditor" cols="5" rows="10" required>

                                                    </textarea>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body text-right pt-0">
                                            <button type="submit" class="btn-success">Simpan</button>
                                        </div>
                                    </form>
                                @endif

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </ul>
    <div class="card-body text-right modal-footer">
        <button class="btn-dark" data-dismiss="modal">Tutup</button>

    </div>
</div>
<script src="{{ asset('assets/plugins/summernote/dist/summernote-bs4.min.js', []) }}"></script>
<script>
    $('#summernoteEditor').summernote({
        height: 200,
        tabsize: 2
    });
</script>
