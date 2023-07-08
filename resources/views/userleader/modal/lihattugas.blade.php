<div class="modal-header bg-primary">
    <h5 class="modal-title text-white">
        Data Task Leader
    </h5>
    <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">

        <table class="styled-table" id="default-datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kinerja</th>
                    <th>User</th>
                    <th>Deskripsi Tugas</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datatikettask as $item)
                    <tr>
                        <td>1</td>
                        <td>{{$item->kinerja}}</td>
                        <td>{{$item->nama_cabang}}</td>
                        <td>
                            @php
                                echo $item->deskripsi_task;
                            @endphp
                        </td>
                        <td class="text-center">
                            @if ($item->status_task == 1)
                                <span class="badge badge-danger badge-xl">Unfinished</span>
                            @else

                            @endif
                        </td>
                        <td><button class="btn-dark">Lihat</button></td>
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
