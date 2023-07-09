<div class="modal-header bg-primary">
    <h5 class="modal-title text-white">
        Data Task Leader
    </h5>
    <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
        <div id="detaildatatask"></div>
        <table class="styled-table" id="default-datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kinerja</th>
                    <th>User</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no =1;
                @endphp
                @foreach ($datatikettask as $item)
                    <tr>
                        <td data-label="No">{{$no++}}</td>
                        <td data-label="Kinerja">{{$item->kinerja}}</td>
                        <td data-label="User">{{$item->nama_cabang}}</td>
                        <td data-label="Mulai">{{$item->tgl_start}}</td>
                        <td data-label="Selesai">{{$item->tgl_end}}</td>
                        <td class="text-center">
                            @if ($item->status_task == 1)
                                <span class="badge badge-danger badge-xl">Unfinished</span>
                            @else

                            @endif
                        </td>
                        <td><button class="btn-dark" id="buttondetailtask" data-id="{{$item->kd_tiket_task}}">Lihat</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

</div>
<div class="modal-footer">
    <button type="submit" class="btn-primary">
        <i class="fa fa-check-square-o"></i>
    </button>
</div>

<script src="{{ asset('assets/plugins/summernote/dist/summernote-bs4.min.js', []) }}"></script>
<script>
    $(document).ready(function() {

        $('#default-datatable').DataTable();
        var table = $('#example').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
        });
        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');

    });
</script>
