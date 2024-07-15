<div class="row">
    <div class="col-md-6">
        <label for="">Kode</label>
        <input type="text" class="form-control" name="" value="{{ $data->kd_custom_task }}" disabled>
    </div>
    <div class="col-md-6">
        <label for="">Kategori Task</label>
        <input type="text" class="form-control" name="" value="{{ $data->kategori_task }}" disabled>
    </div>
    <div class="col-md-6">
        <label for="">Nama Task</label>
        <input type="text" class="form-control" name="" value="{{ $data->nama_task }}" disabled>
    </div>
    <div class="col-md-6">
        <label for="">Tanggal Terbit</label>
        <input type="text" class="form-control" name="" value="{{ $data->tgl_buat_custom }}" disabled>
    </div>
</div>
<hr>

<div class="row">
    <div class="col-md-4">
        @if ($data->kd_kinerja == 'P001')
            <i class="badge badge-info">% up Time sistem</i>
        @elseif($data->kd_kinerja == 'P002')
            <p>Realisasi Update system aplikasi (team)</p>
        @elseif($data->kd_kinerja == 'P003')
            <span class="badge badge-info">Kecepatan penanganan kerusakan sistem soft ware</span>
        @elseif($data->kd_kinerja == 'P004')
            <p>Realisasi monitoring back up data harian</p>
        @elseif($data->kd_kinerja == 'P005')
            <p>Realisasi monitoring back up data bulanan</p>
        @elseif($data->kd_kinerja == 'P006')
            <p>Capaian waktu pembelajaran</p>
        @elseif($data->kd_kinerja == 'P007')
            <p>Realisasi monitoring kapasitas ruang simpan</p>
        @elseif($data->kd_kinerja == 'P008')
            <p>Realisasi monitoring pengiriman hasil via WA dan email</p>
        @elseif($data->kd_kinerja == 'P009')
            <p>Realisasi pekerjaan maintenance hardware komputer</p>
        @elseif($data->kd_kinerja == 'P010')
            <p>Realisasi Update system aplikasi (individual)</p>
        @elseif($data->kd_kinerja == 'P011')
            <p>21312</p>
        @elseif($data->kd_kinerja == 'P012')
            <p>Realisasi penanganan keluhan pengguna terhadap soft ware dan hardware</p>
        @endif
    </div>
    <div class="col-md-8" >
        <div class="btn-toolbar" role="" style="justify-content: right;">
            <div class="btn-group">
                <button type="button" class="btn-outline-primary waves-effect waves-light dropdown-toggle"
                    data-toggle="dropdown" aria-expanded="false">
                    More
                    <span class="caret"></span>
                </button>
                <div class="dropdown-menu">
                    <a href="javaScript:void();" class="dropdown-item">Action</a>
                    <a href="javaScript:void();" class="dropdown-item">Another action</a>
                    <a href="javaScript:void();" class="dropdown-item">Something else here</a>
                    <div class="dropdown-divider"></div>
                    <a href="javaScript:void();" class="dropdown-item">Separated link</a>
                </div>
            </div>
        </div>
    </div>
</div>
