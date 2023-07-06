<div class="modal-header bg-warning">
    <h5 class="modal-title text-white">Input Data Laporan</h5>
    <span>
        <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </span>

</div>
<form action="{{ asset('user/laporan/posttambah', []) }}" method="post">
    @csrf
<div class="modal-body" id="">
    <div class="body" id="">
        <div class="row">
            <div class="col-12">
                <label for="">Type Laporan</label>
                <select name="type_laporan" id="" class="form-control" required>
                    <option value="">Pilih Type</option>
                    @foreach ($type_laporan as $type_laporan)
                        <option value="{{$type_laporan->type_laporan}}">{{$type_laporan->tingkat_laporan}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <label for="">Judul Laporan</label>
                <input type="text" class="form-control" name="judul_laporan" required>
            </div>
            <div class="col-12">
                <label for="">Deskripsi Laporan</label>
                <textarea name="deskripsi_laporan" class="form-control" id="summernoteEditor" cols="5" rows="10" required></textarea>
            </div>
        </div>

    </div>
    {{-- <input type="text" name="id"  value="{{$id}}" hidden> --}}
</div>

<div class="modal-footer">
    <button type="submit" class="btn-success" ><i class="fa fa-save"></i> Simpan</button>
</div>
</form>
<script src="{{ asset('assets/plugins/summernote/dist/summernote-bs4.min.js', []) }}"></script>
  <script>
   $('#summernoteEditor').summernote({
            height: 400,
            tabsize: 2
        });
  </script>
