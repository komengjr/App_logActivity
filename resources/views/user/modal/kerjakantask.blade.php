<div class="modal-header bg-primary">
    <h5 class="modal-title text-white">
        Task : {{$tbl_tiket_task->kinerja}}
    </h5>
    <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form action="{{ asset('user/user/tiket/posttask') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <div class="col">
            Deskripsi :
            @php
                echo $tbl_tiket_task->deskripsi_task;
            @endphp
            <input type="text" name="kd_tiket" value="{{$tbl_tiket_task->kd_tiket_task}}" hidden>
        </div>
        <div class="col">
            <label for="">Penyelesaian</label>
            <textarea name="keterangan" class="form-control" id="summernoteEditor" cols="5" rows="10" required></textarea>
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
    $('#summernoteEditor').summernote({
        height: 400,
        tabsize: 2
    });
</script>
