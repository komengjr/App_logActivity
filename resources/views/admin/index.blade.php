<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <h4 class="page-title">Data Admin</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javaScript:void();">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javaScript:void();">Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Home</li>
                </ol>
            </div>
            <div class="col-sm-3">
                <div class="btn-group float-sm-right">
                    <button type="button" class="btn btn-light waves-effect waves-light"><i class="fa fa-cog mr-1"></i>
                        Option </button>
                    <button type="button"
                        class="btn btn-light dropdown-toggle dropdown-toggle-split waves-effect waves-light"
                        data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>
                    <div class="dropdown-menu">
                        <div class="dropdown-divider"></div>
                        <a href="javaScript:void();" class="dropdown-item" data-toggle="modal" data-target="#inputtiketbaruadmin" id="buttonadminbuattiket"><i class="fa fa-tasks"></i> Buat Tiket</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 col-lg-6 col-xl-4">
              <div class="card">
                <div class="card-body">
                  <p class="mb-0">
                    Tugas Bulan
                    <span class="float-right badge badge-primary">Monthly</span>
                  </p>
                  <div class="">
                    <h4 class="mb-0 py-3 text-primary">
                      92,403
                      <span class="float-right" ><i class="fa fa-search" style="cursor: pointer;" data-toggle="modal" data-target="#showdatamaps" id="tugasuserbulanan"></i ></span>
                    </h4>
                  </div>
                  <div class="progress-wrapper">
                    <div class="progress" style="height: 5px">
                      <div
                        class="progress-bar bg-primary"
                        style="width: 60%"></div>
                    </div>
                  </div>
                  <p class="mb-0 mt-2 small-font">
                    Compare to last month
                    <span class="float-right" >+15% <i class="fa fa-long-arrow-up"></i></span>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-12 col-lg-6 col-xl-4">
              <div class="card">
                <div class="card-body">
                  <p class="text-success mb-0">
                    Tugas Harian
                    <span class="float-right badge badge-success">Today</span>
                  </p>
                  <div class="">
                    <h4 class="mb-0 py-3 text-success">
                      5,70,803
                      <span class="float-right"><i class="fa fa-search" style="cursor: pointer;" data-toggle="modal" data-target="#showdatamaps" id="tugasuserharian"></i></span>
                    </h4>
                  </div>
                  <div class="progress-wrapper">
                    <div class="progress" style="height: 5px">
                      <div class="progress-bar bg-success" style="width: 80%" ></div>
                    </div>
                  </div>
                  <p class="mb-0 mt-2 small-font">
                    Compare to yesterday
                    <span class="float-right"  >+43% <i class="fa fa-long-arrow-up"></i ></span>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-12 col-lg-6 col-xl-4">
              <div class="card">
                <div class="card-body">
                  <p class="text-danger mb-0">
                    Tugas Belum dikerjakan
                    <span class="float-right badge badge-danger">Weekly</span>
                  </p>
                  <div class="">
                    <h4 class="mb-0 py-3 text-danger">
                      8,456
                      <span class="float-right"><i class="fa fa-search" style="cursor: pointer;" data-toggle="modal" data-target="#showdatamaps" id="tugasuserbelum"></i></span>
                    </h4>
                  </div>
                  <div class="progress-wrapper">
                    <div class="progress" style="height: 5px">
                      <div
                        class="progress-bar bg-danger"
                        style="width: 45%"
                      ></div>
                    </div>
                  </div>
                  <p class="mb-0 mt-2 small-font">
                    Compare to last week
                    <span class="float-right"
                      >+32% <i class="fa fa-long-arrow-up"></i
                    ></span>
                  </p>
                </div>
              </div>
            </div>
        </div>
          <!--End Row-->

          <div class="card">
            <div class="card-header">
              Grafik Pengerjaan Tugas
              <div class="btn-group group-round btn-group-sm float-right">
                <button type="button" class="btn btn-info waves-effect waves-light" >
                  Monthly
                </button>
                <button type="button" class="btn btn-info waves-effect waves-light" >
                  Weekly
                </button>
                <button type="button" class="btn btn-info waves-effect waves-light" >
                  Daily
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-12 col-lg-3 text-center">
                  <p class="mt-4">Total Tugas</p>
                  <h4 class="mb-0">4,350</h4>
                  <hr />
                  <p>Total Penyelesaian</p>
                  <h4 class="mb-0 text-info">80,520</h4>
                </div>
                <div class="col-12 col-lg-9">
                  <div class="chart-container-11">
                    <canvas id="dash2-chart1"></canvas>
                  </div>
                </div>
              </div>
              <!--End Row-->
            </div>
          </div>
          <!--End Card-->

          <div class="row">
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header">
                  Tugas Baru
                  <div class="card-action">
                    <div class="dropdown">
                      <a href="javascript:void();"
                        class="dropdown-toggle dropdown-toggle-nocaret"
                        data-toggle="dropdown">
                        <i class="icon-options"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="javascript:void();" data-toggle="modal" data-target="#inputtiketbaruadmin" id="buttonadminbuattiket"><i class="fa fa-ticket"></i>  Buat Tugas Baru</a>
                       
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:void();"><i class="fa fa-search"></i> Cari Tugas</a>
                      </div>
                    </div>
                  </div>
                </div>

                <ul class="list-group list-group-flush shadow-none pt-3">
                    <table id="default-datatable1" class="styled-table">
                        <thead>
                            <tr>
                                <th>No Tiket</th>
                                <th>Worklist</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tiket as $tiket)
                                <tr>
                                    <td data-label="No tiket">{{$tiket->no_tiket}}</td>
                                    <td data-label="Worklist">{{$tiket->nama_worklist}}</td>
                                    <td>{{$tiket->status_tiket}}</td>
                                    <td>
                                        {{-- <button class="btn-warning">Option</button> --}}
                                        <div class="dropdown">
                                          <button
                                            class="dropdown-toggle dropdown-toggle-nocaret btn-warning"
                                            data-toggle="dropdown">Option
                                            
                                        </button>
                                          <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="javascript:void();"
                                              >Action</a>
                                            <a class="dropdown-item" href="javascript:void();"
                                              >Another action</a>
                                            <a class="dropdown-item" href="javascript:void();"
                                              >Something else here</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="javascript:void();"
                                              >Separated link</a>
                                          </div>
                                        </div>
                                    </td>
                                </tr>
                            
                            @endforeach
                        </tbody>
                    </table>
                </ul>
                <div class="card-footer text-center bg-transparent border-0">
                  {{-- <a href="javascript:void();">View all listings</a> --}}
                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="card">
                <div class="card-header">
                  User
                  <div class="card-action">
                    <div class="dropdown">
                      <a href="javascript:void();"
                        class="dropdown-toggle dropdown-toggle-nocaret"
                        data-toggle="dropdown" >
                        <i class="icon-options"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="javascript:void();"
                          >Action</a>
                        <a class="dropdown-item" href="javascript:void();"
                          >Another action</a
                        >
                        <a class="dropdown-item" href="javascript:void();"
                          >Something else here</a
                        >
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:void();"
                          >Separated link</a
                        >
                      </div>
                    </div>
                  </div>
                </div>

                <ul class="list-group list-group-flush shadow-none pt-3">
                    <table id="default-datatable" class="styled-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Worklist</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $user)
                                <tr>
                                    <td>
                                            <i class="fa fa-user-circle-o"> </i>  - {{$user->name}}
                                        {{-- <span class="list-group-item" >
                                            <div class="media align-items-center" style="text-decoration:none;">
                                            <div class="icon-box border ">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0">{{$user->name}}</h6>
                                            </div>
                                            <div class="date">Wrok List: 250</div>
                                            </div>
                                        </span> --}}
                                    </td>
                                    <td>total : 200 <br> Selesai : 170 <br> tidak selesai : 30</td>
                                    <td>
                                        <button class="btn-warning">Option</button>
                                    </td>
                                </tr>
                            
                            @endforeach
                        </tbody>
                    </table>
                </ul>

                <div class="card-footer text-center border-0">
                  {{-- <a href="javascript:void();">View all Categories</a> --}}
                </div>
              </div>
            </div>
          </div>
          <!--End Row-->
          <!--start overlay-->
          <div class="overlay toggle-menu"></div>
        <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <h4 class="page-title">Data Maps</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javaScript:void();">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javaScript:void();">Maps</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pramita</li>
                </ol>
            </div>
            
        </div>
        <!-- End Breadcrumb-->
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
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header text-uppercase">Lokasi Pramita</div>
                    <div class="card-body">
                        <div id="map" class="gmaps"></div>
                    </div>
                </div>

            </div>
        </div>
        <!--End Row-->
        <!--start overlay-->
        <div class="overlay toggle-menu"></div>
        <!--end overlay-->
    </div>
    <!-- End container-fluid-->
    
</div>
<div class="modal fade" id="showdatamaps">
    <div class="modal-dialog modal-dialog-centered modal-xl"  id="bodyformdatamapscabang">
      <div class="modal-content border-danger" style="background: transparent;">
        <div class="text-center" >
          <img src="{{ url('loading1.gif', []) }}" alt="" srcset="" width="250" style="height: auto;">
        </div>
      </div>
    </div>
</div>
<div class="modal fade" id="inputtiketbaruadmin">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content border-danger" id="bodyformdatatiket">
        
        loading ..
  
      </div>
    </div>
</div>
<script src="{{ url('js/admin-app.js', []) }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKXKdHQdtqgPVl2HI2RnUa_1bjCxRCQo4&callback=initialize" async defer></script>
{{-- <script src="http://maps.googleapis.com/maps/api/js"></script> --}}
<script>
    $(document).ready(function () {
      //Default data table
      $("#default-datatable").DataTable();
      $("#default-datatable1").DataTable();

      var table = $("#example").DataTable({
        lengthChange: false,
        buttons: ["copy", "excel", "pdf", "print", "colvis"],
      });

      table
        .buttons()
        .container()
        .appendTo("#example_wrapper .col-md-6:eq(0)");
    });
  </script>
<script>
    let map;
    let infoWindow;
    let mapOptions;
    let bounds;

    function initialize() {
        // Data yang disimpan dalam variabel array locations
        var locations = [
            @foreach($cabang as $item )
                ["<h6><?php echo $item->nama_cabang ?></h6><p>{{  $item->alamat }}</p><button data-toggle='modal' data-target='#showdatamaps' class='btn-info' id='buttontampilmapscabang' data-id='<?php echo $item->kd_cabang ?>'><i class='fa fa-eye'> </i> Show Data</button>",+
                "<?php echo $item->latitude ?>", "<?php echo $item->longtitude ?>"],
            @endforeach
           
        ];

        // Lokasi folder dari icon
        var iconMarker = 'icon/';

        // variabel uniqueIcons untuk menyimpan icon yang berbeda-bedan
        var uniqueIcons = [
            // @foreach($cabang as $item )
                iconMarker + '1.png',
                iconMarker + '1.gif',
                // iconMarker + '3.png',
              
            // @endforeach  
        ]
        var iconsLength = uniqueIcons.length;

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: new google.maps.LatLng(4.845582, 96.271539),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            mapTypeControl: true,
            streetViewControl: true,
            panControl: true,
            zoomControlOptions: {
                position: google.maps.ControlPosition.LEFT_BOTTOM
            }
        });

        var infowindow = new google.maps.InfoWindow();

        var markers = new Array();

        var iconCounter = 0;

        // Membuat marker dengan icon yang berbeda-beda
        for (var i = 0; i < locations.length; i++) {
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map,
                
                mapTypeId: 'satellite',
                icon: uniqueIcons[iconCounter]
            });

            markers.push(marker);

            // Membuah event click dan menambah infowindows
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));

            iconCounter++;

            if (iconCounter >= iconsLength) {
                iconCounter = 0;
            }
        }

        function autoCenter() {

            var bounds = new google.maps.LatLngBounds();

            for (var i = 0; i < markers.length; i++) {
                bounds.extend(markers[i].position);
            }

            map.fitBounds(bounds);
        }
        autoCenter();
    };
</script>
<script src="{{ url('assets/plugins/Chart.js/Chart.min.js', []) }}"></script>
<script src="{{ url('assets/js/dashboard-property-listing.js', []) }}"></script>