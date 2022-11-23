@foreach ($groupworklist as $groupworklist)
<div class="alert alert-danger alert-dismissible" role="alert">
    {{-- <button type="button" class="close" data-dismiss="alert">&times;</button> --}}
    <div class="alert-icon contrast-alert">
        <i class="fa fa-times"></i>
    </div>
    <div class="alert-message">
        <span><strong>Danger!</strong> This is a warning alert—check it out!</span>
    </div>
</div>
@endforeach
@foreach ($worklistperson as $worklistperson)
<div class="alert alert-warning alert-dismissible" role="alert" style="cursor: pointer;" data-toggle="modal" data-target="#input_tiket" id="buttontiketpersonal">
    {{-- <button type="button" class="close" data-dismiss="alert">&times;</button> --}}
    <div class="alert-icon contrast-alert">
        <i class="fa fa-exclamation-triangle"></i>
    </div>
    <div class="alert-message">
        <span><strong>Tugas Baru !</strong> {{$worklistperson->nama_worklist}}</span>
    </div>
</div>
@endforeach