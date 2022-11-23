<div class="modal-header bg-info">
    <h5 class="modal-title text-white">Input Tugas Group</h5> 
    <span>
        <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </span>
    
</div>
<form action="{{ url('user/inputdatatiketgroup', []) }}" method="post">
    @csrf
<div class="modal-body" id="">
    <div class="body" id="">  
        
        <textarea name="keterangan" class="form-control" id="summernoteEditor" cols="5" rows="10" required></textarea>
    </div>
    <input type="text" name="id"  value="{{$id}}" hidden>
</div>

<div class="modal-footer">
    
    <button type="submit" class="btn-success" ><i class="fa fa-save"></i> Simpanx</button>
</div>
</form>
<script src="{{ url('assets/plugins/summernote/dist/summernote-bs4.min.js', []) }}"></script>
  <script>
   $('#summernoteEditor').summernote({
            height: 400,
            tabsize: 2
        });
  </script>