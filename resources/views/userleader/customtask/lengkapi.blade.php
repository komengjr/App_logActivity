<div class="card">
    {{-- <img src="https://via.placeholder.com/800x500" class="card-img-top" alt="Card image cap"> --}}
    <div class="card-body">
        <h5 class="card-title">Card Sample title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
            content.</p>
    </div>
    <ul class="list-group list-group-flush list shadow-none">
        <li class="list-group-item d-flex justify-content-between align-items-center">Jumlah Item<span
                class="badge badge-info badge-pill">14</span></li>
        <li class="list-group-item d-flex justify-content-between align-items-center">Selesai<span
                class="badge badge-success badge-pill">2</span></li>
    </ul>
    <div class="card-body" style="text-align: right;">
        <button class="btn-success"><i class="fa fa-plus"></i> Tambah Item</button>
        <button class="btn-primary"><i class="fa fa-save"></i> Penyelesaian Tugas</button>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive m-1">
            <table class="styled-table" id="default-table-custom">
                <thead>
                    <tr>
                        <th>Icon</th>
                        <th>Nama</th>
                        <th>No Inventaris </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td>
                            <img alt="Image placeholder" src="http://inventory.pramita.co.id:8000/{{$item->gambar}}" class="product-img">
                        </td>
                        <td>{{$item->nama_barang}}</td>
                        <td>
                            {{$item->no_inventaris}}
                        </td>
                        <td><button class="btn-warning" id="button-lengkapi-custom-subtask" data-id="123">Lengkapi</button>
                        </td>
                    </tr>
                    @endforeach
                {{-- {{$data}} --}}
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $('#default-table-custom').DataTable();

    });
</script>
