<div class="modal-header bg-info">
    <h5 class="modal-title text-white">Data Worklist</h5> 
    <span>
        <button class="btn-success text-float-right" id="buttontambahworklistbaru" data-url="{{ url('masteradmin/dataworklist/tambah', []) }}"><i class="fa fa-plus"></i> Tambah User</button>
        <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </span>
    
</div>
<div class="modal-body" id="divtableworklist">
    <div class="body p-3" id="divinputworklist">  
        
    </div>
    <div class="body pt-2" >
        <table class="styled-table" id="default-datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Worklist</th>
                    <th>Nama Worklist</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
               
            </tbody>
        </table>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn-dark" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
</div>
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