<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ asset('admin/data/datacabang/tambahhendlecabang') }}" id="create_user" method="post" enctype="multipart/form-data">
                    @csrf
                    <h4 class="form-header text-uppercase">
                        <i class="fa fa-address-book-o"></i>
                        Tambah Handle Cabang
                    </h4>
                    <div class="form-group row">
                        <label for="input-10" class="col-sm-2 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control"  name="nama_cabang" value="{{$cabang->nama_cabang}}" disabled>
                            <input type="text" class="form-control"  name="kd_cabang" value="{{$cabang->kd_cabang}}" hidden>
                        </div>
                        <label for="input-11" class="col-sm-2 col-form-label">Pilih User</label>
                        <div class="col-sm-4">
                            <select name="user" id="" class="form-control single-select">
                                <option value="">Pilih User</option>
                                @foreach ($user as $item)
                                <option value="{{$item->id_user}}">{{$item->nama_lengkap}}</option>
                                @endforeach
                            </select>
                            <input type="text" class="form-control"  name="kd_cabang" value="{{$id}}" hidden>
                        </div>
                    </div>


                    <div class="form-footer">

                        <button type="submit" class="btn-success"><i class="fa fa-check-square-o"></i>
                            Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.single-select').select2();
      });

</script>
<script>
    $().ready(function() {

        $("#create_user").validate({
            rules: {
                nama_lengkap: "required",
                akses: "required",
                username: {
                    required: true,
                    minlength: 4
                },
                password: {
                    required: true,
                    minlength: 6
                },
                confirm_password: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                },
                email: {
                    required: true,
                    email: true
                },
                contactnumber: {
                    required: true,
                    minlength: 10
                },
                topic: {
                    required: "#newsletter:checked",
                    minlength: 2
                },
                agree: "required"
            },
            messages: {
                nama_lengkap: "Isikan Dengan Nama Lengkap",
                akses: "Pilih Akses Dulu",
                username: {
                    required: "Please enter a username",
                    minlength: "Your username must consist of at least 2 characters"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                confirm_password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long",
                    equalTo: "Please enter the same password as above"
                },
                email: "Please enter a valid email address",
                contactnumber: "Please enter your 10 digit number",
                agree: "Please accept our policy",
                topic: "Please select at least 2 topics"
            }
        });

    });
</script>
