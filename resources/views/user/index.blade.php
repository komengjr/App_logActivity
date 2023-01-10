<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <h4 class="page-title">Dashboardc</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javaScript:void();">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javaScript:void();">Pages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Home</li>
                </ol>
            </div>
           
        </div>
        @if ($message = Session::get('sukses'))
            <div class="alert alert-icon-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <div class="alert-icon icon-part-success">
                    <i class="fa fa-check"></i>
                </div>
                <div class="alert-message">
                    <span><strong>Success!</strong> {{ $message }} </span>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header text-uppercase">
                        <div class="row pt-2 pb-2">
                            <div class="col-9">
                                Laporan Terkini
                            </div>
                            <div class="col-3 text-right">
                                {{-- <button class="btn-success" id="showdatatugas"><i class="fa fa-refresh"></i></button> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body" id="showdatalaporanx">
                        @foreach ($datalaporan as $datalaporan)
                            @if ($datalaporan->type_laporan == 3)
                                <div class="alert alert-danger alert-dismissible" role="alert"
                                    style="cursor: pointer;" data-toggle="modal" data-target="#input_tiketxx"
                                    id="buttonshowdetaillaporan" data-id="{{ $datalaporan->id_tiket_laporan }}">
                                @else
                                    <div class="alert alert-warning alert-dismissible" role="alert"
                                        style="cursor: pointer;" data-toggle="modal" data-target="#input_tiketxx"
                                        id="buttonshowdetaillaporan" data-id="{{ $datalaporan->id_tiket_laporan }}">
                            @endif

                            <div class="alert-icon contrast-alert">
                                <button><i class="fa fa-exclamation-triangle"></i></button>
                            </div>
                            <div class="alert-message">
                                <span style="text-align: justify;"><strong>Laporan Baru : </strong> <span
                                        style="color: black;">{{ $datalaporan->nama_laporan }}</span> Dengan No Tiket
                                    <span style="color: black">{{ $datalaporan->no_tiket }}</span></span>
                            </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @php $jumlahtugashariini = 0; @endphp
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header text-uppercase">
                    <div class="row pt-2 pb-2">
                        <div class="col-9">
                            Actifity Log
                        </div>
                        <div class="col-3 text-right">
                            <button class="btn-success" id="showdatatugas"><i class="fa fa-refresh"></i></button>
                        </div>
                    </div>
                </div>
                <div class="card-body" id="showdatatugasx">
                    @foreach ($groupworklist as $groupworklist)
                        <div class="alert alert-danger alert-dismissible" role="alert" style="cursor: pointer;"
                            data-toggle="modal" data-target="#input_tiketxx" id="buttontiketgroup"
                            data-id="{{ $groupworklist->id_tiket_group_worklist }}">
                            {{-- <button type="button" class="close" data-dismiss="alert">&times;</button> --}}
                            <div class="alert-icon contrast-alert">
                                <button><i class="fa fa-exclamation-triangle"></i></button>
                            </div>
                            <div class="alert-message">
                                <span><strong>Tugas Group :</strong> <span
                                        style="color: black;">{{ $groupworklist->nama_worklist }}</span> <strong>Dengan
                                        No Tiket :</strong> <span
                                        style="color: black;">{{ $groupworklist->no_tiket }}</span></span>
                            </div>
                        </div>
                        @php $jumlahtugashariini = $jumlahtugashariini + 1; @endphp
                    @endforeach
                    @foreach ($worklistperson as $worklistperson)
                        @if (substr($worklistperson->tgl_buat, 0, 10) == date('Y-m-d'))
                            <div class="alert alert-warning alert-dismissible" role="alert" style="cursor: pointer;"
                                data-toggle="modal" data-target="#input_tiketxx" id="buttontiketpersonal"
                                data-id="{{ $worklistperson->id_tiket_worklist_person }}">
                                <div class="alert-icon contrast-alert">
                                    <button><i class="fa fa-exclamation-triangle"></i></button>
                                </div>
                                <div class="alert-message">
                                    <span><strong>Tugas Baru : </strong> <span
                                            style="color: black;">{{ $worklistperson->nama_worklist }}</span> Dengan No
                                        Tiket <span style="color: black">{{ $worklistperson->no_tiket }}</span></span>
                                </div>
                            </div>
                            @php $jumlahtugashariini = $jumlahtugashariini + 1; @endphp
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <h6 class="text-uppercase">Status Tugas</h6>
    <hr />
    <div class="row">
        <div class="col-12 col-lg-4 col-xl-4">
            <div class="card texture-wave-b rounded-0">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="mb-0 text-white">{{ $jumlahtugashariini }}</h5>
                            <p class="mb-0 text-white">Tugas Hari ini</p>
                        </div>
                        <div class="w-icon">
                            <i class="fa fa-tasks text-white"></i>
                        </div>
                    </div>
                    <div class="progress-wrapper mt-3">
                        <div class="progress mb-0" style="height: 5px">
                            @if ($tugashariini == 0)
                                <div class="progress-bar bg-white" role="progressbar" style="width: 100%"></div>
                            @else
                                <div class="progress-bar bg-white" role="progressbar"
                                    style="width: {{ 100 - ($jumlahtugashariini * 100) / ($jumlahtugashariini + $tugashariini) }}%">
                                </div>
                            @endif

                        </div>
                        @if ($tugashariini == 0)
                            <p class="extra-small-font text-white"> 100 % </p>
                        @else
                            <p class="extra-small-font text-white">
                                {{ 100 - ($jumlahtugashariini * 100) / ($jumlahtugashariini + $tugashariini) }} % </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-xl-4">
            <div class="card texture-wave-f rounded-0">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="mb-0 text-white">{{ $tugasbelumselesai }}</h5>
                            <p class="mb-0 text-white">Total Tugas Tidak Selesai</p>
                        </div>
                        <div class="w-icon">
                            <i class="fa fa-warning text-white"></i>
                        </div>
                    </div>
                    <div class="progress-wrapper mt-3">
                        <div class="progress mb-0" style="height: 5px">
                            <div class="progress-bar bg-white" role="progressbar"
                                style="width: {{ $persenbelumselesai }}%"></div>
                        </div>
                        <p class="extra-small-font text-white">
                            {{ $persenbelumselesai }} %
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-xl-4">
            <div class="card texture-wave-c rounded-0">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="mb-0 text-white">{{ $tugasselesai }}</h5>
                            <p class="mb-0 text-white">Total Tugas Selesai</p>
                        </div>
                        <div class="w-icon">
                            <i class="zmdi zmdi-thumb-up text-white"></i>
                        </div>
                    </div>
                    <div class="progress-wrapper mt-3">
                        <div class="progress mb-0" style="height: 5px">
                            <div class="progress-bar bg-white" role="progressbar"
                                style="width: {{ $persenselesai }}%"></div>
                        </div>
                        <p class="extra-small-font text-white">
                            {{ $persenselesai }} %
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--start overlay-->
    <div class="overlay toggle-menu"></div>
    <!--end overlay-->
</div>
</div>
<div class="modal fade" id="input_tiketxx">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-danger" id="bodyformdatainputtiket">

            asd

        </div>
    </div>
</div>

<script src="{{ url('js/user-app.js', []) }}"></script>
