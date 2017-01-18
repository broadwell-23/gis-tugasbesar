<!DOCTYPE html>
<html>
  <head>

    <!-- Basic -->
    <meta charset="utf-8">
    <title>WoFi - Wifi Finder</title>    
    <!-- Site Meta Info -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="WoFi is apps that could find place which has wifi.">
    <meta name="keywords" content="wofi, web, gis, sig, information, wifi, location, @wifi.id">
    <meta name="author" content="farizky.xyz">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Web Fonts  -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="/vendor/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="/vendor/fontawesome/css/font-awesome.css">
    <link rel="stylesheet" href="/vendor/owlcarousel/owl.carousel.min.css" media="screen">
    <link rel="stylesheet" href="/vendor/owlcarousel/owl.theme.default.min.css" media="screen">
    <link rel="stylesheet" href="/vendor/magnific-popup/magnific-popup.css" media="screen">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="/css/theme.css">
    <link rel="stylesheet" href="/css/theme-elements.css">
    <link rel="stylesheet" href="/css/theme-blog.css">
    <link rel="stylesheet" href="/css/theme-shop.css">
    <link rel="stylesheet" href="/css/theme-animate.css">

    <!-- Current Page CSS -->
    <link rel="stylesheet" href="/vendor/rs-plugin/css/settings.css" media="screen">
    <link rel="stylesheet" href="/vendor/circle-flip-slideshow/css/component.css" media="screen">

    <!-- Skin CSS -->
    <link rel="stylesheet" href="/css/skins/default.css">

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="/css/custom.css">

    <!-- Head Libs -->
    <script src="/vendor/modernizr/modernizr.js"></script>

    <!-- Bootstrap-switch -->
    <link href="/switch/docs/css/bootstrap.min.css" rel="stylesheet">
    <link href="/switch/dist/css/bootstrap3/bootstrap-switch.css" rel="stylesheet">
    <script src="/switch/docs/js/jquery.min.js"></script>
    <script src="/switch/dist/js/bootstrap-switch.js"></script>

    <!-- GEOXML3 -->
<!--     <script src="/geoxml3/polys/geoxml3.js"></script>
    <script src="/geoxml3/kmz/geoxml3.js"></script>
    <script src="/geoxml3/kmz/geoxml3_gxParse_kmz.js"></script>
    <script src="/geoxml3/kmz/ZipFile.complete.js"></script> -->

    <!-- FROM ADMIN TEMPLATE -->
    <!-- Custom styles for this template -->
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/style-responsive.css" rel="stylesheet" />

    <link href="/bootstrap/css/bootstrap.css" rel="stylesheet" />

    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      .settings {
        position: fixed; 
        z-index: 5; 
        margin-top: 10px; 
        margin-left: 10px;
      }
      .logo{
        margin-left: 1120px;
        margin-top: -32px; 
        position: fixed; 
        z-index: 5;
      }
      .dropdown-settings{

      }
      .selected { 
        font-weight: bold; 
      }

      /*STYLE FOR ACCORDION*/
      button.accordion {
          background-color: #eee;
          color: #444;
          cursor: pointer;
          padding: 18px;
          width: 100%;
          border: none;
          text-align: left;
          outline: none;
          font-size: 15px;
          transition: 0.4s;
      }

      button.accordion.active, button.accordion:hover {
          background-color: #ddd;
      }

      button.accordion:after {
          content: '\02795';
          font-size: 13px;
          color: #777;
          float: right;
          margin-left: 5px;
      }

      button.accordion.active:after {
          content: "\2796";
      }

      div.panel {
          padding: 0 18px;
          margin-bottom: 0;
          background-color: white;
          max-height: 0;
          overflow: hidden;
          transition: 0.6s ease-in-out;
          opacity: 0;
      }

      div.panel.show {
          opacity: 1;
          max-height: 500px;  
      }

      /*GEOCODING-REVERSE*/
      #latlng {
        width: 225px;
      }
      .pencarian{
        margin:10px;
      }
    </style>

    <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyDNtJCpjYcRxn16lx1C2NJOKYMww5RdDVM&callback=initialize"></script>

    <script type="text/javascript">
    function map() { // fungsi untuk dijalankan ketika halaman web dibuka  
      var infowindow = null;  
      initialize(); // mengeksekusi fungsi initialize()  
    };

    var layers=[];

    layers[0] = new google.maps.KmlLayer('http://theproject.id/kml/pontianak/layer_kecamatan.kml',
    {preserveViewport: true});

    layers[1] = new google.maps.KmlLayer('http://theproject.id/kml/pontianak/layer_jalan.kml',
    {preserveViewport: true});
    
    layers[2] = new google.maps.KmlLayer('http://theproject.id/kml/pontianak/layer_sungai.kml',
    {preserveViewport: true});

    var map;  

    function initialize() {
      // Baris berikut digunakan untuk mengisi marker atau tanda titik di peta  
      var sites = [  
      
      @foreach($spots as $no => $spot)
      ['{{ $spot->nama_cafe }}', {{ $spot->titik }} , {{ $no+1 }}, '<h4>{{ $spot->nama_cafe }}</h4><p>{{ $spot->alamat }}</p><p>{{ $spot->no_hp }}</p><p>Virtual Tour : <a target="_blank" href="{{ $spot->virtual_tour }}">{{ $spot->virtual_tour }}</a></p>'], 
      @endforeach
      ];
    
      //KETERANGAN ISI sites
      //pertama merupakan judul marker, 
      //kedua adalah titik koordinat latitude,
      //ketiga longitude, dan 
      //keempat merupakan z index (titik mana yang ditampilkan lebih dulu) untuk menentukan titik mana diatas titik mana, 
      //kelima merupakan isi keterangan marker nya.       

      var latlng = new google.maps.LatLng(-0.0294977, 109.3282975);
      var myOptions = {
              zoom: 12,
              center: latlng,
              mapTypeId: 'satellite'
      }
      map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

      setMarkers(map, sites); // memanggil fungsi setMarker untuk menandai titik di peta.  
      infowindow = new google.maps.InfoWindow({  
        content: "loading..."  
        });  

      var bikeLayer = new google.maps.BicyclingLayer();  
          bikeLayer.setMap(map); //memnunculkan peta  

      var geocoder = new google.maps.Geocoder;
      var infowindow1 = new google.maps.InfoWindow;

      document.getElementById('submit').addEventListener('click', function() {
        geocodeLatLng(geocoder, map, infowindow1);
      });
    }

    function setMarkers(map, markers) {  
    //berikut merupakan perulangan untuk membaca masing masing titik yang telah kita definisikan di sites[];  
      for (var i = 0; i < markers.length; i++) {  
      var iconBase = 'img/';
      var sites = markers[i];  
      var siteLatLng = new google.maps.LatLng(sites[1], sites[2]);  
      var marker = new google.maps.Marker({ 
        icon: iconBase + 'spot.png', 
        position: siteLatLng,  
        map: map,  
        title: sites[0],  
        zIndex: sites[3],  
        html: sites[4]  
          });  
      
      var contentString = "Some content";  
      // berikut merupakan fungsi untuk mengatur agar keterangan marker muncul ketika marker di-click 
      google.maps.event.addListener(marker, "click", function map() {  
      infowindow.setContent(this.html);  
      infowindow.open(map, this);  
          });  
      }  
    } 

    function toggleLayers(i)
    {

      if(layers[i].getMap()==null) {
         layers[i].setMap(map);
      }
      else {
         layers[i].setMap(null);
      }
    }

    // GEOCODING-REVERSE (buat serach by latlng)
    function geocodeLatLng(geocoder, map, infowindow) {
      var input = document.getElementById('latlng').value;
      var latlngStr = input.split(',', 2);
      var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};
      geocoder.geocode({'location': latlng}, function(results, status) {
        if (status === 'OK') {
          if (results[1]) {
            map.setZoom(11);
            var marker = new google.maps.Marker({
              position: latlng,
              map: map
            });
            infowindow.setContent(results[1].formatted_address);
            infowindow.open(map, marker);
          } else {
            window.alert('No results found');
          }
        } else {
          window.alert('Geocoder failed due to: ' + status);
        }
      });
    }

    </script>
    
  </head>
  <body onload="map()">

    <div class="settings">
      <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#menucollapse" aria-expanded="false"  hiddenaria-controls="menucollapse">
         Tampilan <i class="fa fa-chevron-up"></i>
      </button>
      <!-- <button class="btn btn-primary" onclick="initMap()"><i class="fa fa-refresh"></i></button> -->
      <br>
      <div class="collapse dropdown-settings in" id="menucollapse">
        <div class="well" style="max-height: 523px; overflow: auto;">

          <button class="accordion"><i class="fa fa-map-marker"></i> &nbsp;Peta Dasar</button>
            <div class="panel" style="overflow: auto;">
              <div class="checkbox">
                <label><input id="layer_01" onclick="toggleLayers(0)" type="checkbox"/>Batas Administrasi Kecamatan</label>
              </div>
              <div class="checkbox">
                <label><input id="layer_02" onclick="toggleLayers(1)" type="checkbox"/>Jaringan Jalan</label>
              </div>
              <div class="checkbox">
                <label><input id="layer_03" onclick="toggleLayers(2)" type="checkbox"/>Jaringan Sungai</label>
              </div>
              <div class="checkbox">
                <label><input id="layer_04" onclick="toggleLayers(3)" type="checkbox"/>Titik Wifi</label>
              </div>
            </div>

          <button class="accordion"><i class="fa fa-search"></i> Pencarian</button>
            <div class="panel">
              <div class="pencarian">
                <input id="latlng" type="text" placeholder="1.4697685,109.2595003">
                <button id="submit" type="button">
                  <i class="fa fa-search"></i>
                </button>
                <br>
                <small>latitude,longitude</small>
              </div>
            </div>

        </div>
      </div>
    </div>

    <div class="logo">
      <a href="../">
        <img alt="WoFi-LOGO" width="250" src="img/logoGISWofi.png">
      </a>
    </div>

    <div id="map_canvas" style="height:100%"></div>

    <!-- <div id="toggle_box" style="position: absolute; top: 100px; right: 20px; padding: 10px; background: #fff; z-index: 5; "></div> -->

    <!-- //MODAL -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
          </div>
          <div class="modal-body">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript">
        // ACCORDION
      var acc = document.getElementsByClassName("accordion");
      var i;

      for (i = 0; i < acc.length; i++) {
          acc[i].onclick = function(){
              this.classList.toggle("active");
              this.nextElementSibling.classList.toggle("show");
        }
      }
    </script>

    <!-- Vendor -->
    <script src="/vendor/jquery/jquery.js"></script>
    <script src="/vendor/jquery.appear/jquery.appear.js"></script>
    <script src="/vendor/jquery.easing/jquery.easing.js"></script>
    <script src="/vendor/jquery-cookie/jquery-cookie.js"></script>
    <script src="/vendor/bootstrap/bootstrap.js"></script>
    <script src="/vendor/common/common.js"></script>
    <script src="/vendor/jquery.validation/jquery.validation.js"></script>
    <script src="/vendor/jquery.stellar/jquery.stellar.js"></script>
    <script src="/vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.js"></script>
    <script src="/vendor/jquery.gmap/jquery.gmap.js"></script>
    <script src="/vendor/isotope/jquery.isotope.js"></script>
    <script src="/vendor/owlcarousel/owl.carousel.js"></script>
    <script src="/vendor/jflickrfeed/jflickrfeed.js"></script>
    <script src="/vendor/magnific-popup/jquery.magnific-popup.js"></script>
    <script src="/vendor/vide/vide.js"></script>
    
    <!-- Theme Base, Components and Settings -->
    <script src="/js/theme.js"></script>
    
    <!-- Specific Page Vendor and Views -->
    <script src="/vendor/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
    <script src="/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
    <script src="/vendor/circle-flip-slideshow/js/jquery.flipshow.js"></script>
    <script src="/js/views/view.home.js"></script>
    
    <!-- Theme Custom -->
    <script src="/js/custom.js"></script>
    
    <!-- Theme Initialization Files -->
    <!-- <script src="/js/theme.init.js"></script> -->

    <!--custom checkbox & radio-->
    <script type="text/javascript" src="/js/ga.js"></script>

    <!--common script for all pages-->
    <!-- <script src="/js/common-scripts.js"></script> -->

    <!--script for this page-->
    <!-- <script src="/js/form-component.js"></script> -->

  </body>
</html>