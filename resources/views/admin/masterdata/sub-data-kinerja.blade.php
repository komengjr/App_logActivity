<div class="card-header">
    <div class="row">
        <div class="col-md-8">
            <div class="text-uppercase">{{$var->kinerja}}</div>
        </div>
        <div class="col-md-4" style="text-align: right;">
            <button class="btn-success" data-toggle="modal" data-target="#modal-add-kinerja-detail" data-id="{{$var->kd_kinerja}}" id="button-add-kinerja-detail"><i class="fa fa-plus"></i></button>
        </div>
    </div>
</div>

<ul class="list-group list-group-flush shadow-none">
    @foreach ($data as $data)
        <li class="list-group-item" id="button-show-data-kinerja-form" data-toggle="modal"
            data-target="#modal-master-data-kinerja" data-id="{{$data->kd_kinerja_detail}}">
            <div class="media align-items-center">
                <img src="{{ asset('assets/images/avatar/report.png') }}" alt="user avatar"
                    class="customer-img rounded">
                <div class="media-body ml-3">
                    <h6 class="mb-0">{{ $data->kinerja_detail }}</h6>
                </div>
                <div class="date">
                    <i class="fa fa-check-circle"></i>
                </div>
            </div>
        </li>
    @endforeach
</ul>

<div class="card-footer text-center bg-transparent border-0">

</div>
