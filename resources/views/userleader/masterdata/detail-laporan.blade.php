<style>
    img {
        max-width: 100%;
        height: auto;
        width: auto\9;
        /* ie8 */
    }
</style>
<div class="card">
    {{-- <img src="https://via.placeholder.com/800x500" class="card-img-top" alt="Card image cap"> --}}
    <div class="card-body bg-dark">
        <h5 class="card-title" style="color: white;">Report<button style="float: right;" class="btn-danger"
                data-dismiss="modal"><i class="fa fa-close"></i></button></h5>
        {{-- <p class="card-text">{{$item->alamat}}</p> --}}

    </div>
    <div class="modal-body" id="menu-custom-handle-user">
        <div class="card">
            <div class="card-body">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h3>
                        Tiket :
                        <small>{{ $tiket }}</small>
                    </h3>
                </section>

                <!-- Main content -->
                <section class="invoice">
                    <!-- title row -->

                    <hr>
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            From
                            <address>
                                <strong>{{ $data->nama_user }}</strong><br>
                                {{ $data->divisi }}<br>
                                Email: {{ $data->email }}
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            To
                            <address>
                                <strong>{{ $data->nama_cabang }}</strong><br>
                                {{ $data->phone }}<br>
                                {{ $data->alamat }}
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col" style="text-align: right;">
                            <div class="col-sm pt-1">
                                <h6 class="mb-2"><span class="badge bg-dark text-white">Waktu Laporan
                                        Masuk</span></h6>
                                <p class="mb-0">{{ $data->tgl_laporan }}</p>
                            </div>
                            <div class="col-sm pt-1">
                                <h6 class="mb-2"><span class="badge bg-primary text-white">Waktu Terima
                                        Laporan</span></h6>
                                <p class="mb-0">{{ $data->tgl_respon_laporan }}</p>
                            </div>
                            <div class="col-sm pt-1">
                                <h6 class="mb-2"><span class="badge bg-success text-white">Waktu Selesai
                                        Laporan</span></h6>
                                <p class="mb-0">{{ $data->tgl_selesai_laporan }}</p>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <hr>
                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-lg-6 payment-icons">
                            <p class="lead">Problem :</p>

                            <p class="bg-light p-2 mt-3 rounded">
                                @php
                                    echo $data->deskripsi_laporan;
                                @endphp
                            </p>
                        </div>
                        <!-- /.col -->
                        <div class="col-lg-6">
                            <p class="lead">Answer :</p>
                            @php
                                $cekanswer = DB::table('tbl_laporan_user_log')->where('tiket_laporan', $tiket)->first();
                            @endphp
                            @if ($cekanswer)
                                @php
                                    echo $cekanswer->deskripsi_penyelesaian;
                                @endphp
                            @else
                                <p class="bg-light p-2 mt-3 rounded">
                                    <span class="badge bg-warning">Belum Selesai</span>
                                </p>
                            @endif

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <hr>
                    <div class="row no-print">
                        <div class="col-lg-3">
                            <a href="javascript:window.print();" target="_blank" class="btn btn-dark m-1"><i
                                    class="fa fa-print"></i> Print</a>
                        </div>
                        <div class="col-lg-9">
                            <div class="float-sm-right">
                                @if ($cekanswer)
                                    <button class="btn btn-success m-1" disabled>
                                        <i class="fa fa-save"></i> Selesai
                                    </button>
                                @else
                                    <button class="btn btn-warning m-1" disabled>
                                        <i class="fa fa-info"></i> Belum Selesai
                                    </button>
                                @endif

                            </div>
                        </div>
                    </div>
                </section>
                <!-- /.content -->
            </div>
        </div>
    </div>
</div>
