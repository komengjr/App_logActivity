<div class="modal-header">
    <h5 class="modal-title">{{ $var->kinerja_detail }}</h5>
    <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
<div class="modal-body">
    <div class="card-body">
        <form id="form-field-data-kinerja" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label for="">id</label>
                    <input type="text" class="form-control" name="id_field" value="{{ $var->kd_kinerja_detail }}">
                </div>
                <div class="col-md-6">
                    <label for="">Field</label>
                    <input type="text" class="form-control" name="field" id="">
                </div>
                <div class="col-md-6">
                    <label for="">Type Field</label>
                    <select class="form-control" name="type">
                        <option value="">Pilih Type</option>
                        <option value="text">Text</option>
                        <option value="integer">Angka</option>
                        <option value="date">Date</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="">Posisi Field</label>
                    <input type="text" class="form-control" name="posisi">
                </div>

                <div class="col-md-4 pt-2" style="justify-content: right;">
                    <button class="btn btn-success" id="button-tambah-field-form-kinerja"><i
                            class="fa fa-plus"></i> Simpan</button>
                </div>
            </div>
        </form>
        <hr>
        <div class="table-responsive" id="table-field-form">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Field</th>
                        <th scope="col">Type Field</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($data as $data)
                        <tr>
                            <th scope="row">{{ $no++ }}</th>
                            <td>{{ $data->nama_form }}</td>
                            <td>{{ $data->type_form }}</td>
                            <td>
                                <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="fa fa-times"></i>
        Close</button>
</div>
