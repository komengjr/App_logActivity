<form action="{{ route('simpandata-pilihdatainventaris-formcustomtasksub') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <label for="">No Inventaris</label>
            <input type="text" class="form-control" name="no_inventaris" id="" value="{{$no}}">
        </div>
        <div class="col-md-6">
            <label for="">Nama Inventaris</label>
            <input type="text" class="form-control" name="nama_inventaris" id="" value="{{$nama}}">
        </div>
        <div class="col-12">
            <label for="">Deskripsi</label>
            <textarea name="" class="form-control" id="" cols="30" rows="10"></textarea>
        </div>
        <div class="col-12 pt-4">
            <button class="btn-primary"><i class="fa fa-save"></i> Simpan</button>
        </div>
    </div>

</form>
