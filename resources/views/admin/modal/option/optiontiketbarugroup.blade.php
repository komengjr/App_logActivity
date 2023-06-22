<form action="{{ url('admin/buattiket/laporan', []) }}" method="post">
    @csrf
    <div class="row">
        <div class="col-12 mt-2">
            <label for="">Judul Tugas</label>
            <input type="text" name="judul_laporan" id="" class="form-control">
        </div>
        <div class="col-12 mt-2">
            <label for="">Pilih Group</label>
            <select name="kd_group" id="" class="form-control">
                <option value="">Pilih Group</option>
                @foreach ($group as $item)
                    <option value="1">{{$item->nama_group}}</option>
                    asd
                @endforeach


            </select>

        </div>

        <div class="col-12 mt-2">
            <label for="">Deskripsi Tugas</label>
            <textarea name="deskripsi" class="form-control" id="summernoteEditor" cols="5" rows="10" required></textarea>
        </div>

        <div class="col-12 mt-4 text-right" >
        <button class="btn-info"><i class="fa fa-save"></i> Simpan</button>
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
