<form action="" method="post" id="formpostuseredit">
    @csrf
    <div class="row">
        <div class="col-6">
            <label for="">Nama Lengkap</label>
            <input type="text" class="form-control" name="nama" value="{{ $data[0]->name }}">
            <input type="text" class="form-control" name="id" value="{{ $data[0]->id }}" hidden>
        </div>
        <div class="col-6">
            <label for="">akses</label>
            <select name="akses" id="" class="form-control">
                @if ($data[0]->kd_akses == 1)
                    <option value="1">Master Admin</option>
                    <option value="2">Admin</option>
                    <option value="3">User Leader</option>
                    <option value="4">User</option>
                @elseif($data[0]->kd_akses == 2)
                    <option value="2">Admin</option>
                    <option value="1">Master Admin</option>
                    <option value="3">User Leader</option>
                    <option value="4">User</option>
                @elseif($data[0]->kd_akses == 3)
                    <option value="3">User Leader</option>
                    <option value="2">Admin</option>
                    <option value="1">Master Admin</option>
                    <option value="4">User</option>
                @elseif($data[0]->kd_akses == 4)
                    <option value="4">User</option>
                    <option value="3">User Leader</option>
                    <option value="2">Admin</option>
                    <option value="1">Master Admin</option>
                @endif
            </select>
        </div>
        <div class="col-6">
            <label for="">Username</label>
            <input type="text" class="form-control" name="username" value="{{ $data[0]->email }}">
        </div>
        <div class="col-6">
            <label for="">Password</label>
            <input type="password" class="form-control" name="password">
        </div>
        <div class="col-12 mt-3">
            <div class="text-right">
                <button class="btn-success" id="simpandatauseredit"
                    data-url="{{ url('masteradmin/datauser/post/edit', []) }}"><i class="fa fa-save"></i> Update
                    Data</button>
            </div>
        </div>
    </div>
</form>
