<form action="{{ url('admin/data/cabang/menuhandle/posttambahdata', []) }}" method="post">
    @csrf
<div class="row">
    <div class="col-md-6">
        <label for="">Cari Data User</label>
        <select name="user" id="" class="form-control single-select" required>
            <option value="">Pilih User</option>
            @foreach ($data as $item)
            <option value="{{$item->id_user}}"><i class="fa fa-user-o"></i> {{$item->nama_lengkap}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label for="">Pilih Tanggal</label>
        <input type="date" class="form-control" name="tanggal" required>
        <input type="text" class="form-control" name="cabang" value="{{$id}}" hidden>
    </div>
</div>
<br>
<button class="btn-success">Simpan</button>
</form>
<script>
    $(document).ready(function() {
        $('.single-select').select2();
      });

</script>
