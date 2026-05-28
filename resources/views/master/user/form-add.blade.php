<div class="modal-body p-0">
    <div class="bg-300 rounded-top-lg py-3 ps-4 pe-6">
        <h4 class="mb-1" id="staticBackdropLabel">Add User</h4>
        <p class="fs--2 mb-0">Support by <a class="link-600 fw-semi-bold" href="#!">Transforma</a></p>
    </div>
    <form class="row g-3 p-4" action="{{ route('master_user_save') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-4">
            <label class="form-label" for="inputAddress">Nama Lengkap</label>
            <input class="form-control form-control-lg" id="inputAddress" type="text" name="nama_lengkap" placeholder="PT Jhon"
                required />
        </div>
        <div class="col-4">
            <label class="form-label" for="inputAddress">Email</label>
            <input class="form-control form-control-lg" id="inputAddress" type="text" name="email" placeholder="Papua"
                required />
        </div>
        <div class="col-4">
            <label class="form-label" for="inputAddress">Phone</label>
            <input class="form-control form-control-lg" id="inputAddress" type="text" name="phone" placeholder="0000000"
                required />
        </div>
        <div class="col-4">
            <label class="form-label" for="inputAddress">Akses</label>
            <select name="akses" class="form-control" id="">
                <option value="sdm">SDM</option>
                <option value="verif">Verifikator</option>
            </select>
        </div>
        <div class="col-8">
            <label class="form-label" for="inputAddress">Cabang</label>
            <select name="cabang" class="form-control choices-single-tahun" id="">
                <option value=""></option>
                @foreach ($cabang as $cab)
                    <option value="{{ $cab->master_cabang_code }}">{{ $cab->master_cabang_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6">
            <label class="form-label" for="inputAddress">Username</label>
            <input class="form-control form-control-lg" id="inputAddress" type="text" name="username" placeholder="0000000"
                required />
        </div>
        <div class="col-6">
            <label class="form-label" for="inputAddress">Password</label>
            <input class="form-control form-control-lg" id="inputAddress" type="password" name="password" placeholder="0000000"
                required />
        </div>

        <div class="col-12">
            <div class="form-check">
                <input class="form-check-input" id="gridCheck" type="checkbox" required />
                <label class="form-check-label" for="gridCheck">Check me</label>
            </div>
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit"><span class="fas fa-save"></span> Save</button>
        </div>
    </form>
</div>
<script>
    new window.Choices(document.querySelector(".choices-single-tahun"));
</script>
