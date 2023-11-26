@foreach ($data as $data)
<style>
    #lihatdatacabang:hover {
            color: #fff;
            background-color: #00e5ff;
            border-color: #07aaeb
        }
</style>
<div class="col-12 col-lg-3 col-xl-3" style="cursor: pointer;" id="button-pilih-cabang-case" data-id="{{$data->kd_cabang}}">
    <div class="card gradient-danger rounded-0" id="lihatdatacabang">
       <div class="card-body" id="lihatdatacabang">
         <div class="media align-items-center">
           <div class="media-body">
             {{-- <h5 class="mb-0 text-white">12 Kasus</h5> --}}
             <p class="mb-0 text-white"><b>{{$data->nama_cabang}}</b></p>
           </div>
           <div class="w-icon"><i class="zmdi zmdi-balance-wallet text-white"></i></div>
         </div>
       </div>
     </div>
</div>

@endforeach
<script>
    $(document).on('click', '#button-pilih-cabang-case', function(e) {
    e.preventDefault();
    var id = $(this).data("id");
    var url = 'pilihcabang/'+id;
    $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data) {
            $('#fix-data-cabang').html(data);
        })
        .fail(function() {
            $('#fix-data-cabang').html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                );
        });
});
</script>
