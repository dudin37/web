<?php
session_start();
if(empty($_SESSION)){
  header("Location: utama.php");
}
if ($_SESSION['hak_akses']=='Direktur') {
  header("Location: direktur.php");
} else if ($_SESSION['hak_akses']=='Marketing') {
  header("Location: marketing.php");
} else if ($_SESSION['hak_akses']=='Admin/CS') {
  header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SIG DISTRIBUSI DAN PENYEBARAN PUPUK</title>
        <!-- Favicon-->
    <link rel="icon" href="icon.ico" type="image/x-icon">
    <!-- Bootstrap -->
    <link href="lib/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="lib/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- Datatables -->
    <link href="lib/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="lib/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="lib/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">

    <!-- date picker -->
    <link href="lib/vendors/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet">

    <link href="lib/leaflet/leaflet.css" rel="stylesheet"  />
    <!-- leaflet -->
    <!-- // <script src="lib/leaflet/leaflet.js"></script> -->
    <link href="geocoder/Control.OSMGeocoder.css" rel="stylesheet"  />
    <!-- Custom Theme Style -->
    <link href="lib/build/css/custom.min.css" rel="stylesheet">

    <!-- peta -->
     <script src="pengolahan_desa/js/jquery.min.js"></script>
     <!-- <link rel="stylesheet" href="pengolahan_desa/css/leaflet.css" /> -->
     <script src="pengolahan_desa/js/leaflet.js"></script>
    <!-- endpeta -->

  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" align="center" style="border: 0;">
            </div>
            <div class="clearfix"></div>
            <br />
            <?php
            $a = "";
            $b = "";
            $c = "";
            $d = "";
            $e = "";
            $f = "";
            $page = isset($_GET['page']) ? $_GET['page']:"";
            switch (substr($page,-4)) {
            case 'atan': $b = "active";break;
            case 'desa': $c = "active";break;
            case 'cana': $d = "active";break;
            case 'stik': $e = "active";break;
            case 'dian': $f = "active";break;
            default: $b = "active";break;
              break;
            }
            ?>
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>MENU</h3>
                <ul class="nav side-menu">
                  <li><a href="kios.php"><i class="fa fa-home"></i> BERANDA </a></li>
                  <li><a href="kios.php?page=list_poktan"><i class=" 	fa fa-cube"></i> KELOMPOK TANI </a></li>
                  <li><a href="kios.php?page=list_sebaran_pupuk"><i class="fa fa-file-text"></i> SEBARAN PUPUK </a></li>
                  <li><a href="kios.php?page=list_detail_kios"><i class="fa fa-bank"></i> DETAIL KIOS </a></li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->
            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>
        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>

              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars">&nbsp;CV&nbsp;PRIMA&nbsp;SEJAHTERA&nbsp;ABADI</i></a>
              </div>
              <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
        <!-- page content -->
        <div class="right_col" role="main">
          <?php
        $page = (isset($_GET['page']))? $_GET['page'] : "main";
        switch ($page) {
          // KELOMPOK TANI;
            // case 'edit_profil': include "edit_profil.php"; break;
            case 'list_poktan': include "pengolahan_poktan/list_poktan.php"; break;
            case 'hapus_poktan': include "pengolahan_poktan/hapus_poktan.php"; break;
            case 'edit_poktan': include "pengolahan_poktan/edit_poktan.php"; break;
          // SEBARAN
            case 'list_sebaran_pupuk': include "pengolahan_sebaran_pupuk/list_sebaran_pupuk.php"; break;
            case 'hapus_sebaran_pupuk': include "pengolahan_sebaran_pupuk/hapus_sebaran_pupuk.php"; break;
            case 'edit_sebaran_pupuk': include "pengolahan_sebaran_pupuk/edit_sebaran_pupuk.php"; break;
            case 'tambah_sebaran_pupuk': include "pengolahan_sebaran_pupuk/tambah_sebaran_pupuk.php"; break;
          // Detail kios
            case 'list_detail_kios': include "pengolahan_detail_kios/list_detail_kios.php"; break;
            case 'hapus_detail_kios': include "pengolahan_detail_kios/hapus_detail_kios.php"; break;
            case 'edit_detail_kios': include "pengolahan_detail_kios/edit_detail_kios.php"; break;
            case 'main':
            // default: include 'peta/petaluas.php';
            echo "Ini adalah halaman web anda<br>";
            echo "Selamat Datang Kios : ".$_SESSION['username']." ".$_SESSION['nama']. "<br><br>";
            //default: include 'peta/petaadmin.php';
        }
     ?>
        </div>
        <!-- /footer content -->
      </div>
    </div>

    <!-- peta -->
<script>
  var map = L.map('map').setView([-6.820762, 107.142960], 10);
  var polygon;
  var draggableAreaMarkers = new Array();
  var hikeLink = '<a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>';
  var hikeUrl = 'http://{s}.tiles.wmflabs.org/hikebike/{z}/{x}/{y}.png',
            hikeAttrib = '&copy; ' + hikeLink + ' Contributors';

  L.tileLayer( 'http://{s}.tiles.wmflabs.org/hikebike/{z}/{x}/{y}.png', {
   maxZoom: 18,
   attribution: 'Map data &copy; <a href="http://openstreetmap.org/"> OpenStreetMap </a> contributors, ' +
    '<a href="http://www.openstreetmap.org/"> CC-BY-SA </a>, ' +
    'Imagery © <a href="http://www.openstreetmap.org"> OpenStreetMap </a>',
   id: 'examples.map-i875mjb7'
  }).addTo(map);

  function resetArea() {
   if(polygon != null) {
    map.removeLayer( polygon );
   }
   for(i=0; i < draggableAreaMarkers.length; i++) {
    map.removeLayer( draggableAreaMarkers[i] );
   }
   draggableAreaMarkers = new Array();
  }

  function addMarkerAreaPoint(latLng) {
   var areaMarker = L.marker( [latLng.lat, latLng.lng], { draggable: true, zIndexOffset: 900 }).addTo(map);

   areaMarker.arrayId = draggableAreaMarkers.length;

   areaMarker.on('click', function() {
    map.removeLayer( draggableAreaMarkers[ this.arrayId ]);
    draggableAreaMarkers[ this.arrayId ] = "";
   });

   draggableAreaMarkers.push( areaMarker );
  }

  function drawArea() {
   if(polygon != null) {
    map.removeLayer( polygon );
   }

   var latLngAreas = new Array();

   for(i=0; i < draggableAreaMarkers.length; i++) {
    if(draggableAreaMarkers[ i ]!="") {
     latLngAreas.push( L.latLng( draggableAreaMarkers[ i ].getLatLng().lat, draggableAreaMarkers[ i ].getLatLng().lng));
    }
   }

   if(latLngAreas.length > 1) {
    // create a blue polygon from an array of LatLng points
    polygon = L.polygon( latLngAreas, {color: 'blue'}).addTo(map);
   }

   if(polygon != null) {
    // zoom the map to the polygon
    map.fitBounds( polygon.getBounds() );
   }
  }

  function getGeoPoints() {
   var points = new Array();
   for(var i=0; i < draggableAreaMarkers.length; i++) {
    if(draggableAreaMarkers[i] != "") {
     points[i] =  "[ "+draggableAreaMarkers[ i ].getLatLng().lng + ", " + draggableAreaMarkers[ i ].getLatLng().lat+", 0.0 ]";
    }
   }
   $('#polygon').val("[ [ "+points.join(',')+" ] ]");
  }

  $( document ).ready(function() {
   map.on('click', function(e) {
    addMarkerAreaPoint( e.latlng);
   });
  });
 </script>
    <!-- endpeta -->


    <!-- jQuery -->
    <script src="lib/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="lib/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="lib/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="lib/vendors/nprogress/nprogress.js"></script>
    <!-- gauge.js -->
    <script src="lib/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="lib/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="lib/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="lib/vendors/skycons/skycons.js"></script>
        <!-- validator -->
    <!-- Flot plugins -->
    <script src="lib/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="lib/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="lib/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="lib/vendors/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="lib/vendors/moment/min/moment.min.js"></script>
    <script src="lib/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
        <!-- Datatables -->
    <script src="lib/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="lib/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="lib/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="lib/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="lib/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="lib/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="lib/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="lib/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="lib/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="lib/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="lib/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="lib/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="lib/build/js/custom.min.js"></script>

  </body>
</html>
