<div class="modal-header bg-primary">
    <h5 class="modal-title text-white">
        Task : {{ $datalaporan->nama_user }}
    </h5>
    <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form action="{{ asset('user/userleader/postschedule') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                Deskripsi :

                @php
                    echo $datalaporan->deskripsi_laporan;
                @endphp

                <input type="text" name="tiket" value="{{ $datalaporan->tiket_laporan }}" hidden>
            </div>
            <div class="col-md-6" id="menu-respon-laporan-user">
                @if ($datalaporan->tgl_respon_laporan == '')
                    <button class="btn-success" style="float: right;" id="button-respon-laporan-user"
                        data-id="{{ $datalaporan->tiket_laporan }}"><i class="fa fa-check-circle"></i> Terima
                        Laporan</button>
                @else
                    <div class="row">
                        <div class="col-12">
                            <span>Waktu masuk Laporan</span>
                            <span class="badge badge-pill badge-dark m-1"
                                style="float:right;">{{ $datalaporan->tgl_laporan }}</span>
                        </div>
                        <div class="col-12">
                            <span>Waktu Respon Laporan</span>
                            <span class="badge badge-pill badge-success m-1"
                                style="float:right;">{{ $datalaporan->tgl_respon_laporan }}</span>
                        </div>
                        <div class="col-12">
                            <label for="">Waktu Penyelesaian Laporan</label>
                            <span class="badge badge-pill badge-warning m-1" style="float:right;" id="sisa"></span>
                        </div>
                    </div>
                    <script>
                        // Set the date we're counting down to
                        var countDownDate = new Date("{{ date_format($date, 'Y-m-d H:i:s') }}").getTime();

                        // Update the count down every 1 second
                        var y = setInterval(function() {

                            // Get today's date and time
                            var skrng = new Date().getTime();

                            // Find the distance between now and the count down date
                            var sisa = countDownDate - skrng;

                            // Time calculations for days, hours, minutes and seconds
                            var hari = Math.floor(sisa / (1000 * 60 * 60 * 24));
                            var jam = Math.floor((sisa % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            var menit = Math.floor((sisa % (1000 * 60 * 60)) / (1000 * 60));
                            var sec = Math.floor((sisa % (1000 * 60)) / 1000);

                            // Display the result in the element with id="demo"
                            document.getElementById("sisa").innerHTML = hari + "d " + jam + "h " + menit + "m " + sec + "s ";

                            // If the count down is finished, write some text
                            if (sisa < 0) {
                                clearInterval(y);
                                document.getElementById("sisa").innerHTML = "EXPIRED";
                            }
                        }, 1000);
                    </script>
                @endif

            </div>

            <div class="col">
                <label for="">Penyelesaian</label>
                <textarea name="keterangan" class="form-control" id="summernoteEditor88" cols="5" rows="10" required></textarea>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn-primary">
            <i class="fa fa-check-square-o"></i> Simpan
        </button>
    </div>

</form>
<script src="{{ asset('assets/plugins/summernote/dist/summernote-bs4.min.js', []) }}"></script>
<script>
    $('#summernoteEditor88').summernote({
        height: 400,
        tabsize: 2
    });
</script>
