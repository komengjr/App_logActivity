<div class="modal-body p-0">
    <div class="bg-primary rounded-top-lg py-3 ps-4 pe-6">
        <h4 class="mb-1" style="color: white;" id="staticBackdropLabel">Form Preview Report Log Bisone</h4>
        <p class="fs--2 mb-0" style="color: white;">Support by <a class="link-600 fw-semi-bold" href="#!">Transforma</a>
        </p>
    </div>
    <div class="p-4 pb-3" id="menu-add-data-pr-all">
        <form id="form-monitoring-log-bisone" method="post">
            @csrf
            <div class="row pb-3">
                <div class="col-md-4">
                    <label for="">Pilih Cabang</label>
                    <select name="cabang" class="form-control single-select" id="">
                        <option value="">Pilih Cabang</option>
                        @foreach ($cabang as $cabangs)
                        <option value="{{ $cabangs->kd_cabang }}">{{ $cabangs->nama_cabang }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="">Start Date</label>
                    <input type="date" name="start" id="" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="">End Date</label>
                    <input type="date" name="end" id="" class="form-control">
                </div>
            </div>
        </form>
        <span id="show-monitoring-log-bisone"></span>
    </div>
</div>
<div class="modal-footer px-4 bg-300">
    <button class="btn-primary" id="button-privew-monitoring-log-bisone">
        <i class="fa fa-print"></i> Preview Laporan
    </button>
</div>
