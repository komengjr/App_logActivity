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

<div class="row pb-3">
    <div class="col-md-4">
        <span class="badge bg-primary text-white">Kecepatan penanganan kerusakan hardware</span>
    </div>

</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header text-uppercase">Cari Dengan Nama Barang</div>
            <div class="card-body">
                <input type="text" name="kode_costum_cabang" value="{{ $data->kd_cabang }}" id="kode_costum_cabang" hidden>
                <div class="input-group">
                    <input type="text" class="form-control" id="nama" placeholder="">
                    <div class="input-group-prepend">
                        <button class="btn-outline-primary" type="button"
                            id="button-cari-data-inventaris">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body" id="menu-maintenance-barang"></div>
        </div>
    </div>
</div>
<script>
    $(document).on("click", "#button-cari-data-inventaris", function(e) {
        var nama = document.getElementById('nama').value;
        var kode_costum_cabang = document.getElementById('kode_costum_cabang').value;
        $("#menu-maintenance-barang").html(
            '<button class="btn btn-dark" type="button" disabled=""> <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...</button>'
        );
        e.preventDefault();
        $.ajax({
                url: "{{ route('caridatainventaris-formcustomtasksub') }}",
                type: "POST",
                cache: false,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "nama": nama,
                    "kode_costum_cabang": kode_costum_cabang,
                },
                dataType: "html",
            })
            .done(function(data) {
                $("#menu-maintenance-barang").html(data);
            })
            .fail(function() {
                Lobibox.notify("error", {
                    pauseDelayOnHover: true,
                    continueDelayOnInactiveTab: false,
                    position: "top right",
                    icon: "bx bx-x-circle",
                    msg: "Gagal",
                });
            });

    });
    $(document).on("click", "#button-pilih-barang-maintenance", function(e) {
        var id = $(this).data("id");
        var nama = $(this).data("nama");
        var no = $(this).data("no");

        $("#menu-maintenance-barang").html(
            '<button class="btn btn-dark" type="button" disabled=""> <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...</button>'
        );
        e.preventDefault();
        $.ajax({
                url: "{{ route('pilihdatainventaris-formcustomtasksub') }}",
                type: "POST",
                cache: false,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                    "nama": nama,
                    "no": no,
                },
                dataType: "html",
            })
            .done(function(data) {
                $("#menu-maintenance-barang").html(data);
            })
            .fail(function() {
                Lobibox.notify("error", {
                    pauseDelayOnHover: true,
                    continueDelayOnInactiveTab: false,
                    position: "top right",
                    icon: "bx bx-x-circle",
                    msg: "Gagal",
                });
            });

    });
</script>
