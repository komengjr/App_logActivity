<div class="modal-header bg-primary">
    <h5 class="modal-title text-white">
        Task : {{ $datachedule[0]->kinerja }}
    </h5>
    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="col">
        Deskripsi : @php
            echo $datachedule[0]->ket_schedule ;
        @endphp
    </div>
    <div class="col">
        <label for="">Penyelesaian</label>
        <textarea name="keterangan" class="form-control" id="summernoteEditor" cols="5" rows="10" required></textarea>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-dark" data-dismiss="modal">
        <i class="fa fa-times"></i> Close
    </button>
    <button type="button" class="btn btn-primary">
        <i class="fa fa-check-square-o"></i> Save changes
    </button>
</div>
<script src="{{ asset('assets/plugins/summernote/dist/summernote-bs4.min.js', []) }}"></script>
<script>
    $('#summernoteEditor').summernote({
        height: 400,
        tabsize: 2
    });
</script>
