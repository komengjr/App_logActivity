<div class="row">
    <div class="col-12">
        <label for="">Waktu masuk Laporan</label>
        <span class="badge badge-pill badge-dark m-1" style="float:right;">{{ $data->tgl_laporan }}</span>
    </div>
    <div class="col-12">
        <label for="">Waktu Respon Laporan</label>
        <span class="badge badge-pill badge-success m-1" style="float:right;">{{ $data->tgl_respon_laporan }}</span>
    </div>
    <div class="col-12">
        <label for="">Waktu Penyelesaian Laporan</label>
        <span class="badge badge-pill badge-warning m-1" style="float:right;" id="sisa"></span>
    </div>
    <div class="col-12 pt-2">
        <label for="">Penyelesaian</label>
        <textarea name="keterangan" class="form-control" id="summernoteEditor88" cols="5" rows="10" required></textarea>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn-primary">
            <i class="fa fa-check-square-o"></i> Simpan
        </button>
    <div class="modal-footer">
</div>
{{-- <span class="badge badge-pill badge-warning m-1" style="float:right;" id="demo">{{$data->tgl_respon_laporan}}</span> --}}
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
<script>
    $('#summernoteEditor88').summernote({
        height: 400,
        tabsize: 2
    });
</script>
