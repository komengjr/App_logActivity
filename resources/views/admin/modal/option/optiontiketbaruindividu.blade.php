<link href="{{ url('assets/plugins/select2/css/select2.min.css', []) }}" rel="stylesheet"/>
<form action="{{ url('admin/buattiket/laporan', []) }}" method="post">
    @csrf
    <div class="row">
        <div class="col-12 mt-2">
            <label for="">Judul Tugas</label>
            <input type="text" name="judul_tugas" id="" class="form-control">
            <input type="text" name="kd_kinerja" value="{{$id}}"  class="form-control" hidden>
        </div>
        <div class="col-12 mt-2">
            <label for="">Pilih cabang</label>
            <select name="kd_cabang" id="" class="form-control single-select5">
                <option value="">Pilih Cabang</option>
                @foreach ($cabang as $item)
                <option value="1">{{$item->nama_cabang}}</option>
                @endforeach

            </select>
        </div>

        <div class="col-12 mt-2">
            <label for="">Deskripsi Tugas</label>
            <textarea name="deskripsi" class="form-control" id="summernoteEditor" cols="5" rows="10" required></textarea>
        </div>

        <div class="col-12 mt-4 text-right" >
        <button class="btn-success"><i class="fa fa-save"></i> Simpan</button>
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
  <script src="{{ url('assets/plugins/select2/js/select2.min.js', []) }}"></script>
  <script>
      $(document).ready(function() {
        $('.single-select5').select2();




      });

  </script>
