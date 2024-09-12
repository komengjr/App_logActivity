<div class="card">
    <div class="card-body">
        <form class="row g-3" id="form-post-maintenance-bulanan">
            @csrf
            <div class="col-md-12 mb-4">
                <label for="inputLastName2" class="form-label">Cari Nama Perangkat</label>
                {{-- <input type="text" name="kode_costum_cabang" value="{{ $data->kd_cabang }}" id="kode_costum_cabang" hidden> --}}
                <div class="input-group">
                    <input type="text" class="form-control" id="nama" placeholder="">
                    <select name="caridata" id="caridata" class="form-control">
                        <option value="nama">By Nama Inventaris</option>
                        <option value="no">By Nomor Inventaris</option>
                    </select>
                    <div class="input-group-prepend">
                        <button class="btn-outline-primary" type="button"
                            id="button-cari-data-perangkat">Search</button>
                    </div>
                </div>
                <input type="text" class="form-control" name="kd_maintenance" value="{{ $data->kd_schedule_maintenance }}" id="kd_maintenance" hidden>
                <input type="text" class="form-control" name="cabang" value="{{ $data->kd_cabang }}" id="cabang" hidden>
            </div>
            <div class="col-lg-12 p-2 m-0">
                <div class="m-0 p-0" id="menu-maintenance-barang"></div>
            </div>
        </form>
    </div>

</div>
<script>
    $(document).on("click", "#button-cari-data-perangkat", function(e) {
        var nama = document.getElementById('nama').value;
        var kd_maintenance = document.getElementById('kd_maintenance').value;
        var cabang = document.getElementById('cabang').value;
        var caridata = document.getElementById('caridata').value;
        $("#menu-maintenance-barang").html(
            '<button class="btn btn-dark" type="button" disabled=""> <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...</button>'
        );
        e.preventDefault();
        $.ajax({
                url: "{{ route('user/user/handledatacabang/taskbulanan/tambah-maintenance-bulanan/detail/cari-perangkat') }}",
                type: "POST",
                cache: false,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "nama": nama,
                    "kd_maintenance": kd_maintenance,
                    "cabang": cabang,
                    "caridata": caridata,
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
    $(document).on("click", "#button-pilih-barang-rencana-maintenance", function(e) {
        var id = $(this).data("id");
        var nama = $(this).data("nama");
        var no = $(this).data("no");
        var type = $(this).data("type");
        var kode = $(this).data("kode");

        $("#menu-maintenance-barang").html(
            '<button class="btn btn-dark p-2" type="button" disabled=""> <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...</button>'
        );
        e.preventDefault();
        $.ajax({
                url: "{{ route('user/user/handledatacabang/taskbulanan/tambah-maintenance-bulanan/detail/pilih-perangkat') }}",
                type: "POST",
                cache: false,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                    "nama": nama,
                    "no": no,
                    "type": type,
                    "kode": kode,
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
