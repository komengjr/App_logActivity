<div class="body pb-3" id="divinputcabang">

</div>
<div class="body pt-2">
    <div class="row">
       @foreach ($cabang as $cabang)
       
        <div class="col-6 col-lg-4 col-xl-4">
          <div class="card gradient-success rounded-0" style="cursor: pointer;">
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