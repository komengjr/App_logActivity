<div class="modal-header bg-info">
    <h5 class="modal-title text-white">Data Group</h5> 
    <span>
        <button class="btn-success text-float-right" id="buttontambahgroupbaru" data-url="{{ url('masteradmin/datagroup/tambah', []) }}"><i class="fa fa-plus"></i> Tambah Group</button>
        <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </span>
    
</div>
<div class="modal-body" id="divtablegroup">
    <div class="body pb-3" id="divinputuser">  
        
    </div>
    <div class="body pt-2" >
      
      <div class="row">
        @foreach ($data as $item)
          <div class="col-12 col-lg-3 col-xl-3">
            <div class="card gradient-danger rounded-0" style="cursor: pointer;" id="showdatagroup" data-url="{{ url('masteradmin/datagroup/show', ['id'=>$item->kd_group]) }}">
              <div class="card-body">
                <div class="media align-items-center">
                  <div class="media-body">
                    <h6 class="mb-0 text-white">{{$item->nama_group}}</h6>
                    <p class="mb-0 text-white">Group 1</p>
                  </div>
                  <div class="w-icon">
                    <i class="zmdi zmdi-accounts-alt text-white"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
       
      </div> 
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn-dark" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
</div>
