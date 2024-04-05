<div class="card">
    {{-- <img src="https://via.placeholder.com/800x500" class="card-img-top" alt="Card image cap"> --}}
    <div class="card-body">
        <h5 class="card-title">{{$data->nama_task}}</h5>
        <p class="card-text">{{$data->deskripsi_custom_task}}</p>
    </div>
    <ul class="list-group list-group-flush list shadow-none">
        <li class="list-group-item d-flex justify-content-between align-items-center">Jumlah Item<span
                class="badge badge-info badge-pill">{{count($newsData)}}</span></li>
        <li class="list-group-item d-flex justify-content-between align-items-center">Selesai<span
                class="badge badge-success badge-pill">2</span></li>
    </ul>
    <div class="card-body" style="text-align: right;">
        <button class="btn-primary"><i class="fa fa-save"></i> Penyelesaian Tugas</button>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive m-1 ">
            <table class="table align-items-center table-flush pl-0 pr-0" id="default-table-custom" border="1">
                <thead>
                    <tr>
                        <th>Icon</th>
                        <th>Nama</th>
                        <th>No Inventaris </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($newsData as $item)
                    <tr>
                        <td>
                            @if ($item->gambar == "")
                            <img alt="Image placeholder" src="https://via.placeholder.com/110x110"
                            class="product-img">
                            @else
                            <img alt="Image placeholder" src="http://inventory.pramita.co.id:8000/{{$item->gambar}}" class="product-img">
                            @endif

                        </td>
                        <td>{{$item->nama_barang}}</td>
                        <td>
                            {{$item->no_inventaris}}
                        </td>
                        <td>
                            @php
                                $cek = DB::table('custom_task_sub')->where('kd_custom_task',$data->kd_custom_task)->where('id_inventaris',$item->id_inventaris)->first();
                            @endphp
                            @if ($cek)
                                <span class="badge badge-success">Selesai</span>
                            @else
                            <button class="btn-warning" id="button-lengkapi-custom-subtask" data-id="{{$item->id_inventaris}}" data-no="{{$item->no_inventaris}}" data-nama="{{$item->nama_barang}}" data-kode="{{$data->kd_custom_task}}">Lengkapi</button>
                            @endif


                        </td>
                    </tr>
                    @endforeach
                {{-- {{$data}} --}}
                </tbody>
            </table>
        </div>
    </div>
</div>
<form action="" id="form-maintenance-barang-inventaris" method="post">
    @csrf
</form>
<script>
    $(document).ready(function() {

        $('#default-table-custom').DataTable();

    });
</script>
