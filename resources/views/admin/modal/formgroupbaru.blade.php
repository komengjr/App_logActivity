<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ asset('admin/group/tambahgroup') }}"  method="post" enctype="multipart/form-data">
                    @csrf
                    <h4 class="form-header text-uppercase">
                        <i class="fa fa-cog"></i>
                        Create Group Baru
                    </h4>
                    <div class="form-group row">
                        <label for="input-10" class="col-sm-2 col-form-label">Nama Group</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input-10" name="nama_group" required>
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
    $().ready(function() {
        $("#create_user").validate({
            rules: {
                nama_group: "required",

            },
            messages: {
                nama_group: "Isikan Nama Group",

            }
        });

    });
</script>



