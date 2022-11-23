<div class="modal-header bg-info">
    <h5 class="modal-title text-white">Data Tiket Laporan</h5> 
    <span>
        {{-- <button class="btn-success text-float-right" id="buttontambahuserbaru" data-url="{{ url('masteradmin/datauser/tambah', []) }}"><i class="fa fa-plus"></i> Tambah User</button> --}}
        <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </span>
    
</div>
<div class="modal-body" id="divtableuser">
    <div class="body p-3" id="divinputuser">  
        
    </div>
    <div class="body pt-2" >
        <table class="styled-table" id="default-tiketlaporan">
            <thead>
                <tr>
                    <th>No</th>
                    <th>no Tiket</th>
                    <th>Nama Worklist</th>
                    <th>Tugas Group</th>
                    <th>Tgl Tugas</th>
                    <th>status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no=1;
                @endphp
              
            </tbody>
        </table>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn-dark" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
</div>
<script>
    $(document).ready(function() {

        $('#default-tiketlaporan').DataTable();
        var table = $('#example').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
        });
        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');

    });
</script>