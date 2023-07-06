<div class="modal-header bg-info">
    <h5 class="modal-title text-white">Data Laporan No Tiket : <span style="color: black;">{{$data[0]->no_tiket}}</span></h5>
    <span>
        <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </span>

</div>
<form action="{{ asset('user/inputdatatiketgroup', []) }}" method="post">
    @csrf
<div class="modal-body" id="">
    <div class="row">
        <div class="col-12">
            <label for="">Data Laporan</label>
            @php
                echo $data[0]->deskripsi_laporan;
            @endphp
        </div>
        <div class="col-12">
            <textarea name="keterangan" class="form-control" id="summernoteEditor" cols="5" rows="10" required></textarea>
        </div>
    </div>

    <input type="text" name="id"  value="{{$data[0]->id_tiket_laporan}}" hidden>
</div>

<div class="modal-footer">

    <button type="submit" class="btn-success" ><i class="fa fa-save"></i> Simpanx</button>
</div>
</form>
<script src="{{ asset('assets/plugins/summernote/dist/summernote-bs4.min.js', []) }}"></script>
  <script>
   $('#summernoteEditor').summernote({
            height: 400,
            tabsize: 2
        });
  </script>
