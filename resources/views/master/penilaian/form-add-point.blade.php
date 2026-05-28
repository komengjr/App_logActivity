<div class="modal-body p-0">
    <div class="bg-300 rounded-top-lg py-3 ps-4 pe-6">
        <h4 class="mb-1" id="staticBackdropLabel">Add Point Penilaian</h4>
        <p class="fs--2 mb-0">Support by <a class="link-600 fw-semi-bold" href="#!">Transforma</a></p>
    </div>
    <form class="row g-3 p-4" action="{{ route('master_penilaian_save_point') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-10">
            <label class="form-label" for="inputAddress">Nama Point</label>
            <input class="form-control form-control-lg" id="inputAddress" type="text" name="name" placeholder="Kualitas"
                required />
            <input type="text" name="code" value="{{ $code }}" id="" hidden>
        </div>
        <div class="col-2">
            <label class="form-label" for="inputAddress">Point</label>
            <input class="form-control form-control-lg" id="inputAddress" type="text" name="point" placeholder="0"
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
