<form action="{{ url('admin/buattiket/laporan', []) }}" method="post">
    @csrf
    <div class="row">
        <div class="col-12 mt-2">
            <label for="">Judul Laporan</label>    
            <input type="text" name="judul_laporan" id="" class="form-control">
        </div>  
        <div class="col-12 mt-2">
            <label for="">Type Laporan</label>    
            <select name="type_laporan" id="" class="form-control">
                <option value="">Pilih Tingkat</option>
                <option value="1">Rendah</option>
                <option value="2">Sedang</option>
                <option value="3">Tinggi</option>
            </select>
        </div>  
        <div class="col-12 mt-2">
            <label for="">Deskripsi Laporan</label>    
            <textarea name="deskripsi" class="form-control" id="summernoteEditor" cols="5" rows="10" required></textarea>
        </div>  
       
        <div class="col-12 mt-4 text-right" >
        <button class="btn-info"><i class="fa fa-save"></i> Tambah Laporan</button>
        </div>
    </div>  
</form>
<script src="{{ url('assets/plugins/summernote/dist/summernote-bs4.min.js', []) }}"></script>
  <script>
   $('#summernoteEditor').summernote({
            height: 400,
            tabsize: 2
        });
  </script>
