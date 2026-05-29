<div class="modal-body p-0">
    <div class="bg-primary rounded-top-lg py-3 ps-4 pe-6">
        <h4 class="mb-1" style="color: white;" id="staticBackdropLabel">Form Update Data Cabang</h4>
        <p class="fs--2 mb-0" style="color: white;">Support by <a class="link-600 fw-semi-bold" href="#!">Transforma</a>
        </p>
    </div>
    <div class="p-4 pb-3" id="menu-add-data-pr-all">
        <form class="row g-3 pb-3" id="form-update-cabang" method="POST">
            @csrf
            <input type="text" name="kode_cabang" id="" value="{{ $data->kd_cabang }}" hidden>
            <div class="col-md-12">
                <label for="inputLastName1" class="form-label">Nama Cabang</label>
                <div class="input-group"> <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                    <input type="text" name="nama_cabang" class="form-control form-control-lg border-start-0"
                        id="user_name" value="{{ $data->nama_cabang }}">
                </div>
            </div>
            <div class="col-md-6">
                <label for="inputLastName1" class="form-label">Kota Cabang</label>
                <div class="input-group"> <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                    <input type="text" name="kota_cabang" class="form-control form-control-lg border-start-0"
                        id="email" value="{{ $data->city }}">
                </div>
            </div>
            <div class="col-md-6">
                <label for="inputLastName1" class="form-label">No Telp</label>
                <div class="input-group"> <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                    <input type="text" name="no_telp" class="form-control form-control-lg border-start-0"
                        id="whatsapp" value="{{ $data->phone }}">
                </div>
            </div>
            <div class="col-md-6">
                <label for="inputLastName1" class="form-label">Latitude Cabang</label>
                <div class="input-group"> <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                    <input type="text" name="lat" class="form-control form-control-lg border-start-0"
                        id="email" value="{{ $data->latitude }}">
                </div>
            </div>
            <div class="col-md-6">
                <label for="inputLastName1" class="form-label">Longtitude Cabang</label>
                <div class="input-group"> <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                    <input type="text" name="long" class="form-control form-control-lg border-start-0"
                        id="whatsapp" value="{{ $data->longtitude }}">
                </div>
            </div>
            <div class="col-md-12">
                <label for="inputLastName1" class="form-label">Alamat</label>
                <div class="input-group"> <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                    <textarea name="alamat" class="form-control" rows="4" id="">{{ $data->alamat }}</textarea>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal-footer px-4 bg-300">
    <span id="menu-update-data-cabang">
        <button class="btn btn-success float-end" id="button-simpan-update-cabang">Simpan
            Data</button>
    </span>
</div>
