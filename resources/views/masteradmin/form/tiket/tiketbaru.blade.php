<div class="modal-header bg-info">
    <h5 class="modal-title text-white">Buat Tiket</h5> 
    <span>
       
        <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </span>
    
</div>

<div class="modal-body" id="divtabletypeworklist">
    
   
        <div class="row">  
            <div class="col-12">
                <label for="">Pilih Type Tiket</label>
                <select name="type_tiket" class="form-control single-select" onchange="getDataOptionTiket()" id="datatiket" required>
                    <option value="">Pilih Salah satu</option>
                    <option value="1">Tiket Personal</option>
                    <option value="2">Tiket Group</option>
                    <option value="3">Tiket Laporan</option>
                </select>
            </div>
        </div>
        <div class="body" id="optiontiketmasteradmin">
    
        </div>
   
    
</div>

<script>
    $(document).ready(function() {
        $('.single-select').select2();
      });

</script>