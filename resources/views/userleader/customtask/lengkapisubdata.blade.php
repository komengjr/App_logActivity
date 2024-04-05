<div class="card">
    {{-- <img src="https://via.placeholder.com/800x500" class="card-img-top" alt="Card image cap"> --}}
    <div class="card-body">
        <h5 class="card-title">{{$nama_barang}}</h5>
        <p class="card-text">{{$no_inventaris}}</p>
    </div>
</div>
<form action="{{ url('user/user/handlecabang/customtasksub/new-data/simpan', []) }}" method="post">
    @csrf
    <div class="row">
        <div class="col-md-4">
            <label for="">Kode Task</label>
            <input type="text" class="form-control" name="kode" value="{{$kode}}" disabled>
            <input type="text" class="form-control" name="kode" value="{{$kode}}" hidden>
            <input type="text" class="form-control" name="id" value="{{$id}}" hidden>
        </div>
        <div class="col-md-4">
            <label for="">No Inventaris</label>
            <input type="text" class="form-control" name="no_inventaris" value="{{$no_inventaris}}" disabled>
            <input type="text" class="form-control" name="no_inventaris" value="{{$no_inventaris}}" hidden>
        </div>
        <div class="col-md-4">
            <label for="">Nama Barang</label>
            <input type="text" class="form-control" name="nama_barang" value="{{$nama_barang}}" disabled>
            <input type="text" class="form-control" name="nama_barang" value="{{$nama_barang}}" hidden>
        </div>
        <div class="col-md-12">
            <label for="">Deskripsi</label>
            <textarea name="keterangan" class="form-control" id="summernoteEditor88" cols="5" rows="10" required autofocus></textarea>
        </div>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn-success">Simpan</button>
    </div>
</form>

<script src="{{ asset('assets/plugins/summernote/dist/summernote-bs4.min.js', []) }}"></script>
<script>
    $('#summernoteEditor88').summernote({
        height: 400,
        tabsize: 2
    });
</script>
