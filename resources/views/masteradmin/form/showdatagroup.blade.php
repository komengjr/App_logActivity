<div class="modal-header bg-info">
    <h5 class="modal-title text-white">Data Group A</h5>
    <span>
        <button class="btn-warning text-float-right" id="buttontambahgroupcabangbaru" data-url="{{ url('masteradmin/datagroup/tambah/cabang', ['id'=>$id]) }}"><i class="fa fa-plus"></i> Cabang</button>
        <button class="btn-warning text-float-right" id="buttontambahgroupuserbaru" data-url="{{ url('masteradmin/datagroup/tambah/user', ['id'=>$id]) }}"><i class="fa fa-plus"></i> User</button>
        <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </span>

</div>
<div class="modal-body" id="divtablegroup">
    <div class="body pb-3" id="divinputuser">

    </div>
    <div class="body pt-2">
        <div class="row">
           @foreach ($cabang as $cabang)
           
            <div class="col-6 col-lg-3 col-xl-3">
              <div class="card gradient-primary rounded-0">
                <div class="card-body">
                  <div class="media align-items-center">
                    <div class="media-body">
                      <h6 class="mb-0 text-white">{{$cabang->nama_cabang}}</h6>
                      <p style="font-size: 9px;" class="mb-0 text-white">Total Report : </p>
                    </div>
                   
                  </div>
                </div>
              </div>
            </div>
              
            @endforeach
        </div>
        <hr>
        <div class="row">
            @foreach ($user as $user)
            
            <div class="col-lg-4">
                <div class="card">
                    {{-- <img src="https://via.placeholder.com/800x500" class="card-img-top" alt="Card image cap"> --}}
                    <div class="card-body">
                        <h5 class="card-title">{{$user->name}}</h5>
                        <p class="card-text"></p>
                    </div>
                    <ul class="list-group list-group-flush list shadow-none">
                        <li class="list-group-item d-flex justify-content-between align-items-center">Cras justo odio
                            <span class="badge badge-info badge-pill">14</span></li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Dapibus ac
                            facilisis in
                            <span class="badge badge-success badge-pill">2</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Vestibulum at eros
                            <span class="badge badge-danger badge-pill">1</span></li>
                    </ul>
                    <div class="card-body">
                        <button href="javascript:void();" class="btn-danger"><i class="fa fa-trash"></i></button>
                        <button href="javascript:void();" class="btn-info" style="float: right;"><i class="fa fa-eye"></i></button>
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
