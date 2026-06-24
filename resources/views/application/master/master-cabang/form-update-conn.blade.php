<div class="modal-body p-0">
    <div class="bg-primary rounded-top-lg py-3 ps-4 pe-6">
        <h4 class="mb-1" style="color: white;" id="staticBackdropLabel">Form Update Conn Cabang</h4>
        <p class="fs--2 mb-0" style="color: white;">Support by <a class="link-600 fw-semi-bold" href="#!">Transforma</a>
        </p>
    </div>
    <div class="p-4 pb-3" id="menu-add-data-pr-all">
        <form class="row g-3 pb-3" id="form-add-conn-cabang" method="POST">
            @csrf
            <input type="text" name="code" value="{{ $code }}" hidden>
            <div class="col-md-12">
                <label for="inputLastName1" class="form-label">IP Cabang</label>
                <div class="input-group"> <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                   <input type="text" class="form-control" name="ip">
                </div>
            </div>
            <div class="col-md-6">
                <label for="inputLastName1" class="form-label">Username</label>
                <div class="input-group"> <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                   <input type="text" class="form-control" name="username">
                </div>
            </div>
            <div class="col-md-6">
                <label for="inputLastName1" class="form-label">Password</label>
                <div class="input-group"> <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                   <input type="text" class="form-control" name="password">
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal-footer px-4 bg-300">
    <span id="menu-add-data-petugas">
        <button class="btn btn-success float-end" id="button-simpan-data-conn" data-code="">Simpan
            Data</button>
    </span>
</div>
