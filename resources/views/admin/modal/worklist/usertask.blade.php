<div class="row">
    <div class="row p-3">
        <div class="col-sm-12">
            <h4 class="page-title">{{$data->kinerja}} :</h4>
            <ol class="breadcrumb">
                @php
                    echo $data->ket_schedule;
                @endphp
            </ol>
        </div>

    </div>
    <table class="styled-table" id="default-datatableuser">
        <thead>
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Kinerja</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($user as $item)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$item->name}}</td>
                    <td></td>
                    <td></td>
                    <td class="text-center">

                    </td>
                    <td class="text-center">
                        <div class="dropdown">
                            <button
                              class="dropdown-toggle dropdown-toggle-nocaret btn-warning"
                              data-toggle="dropdown">Option

                          </button>
                            <div class="dropdown-menu dropdown-menu-right">
                              <a class="dropdown-item" href="javascript:void();" id="b"><i class="fa fa-eye"></i> Lihat Pengerjaan</a>
                              <a class="dropdown-item" href="javascript:void();"><i class="fa fa-pencil"></i> Edit</a>
                              <a class="dropdown-item" href="javascript:void();"><i class="fa fa-trash"></i> Hapus</a>

                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {

        $('#default-datatableuser').DataTable();

    });
</script>
