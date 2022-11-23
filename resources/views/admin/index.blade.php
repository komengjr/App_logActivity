<div class="content-wrapper">
    <div class="container-fluid">
        
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
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content border-danger" id="bodyformdatamapscabang">
        
        loading ..
  
      </div>
    </div>
</div>
<div class="modal fade" id="inputtiketbaruadmin">
    <div class="modal-dialog modal-dialog-centered modal-ml">
      <div class="modal-content border-danger" id="bodyformdatatiket">
        
        loading ..
  
      </div>
    </div>
</div>
<script src="{{ url('js/admin-app.js', []) }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKXKdHQdtqgPVl2HI2RnUa_1bjCxRCQo4&callback=initialize" async defer></script>
{{-- <script src="http://maps.googleapis.com/maps/api/js"></script> --}}
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