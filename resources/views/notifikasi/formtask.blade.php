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
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-center">
                    <div><i class="bx bxs-user me-1 font-22 text-white"></i>
                    </div>
                    <h5 class="mb-0">Detail Laporan</h5>
                </div>
                <hr>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="inputLastName1" class="form-label">Kategori Laporan</label>
                        <div class="input-group"> <span class="input-group-text"><i class="fa fa-cog"></i></span>
                            <input type="text" class="form-control border-start-0" id="inputLastName1"
                                value="{{ $datalaporan->kategori_laporan }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="inputLastName2" class="form-label">Pelapor</label>
                        <div class="input-group"> <span class="input-group-text"><i class="fa fa-user-o"></i></span>
                            <input type="text" class="form-control border-start-0" id="inputLastName2"
                                value="{{ $datalaporan->nama_user }}" disabled>
                        </div>
                        <input type="text" name="tiket" value="{{ $datalaporan->tiket_laporan }}" hidden>
                    </div>
                    <div class="col-md-6">
                        <label for="inputLastName1" class="form-label">Waktu Laporan</label>
                        <div class="input-group"> <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            <input type="text" class="form-control border-start-0" id="inputLastName1"
                                value="{{ $datalaporan->tgl_laporan }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="inputLastName2" class="form-label">Divisi</label>
                        <div class="input-group"> <span class="input-group-text"><i class="fa fa-user-o"></i></span>
                            <input type="text" class="form-control border-start-0" id="inputLastName2"
                                value="{{ $datalaporan->divisi }}" disabled>
                        </div>
                        <input type="text" name="tiket" value="{{ $datalaporan->tiket_laporan }}" hidden>
                    </div>

                    <div class="col-12">
                        <label for="inputAddress3" class="form-label">Deskripsi Laporan</label>
                        {{-- <textarea class="form-control" id="inputAddress3" placeholder="Enter Address" rows="3" disabled>{{  }}</textarea> --}}
                        @php
                            echo $datalaporan->deskripsi_laporan;
                        @endphp
                    </div>

                    <div class="col-12 pt-3" id="menu-respon-laporan-user">
                        @if ($datalaporan->tgl_respon_laporan == '')
                            <button type="submit" class="btn btn-primary px-5" id="button-respon-laporan-user"
                                data-id="{{ $datalaporan->tiket_laporan }}">Terima Laporan</button>
                        @else
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Waktu masuk Laporan</label>
                                    <span class="badge badge-pill badge-dark m-1"
                                        style="float:right;">{{ $datalaporan->tgl_laporan }}</span>
                                </div>
                                <div class="col-12">
                                    <label for="">Waktu Respon Laporan</label>
                                    <span class="badge badge-pill badge-success m-1"
                                        style="float:right;">{{ $datalaporan->tgl_respon_laporan }}</span>
                                </div>
                                <div class="col-12">
                                    <label for="">Waktu Penyelesaian Laporan</label>
                                    <span class="badge badge-pill badge-warning m-1" style="float:right;"
                                        id="sisa"></span>
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

                                <label for="">Penyelesaian</label>
                                <textarea name="keterangan" class="form-control" id="summernoteEditor88" cols="5" rows="10" required></textarea>

                        @endif
                    </div>

                </div>
            </div>

        </div>


    </div>
    <div class="modal-footer">
        @if ($datalaporan->tgl_respon_laporan != '')
            <button type="submit" class="btn-primary">
                <i class="fa fa-check-square-o"></i> Simpan
            </button>
        @endif

    </div>

</form>
<script src="{{ asset('assets/plugins/summernote/dist/summernote-bs4.min.js', []) }}"></script>
<script>
    $('#summernoteEditor88').summernote({
        height: 400,
        tabsize: 2
    });
</script>
