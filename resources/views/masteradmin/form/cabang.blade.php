<div class="modal-header bg-info">
    <h5 class="modal-title text-white">Data Cabang</h5>
    <span>
        <button class="btn-success text-float-right" id="buttontambahcabangbaru" data-url="{{ url('masteradmin/datacabang/tambah', []) }}"><i class="fa fa-plus"></i> Cabang</button>
        <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </span>

</div>
<div class="modal-body" id="divtablecabang">
    <div class="body pb-3" id="divinputcabang">

    </div>
    <div class="body pt-2">
        <div class="row">
           @foreach ($cabang as $cabang)
           
            <div class="col-6 col-lg-4 col-xl-4">
              <div class="card gradient-success rounded-0" style="cursor: pointer;" id="buttondetiledatacabang" data-url="{{ url('masteradmin/datacabang/detail', ['id'=>$cabang->kd_cabang]) }}">
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
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn-dark" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
</div>
