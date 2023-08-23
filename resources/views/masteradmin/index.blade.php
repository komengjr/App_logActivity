<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKXKdHQdtqgPVl2HI2RnUa_1bjCxRCQo4&callback=initialize" async defer></script>
<script>

    var marker;
    function taruhMarker(peta, posisiTitik) {
        if (marker) {
            // pindahkan marker
            marker.setPosition(posisiTitik);
        } else {
            // buat marker baru
            marker = new google.maps.Marker({
                position: posisiTitik,
                map: peta
            });
        }

        document.getElementById("lat").value = posisiTitik.lat();
        document.getElementById("lng").value = posisiTitik.lng();

    }

    function initialize() {
        var propertiPeta = {
            center: new google.maps.LatLng(-1.8781997186074901, 113.59564212500003),
            zoom: 5,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);

        // even listner ketika peta diklik
        google.maps.event.addListener(peta, 'click', function(event) {
            taruhMarker(this, event.latLng);
        });

    }
</script>
<style>
    .modal {
      padding: 10px; !important; //
    }
    .modal .modal-dialog {
      width: 100%;
      max-width: none;
      /* height: 100%; */
      margin: 0;
    }
    .modal .modal-content {
      /* height: 100%; */
      border: 0;
      border-radius: 0;
    }
    .modal .modal-body {
      overflow-y: auto;
    }
    </style>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <h4 class="page-title">Dashboard</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javaScript:void();">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#" onclick="notifikasi();">Pages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Master Admin</li>
                </ol>
            </div>
            <div class="col-sm-3">
                <div class="btn-group float-sm-right mb-3">
                    <button type="button" class="btn btn-light waves-effect waves-light"><i class="fa fa-cog mr-1"></i>
                        Input Data</button>
                    <button type="button"
                        class="btn btn-light dropdown-toggle dropdown-toggle-split waves-effect waves-light"
                        data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>
                    <div class="dropdown-menu">
                        <a href="javaScript:void();" class="dropdown-item"><i class="fa fa-exclamation-circle"></i>
                            Input Keluhan</a>
                        <a href="javaScript:void();" class="dropdown-item">Another action</a>
                        <a href="javaScript:void();" class="dropdown-item">Something else here</a>
                        <div class="dropdown-divider"></div>
                        <a href="javaScript:void();" class="dropdown-item" data-toggle="modal"
                            data-target="#masteradmintiket" id="tombolbuattiketworklist"
                            data-url="{{ url('masteradmin/tiket', []) }}"><i class="fa fa-ticket"></i> Buat Tiket
                            Tugas</a>
                    </div>
                </div>
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
            <div class="col-12 col-lg-6 col-xl-3">
                <div class="card gradient-esinto rounded-5" style="cursor: pointer;" data-toggle="modal"
                    data-target="#datamasteradmin" id="datausermasteradmin"
                    data-url="{{ url('masteradmin/datauser', []) }}">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <h5 class="mb-0 text-white">{{$datauser}}</h5>
                                <p class="mb-0 text-white">Data User</p>
                            </div>
                            <div class="w-icon">
                                <i class="fa fa-user text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3">
                <div class="card gradient-dunada rounded-5" style="cursor: pointer;" data-toggle="modal"
                    data-target="#datamasteradminx" id="datacabangmasteradmin"
                    data-url="{{ url('masteradmin/datacabang', []) }}">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <h5 class="mb-0 text-white">{{$data_cabang}}</h5>
                                <p class="mb-0 text-white">Data Cabang</p>
                            </div>
                            <div class="w-icon">
                                <i class="zmdi zmdi-home text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3">
                <div class="card gradient-linga rounded-5" style="cursor: pointer" data-toggle="modal"
                    data-target="#datamasteradmin" id="datagroupmasteradmin"
                    data-url="{{ url('masteradmin/datagroup', []) }}">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <h5 class="mb-0 text-white">{{$data_group}}</h5>
                                <p class="mb-0 text-white">User Group</p>
                            </div>
                            <div class="w-icon">
                                <i class="zmdi zmdi-share text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3">
                <div class="card gradient-blkw rounded-5" style="cursor: pointer;" data-toggle="modal"
                    data-target="#datamasteradmin" id="datataskmasteradmin"
                    data-url="{{ url('masteradmin/datatask', []) }}">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <h5 class="mb-0 text-white">0</h5>
                                <p class="mb-0 text-white">Data Task</p>
                            </div>
                            <div class="w-icon">
                                <i class="fa fa-briefcase text-dark"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3">
                <div class="card gradient-blkw rounded-5" style="cursor: pointer;" data-toggle="modal"
                    data-target="#datamasteradmin" id="dataworklistmasteradmin"
                    data-url="{{ url('masteradmin/dataworklist', []) }}">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <h5 class="mb-0 text-white">{{$data_worklist}}</h5>
                                <p class="mb-0 text-white">Data Worklist</p>
                            </div>
                            <div class="w-icon">
                                <i class="fa fa-briefcase text-dark"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3">
                <div class="card gradient-dunada rounded-2" style="cursor: pointer;" data-toggle="modal"
                    data-target="#datamasteradminx" id="datagroupworklistmasteradmin"
                    data-url="{{ url('masteradmin/datagroupworklist', []) }}">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <h5 class="mb-0 text-white">{{$data_group_worklist}}</h5>
                                <p class="mb-0 text-white">Group Worklist</p>
                            </div>
                            <div class="w-icon">
                                <i class="fa fa-briefcase text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3">
                <div class="card gradient-linga rounded-2" style="cursor: pointer;" data-toggle="modal"
                    data-target="#datamasteradminx" id="datapersonworklistmasteradmin"
                    data-url="{{ url('masteradmin/datapersonworklist', []) }}">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <h5 class="mb-0 text-white">{{$data_worklist_person}}</h5>
                                <p class="mb-0 text-white">Personal Worklist </p>
                            </div>
                            <div class="w-icon">
                                <i class="fa fa-briefcase text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3">
                <div class="card gradient-dunada rounded-2" style="cursor: pointer;" data-toggle="modal"
                    data-target="#datamasteradmin" id="datatypeworklistmasteradmin"
                    data-url="{{ url('masteradmin/datatypeworklist', []) }}">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <h5 class="mb-0 text-white">{{$data_type_worklist}}</h5>
                                <p class="mb-0 text-white">Type Worklist</p>
                            </div>
                            <div class="w-icon">
                                <i class="fa fa-briefcase text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3">
                <div class="card gradient-dunada rounded-2" style="cursor: pointer;" data-toggle="modal"
                    data-target="#datamasteradminx" id="datatiketgroupworklist" data-url="{{ url('masteradmin/datatiketgroupworklist', []) }}">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <h5 class="mb-0 text-white">{{$data_tiket_group_worklist}}</h5>
                                <p class="mb-0 text-white">Tiket Group Worklist</p>
                            </div>
                            <div class="w-icon">
                                <i class="fa fa-ticket text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3">
                <div class="card gradient-linga rounded-2" style="cursor: pointer;" data-toggle="modal"
                    data-target="#datamasteradminx" id="datatiketpersonalworklist" data-url="{{ url('masteradmin/datatiketpersonalworklist', []) }}">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <h5 class="mb-0 text-white">{{$data_tiket_person_worklist}}</h5>
                                <p class="mb-0 text-white">Tiket Worklist Personal</p>
                            </div>
                            <div class="w-icon">
                                <i class="fa fa-ticket text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3">
                <div class="card gradient-dunada rounded-2" style="cursor: pointer;" data-toggle="modal"
                    data-target="#datamasteradminx" id="datatiketlaporan" data-url="{{ url('masteradmin/datatiketlaporan', []) }}">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <h5 class="mb-0 text-white">0</h5>
                                <p class="mb-0 text-white">Tiket Laporan</p>
                            </div>
                            <div class="w-icon">
                                <i class="fa fa-ticket text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3">
                <div class="card gradient-esinto rounded-2" style="cursor: pointer;" data-toggle="modal"
                    data-target="#datamasteradminxx">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <h5 class="mb-0 text-white">0</h5>
                                <p class="mb-0 text-white">G Maps</p>
                            </div>
                            <div class="w-icon">
                                <i class="fa fa-map text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3">
                <div class="card gradient-esinto rounded-2" style="cursor: pointer;" data-toggle="modal"
                    data-target="#datamasteradmin">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <h5 class="mb-0 text-white">0</h5>
                                <p class="mb-0 text-white">Data Komplain</p>
                            </div>
                            <div class="w-icon">
                                <i class="fa fa-exclamation-circle text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="masteradmintiket">
    <div class="modal-dialog modal-dialog-centered modal-ml">
        <div class="modal-content border-danger" id="bodyformdatamasteradmintiket">



        </div>
    </div>
</div>
<div class="modal fade" id="datamasteradmin">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-danger" id="bodyformdatamasteradmin">



        </div>
    </div>
</div>
<div class="modal fade" id="datamasteradminx">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content border-danger" id="bodyformdatamasteradminx">



        </div>
    </div>
</div>
<div class="modal fade" id="datamasteradminxx">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content border-danger">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white">Data Titik Maps Indonesia</h5>
                <span>
                    <button type="button" class="btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </span>
            </div>
            <div class="modal-body" id="divtableuser">

                <div id="googleMap" style="width:100%;height:380px;"></div>
                <hr>
                <form action="" method="post">
                    <input type="text" id="lat" name="lat" value="">
                    <input type="text" id="lng" name="lng" value="">
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn-dark" data-dismiss="modal"><i class="fa fa-close"></i>
                    Tutup</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ url('js/masteradmin.js', []) }}"></script>
<script>
    $(document).ready(function() {
        if (Notification.permission !== "granted")
            Notification.requestPermission();
    });

    function notifikasi() {
        if (!Notification) {
            alert('Browser kamu belum mendukung web notifikasi.');
            return;
        }
        if (Notification.permission !== "granted")
            Notification.requestPermission();
        else {
            var notifikasi = new Notification('asd', {
                icon: '',
                body: "Belajar Javascipt itu menyenangkan",
            });
            notifikasi.onclick = function() {
                window.open("asd");
            };
            setTimeout(function() {
                notifikasi.close();
            }, 4000);
        }
    };
</script>
