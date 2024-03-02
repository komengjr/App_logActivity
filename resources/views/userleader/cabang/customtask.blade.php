<div class="card">
    {{-- <img src="https://via.placeholder.com/800x500" class="card-img-top" alt="Card image cap"> --}}
    <div class="card-body" style="background: rgb(75, 73, 78);">
        <h5 class="card-title" style="color: white;">Cabang {{ $cabang->nama_cabang }} <button style="float: right;"
                class="btn-danger" data-dismiss="modal"><i class="fa fa-close"></i></button></h5>
        {{-- <p class="card-text">{{$item->alamat}}</p> --}}

    </div>
    <div class="modal-body" id="menu-custom-handle-user">
        <div class="row">
            <div class="col-12 col-lg-12">
                <span id="menu-form-custom-task"></span>
                <div class="card">
                    <div class="card-header border-0">
                        Recent Order Task
                        <div class="card-action">
                            <div class="dropdown">
                                <a href="javascript:void();" class="btn btn-dark btn-sm dropdown-toggle-nocaret"
                                    data-toggle="dropdown">
                                    <i class="fa fa-tasks text-white"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    {{-- <a class="dropdown-item" href="javascript:void();">Action</a>
                                    <a class="dropdown-item" href="javascript:void();">Another action</a>
                                    <a class="dropdown-item" href="javascript:void();">Something else here</a> --}}
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" id="button-tambah-custom-task"><i
                                            class="fa fa-check-square-o"></i> Tambah Baru</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Kinerja</th>
                                    <th>Jenis Kinerja</th>
                                    <th>Status</th>
                                    <th>Completion</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- <tr>
                                    <td>
                                        <img alt="Image placeholder" src="https://via.placeholder.com/110x110"
                                            class="product-img">
                                    </td>
                                    <td>Maintenance Komputer</td>
                                    <td>Pemeliharaan Hardware</td>
                                    <td>
                                        <span class="badge-dot">
                                            <i class="bg-danger"></i> pending
                                        </span>
                                    </td>
                                    <td>
                                        <div class="progress shadow" style="height: 4px">
                                            <div class="progress-bar gradient-ibiza" role="progressbar"
                                                style="width: 60%"></div>
                                        </div>
                                    </td>
                                    <td><button class="btn-warning" id="button-lengkapi-custon-task" data-id="123">Lengkapi</button> </td>
                                </tr> --}}

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on("click", "#button-tambah-custom-task", function(e) {
        e.preventDefault();
        $("#menu-form-custom-task").html(
            '<div class="card"><div style="text-align: center; padding:2%;"><div class="spinner-border" role="status" > <span class="sr-only"></span> </div></div></div>'
        );
        $.ajax({
                url: "../../user/user/handlecabang/customtask/new-data",
                type: "POST",
                cache: false,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "tiket": 123,
                },
                dataType: 'html',
            })
            .done(function(data) {
                $("#menu-form-custom-task").html(data);
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
