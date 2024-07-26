<div class="card p-2">
    <form id="form-post-data-inventaris-maintenance-perangkat-detail">
        @csrf
        <div class="row m-1">
            <div class="col-lg-12">
                <label for="">Parameter</label>
                <input type="text" class="form-control" name="parameter" id="parameter" >
                <input type="text" class="form-control" name="kode" value="{{$kode}}" hidden>

            </div>
            <div class="col-lg-12">
                <label for="">Parameter Value</label>
                <input type="text" class="form-control" name="parameter_value" id="parameter_value" >
            </div>

            <div class="col-6 pt-4">
                <button type="button" class="btn-primary" id="button-simpan-parameter-barang-maintenance"><i
                        class="fa fa-save"></i>
                    Simpan</button>
            </div>
        </div>
    </form>
</div>
<div class="card pb-2">
    <div class="card-header border-0">
        Nama Perangkat : {{$newsData->nama_barang}} <br>
        No Inventaris : {{$newsData->no_inventaris}} <br>
        Merek : {{$newsData->merk}} <br>
        type : {{$newsData->type}} <br>
        No Seri : {{$newsData->no_seri}}

    </div>
    <div class="table-responsive pt-3 pb-3" id="table-list-detail-perangkat-maintenance">
        <table class="table align-items-center table-flush" id="default-table-custom-task" border="1"
            style="text-align: justify;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Parameter</th>
                    <th>Parameter Value</th>
                    <th>Tgl Input</th>
                    {{-- <th>Action</th> --}}
                </tr>
            </thead>
            <tbody>
                @php
                    $no =1;
                @endphp
                @foreach ($dataperangkat as $dataperangkat)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$dataperangkat->parameter}}</td>
                    <td>{{$dataperangkat->parameter_value}}</td>
                    <td>{{$dataperangkat->tgl_input}}</td>
                    {{-- <td>
                        <button class="btn-danger"><i class="fa fa-pencil"></i></button>
                    </td> --}}
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
<div class="footer">
    <form action="{{ route('user/user/handledatacabang/taskbulanan/maintenance-bulanan/simpan-detail/verif-perangkat') }}" method="post">
        @csrf
        <button type="submit" class="btn-primary">Verifikasi</button>
    </form>
</div>
<script>
    $(document).ready(function() {

        $('#default-table-custom-task').DataTable();

    });
</script>
