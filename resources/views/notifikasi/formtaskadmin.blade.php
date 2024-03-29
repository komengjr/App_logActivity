<div class="modal-header bg-primary">
    <h5 class="modal-title text-white">
        Task : {{ $datalaporan->kinerja }}
    </h5>
    <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form action="{{ asset('user/userleader/postscheduleadmin') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <div class="col-md-6">
            Deskripsi :

            @php
                echo $datalaporan->ket_schedule;
            @endphp

            <input type="text" name="tiket" value="{{ $datalaporan->kd_schedule }}" hidden>
        </div>
        <div class="col-md-6">
            <button class="btn-success"><i class="fa fa-info"></i></button>
        </div>
        <div class="col">
            <label for="">Penyelesaian</label>
            <textarea name="keterangan" class="form-control" id="summernoteEditor88" cols="5" rows="10" required></textarea>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn-primary">
            <i class="fa fa-check-square-o"></i> Simpan
        </button>
    </div>

</form>
<script src="{{ asset('assets/plugins/summernote/dist/summernote-bs4.min.js', []) }}"></script>
<script>
    $('#summernoteEditor88').summernote({
        height: 400,
        tabsize: 2
    });
</script>
