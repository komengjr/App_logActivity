<div class="card mb-0">
    <div class="card-body">
            <h6 class="form-header text-uppercase">
                <i class="zmdi zmdi-search-in-file"></i>
                Detail Informasi Laporan
            </h6>
            <hr>
            <div class="form-group row">
                <label for="input-1" class="col-sm-2 col-form-label">Tiket Laporan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="input-1" name="fname" value="{{$data->tiket_laporan }}" disabled>
                </div>
            </div>
            <div class="form-group row">
                <label for="input-2" class="col-sm-2 col-form-label">Cabang</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="input-2" name="lname" value="{{$data->kd_cabang }}" disabled>
                </div>
            </div>
            <div class="form-group row">
                <label for="input-3" class="col-sm-2 col-form-label">Nama Pelapor</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="input-3" name="email" value="{{$data->nama_user }}" required="" disabled>
                </div>
            </div>
            <div class="form-group row">
                <label for="input-4" class="col-sm-2 col-form-label">NIP</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="input-4" value="{{$data->nip_user }}" name="phone" required="" disabled>
                </div>
            </div>
            <div class="form-group row">
                <label for="input-5" class="col-sm-2 col-form-label">Divisi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="input-5" name="company" value="{{$data->divisi }}" required="" disabled>
                </div>
            </div>
            <div class="form-group row">
                <label for="input-5" class="col-sm-2 col-form-label">Kategori Laporan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="input-5" name="company" value="{{$data->kategori_laporan }}" required="" disabled>
                </div>
            </div>
            <div class="form-group row">
                <label for="input-5" class="col-sm-2 col-form-label">No Handphone</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="input-5" name="no_hp" value="{{$data->no_hp }}" required="" disabled>
                </div>
            </div>
            <div class="form-group row">
                <label for="input-5" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="input-5" name="no_hp" value="{{$data->email }}" required="" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label for="input-9" class="col-sm-2 col-form-label">Deskripsi Kasus</label>
                <div class="col-sm-10">
                    @php
                        echo $data->deskripsi_laporan;
                    @endphp
                </div>
            </div>
    </div>
</div>