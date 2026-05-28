<div class="modal-body p-0">
    <div class="bg-danger rounded-top-lg py-3 ps-4 pe-6">
        <h4 class="mb-1" style="color: white;" id="staticBackdropLabel">Add Master Penilaian</h4>
        <p class="fs--2 mb-0">Support by <a class="link-600 fw-semi-bold" href="#!">Transforma</a></p>
    </div>
    <form class="row g-3 p-4" action="{{ route('master_penilaian_kapus_save') }}" method="post"
        enctype="multipart/form-data">
        @csrf
        <div class="col-md-12">
            <label class="form-label" for="inputAddress">Nama Kategori</label>
            <input class="form-control form-control-lg" id="inputAddress" type="text" name="name" placeholder="Kualitas"
                required />
        </div>
        <div class="col-md-6">
            <label class="form-label" for="inputAddress">Type Kategori</label>
            <select name="type" class="form-control" id="">
                <option value="">Pilih Kategori</option>
                @foreach ($data as $datas)
                    <option value="{{ $datas->s_penilaian_type_code  }}">{{ $datas->s_penilaian_type_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label" for="inputAddress">Skor Kategori</label>
            <input class="form-control form-control-lg" id="inputAddress" type="text" name="score" placeholder="Kualitas"
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
