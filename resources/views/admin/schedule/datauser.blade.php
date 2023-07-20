<div class="media mb-3">
    <img src="{{ asset('1.jpg') }}"
        class="rounded-circle mr-3 mail-img shadow" alt="media image" />
    <div class="media-body">
        <span class="media-meta float-right">08:22 AM</span>
        <h4 class="m-0">{{$data->kinerja}}</h4>
        <small>From : info@example.com</small>
    </div>
</div>
<!-- media -->

@php
    echo $data->ket_schedule;
@endphp

<hr />
<div class="media mb-3">
    <img src="{{ asset('1.jpg') }}"
        class="rounded-circle mr-3 mail-img shadow" alt="media image" />
    <div class="media-body">
        <span class="media-meta float-right">08:22 AM</span>
        <h4 class="m-0">{{$data->kinerja}}</h4>
        <small>From : info@example.com</small>
    </div>
</div>
<div class="body">

    @if ($datataskuser)
        @php
            echo $datataskuser->deskripsi_schedule;
        @endphp
    @else
        belum
    @endif
</div>

<form class="mt-3">
    <div class="form-group">
        <textarea class="form-control" rows="9" placeholder="Reply here..."></textarea>
    </div>
</form>

<div class="text-right">
    <button type="button"
        class="btn btn-primary waves-effect waves-light mt-3">
        <i class="fa fa-send mr-1"></i> Verify
    </button>
</div>
