<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ asset('admin/periode/tambahperiode') }}"  method="post" enctype="multipart/form-data">
                    @csrf
                    <h4 class="form-header text-uppercase">
                        <i class="fa fa-cog"></i>
                        Create Periode Baru
                    </h4>
                    <div class="form-group row">
                        <label for="input-10" class="col-sm-2 col-form-label">Nama Bulan</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="input-10" name="bulan">
                        </div>
                        <label for="input-11" class="col-sm-2 col-form-label">Nama Tahun</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="input-12" name="tahun">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-12" class="col-sm-2 col-form-label">Start Date</label>

                    </div>
                    <div class="form-group row">
                        <div id="dateragne-picker" style="width: 100%; padding-left: 15px; padding-right: 15px;">
                            <div class="input-daterange input-group">
                                <input type="text" class="form-control" name="start" style="cursor: pointer;" required/>
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Sampai</span>
                                </div>
                                <input type="text" name="end" class="form-control datepicker" id="date" autocomplete="off" style="cursor: pointer;" required/>
                            </div>
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
                bulan: "required",
                tahun: "required",

            },
            messages: {
                bulan: "Isikan Nama Bulan",
                tahun: "Isikan Tahun Sesuai Periode",
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
<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js', []) }}"></script>
<script>

</script>

<script type="text/javascript">
    $('#dateragne-picker .input-daterange').datepicker({
        autoclose: true,
        startDate: new Date(),
        todayHighlight: true
    });
    var d = new Date();
    var hours = d.getHours();


    $("#datepicker").click(function(e) {
        e.preventDefault();
    }).datepicker({
        dateFormat: "yy-mm-dd",
        beforeShowDay: function(date) {
            var date = '2023-05-01';
            return date.getDay() == 2 ? [false, " disabled"] : [true, " enabled"];
        }
    });
</script>
