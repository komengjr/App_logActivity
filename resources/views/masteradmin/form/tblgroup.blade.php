<div class="body p-3" id="divinputuser">  
        
</div>
<div class="body pt-2" >
  <div class="row">
    @foreach ($data as $item)
      <div class="col-6 col-lg-3 col-xl-3">
        <div class="card gradient-danger rounded-0" style="cursor: pointer;" id="showdatagroup" data-url="{{ url('masteradmin/datagroup/show', ['id'=>$item->kd_group]) }}">
          <div class="card-body">
            <div class="media align-items-center">
              <div class="media-body">
                <h6 class="mb-0 text-white">{{$item->kd_group}}</h6>
                <p class="mb-0 text-white">{{$item->nama_group}}</p>
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