<form action="" method="post" id="formpostuserbaru">
    @csrf
    <div class="row">
        <div class="col-12 col-lg-6 col-xl-6">
            <label for="">Nama Lengkap</label>
            <input type="text" class="form-control" name="nama">
        </div>
        <div class="col-12 col-lg-6 col-xl-6">
            <label for="">akses</label>
            <select name="akses" id="" class="form-control" >
                <option value="">Pilih Akses</option>
                <option value="1">Master Admin</option>
                <option value="2">Admin</option>
                <option value="3">User Leader</option>
                <option value="4">User</option>
                <option value="5">Verifikator</option>
            </select>
        </div>
        <div class="col-12 col-lg-6 col-xl-6">
            <label for="">Username</label>
            <input type="text" class="form-control" name="username">
        </div>
        <div class="col-12 col-lg-6 col-xl-6">
            <label for="">Password</label>
            <input type="password" class="form-control" name="password">
        </div>
        <div class="col-12 mt-3">
            <div class="text-right">
                <button class="btn-success" id="simpandatauserbaru" data-url="{{ url('masteradmin/datauser/post/tambah', []) }}"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div>
    </div>
</form> 
