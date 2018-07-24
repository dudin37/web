<?php
session_start();
if(empty($_SESSION)){
  header("Location: utama.php");
}
if ($_SESSION['hak_akses']=='Direktur') {
  header("Location: direktur.php");
} else if ($_SESSION['hak_akses']=='kios') {
  header("Location: kios.php");
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
     <script src="pengolahan_kios/js/jquery.min.js"></script>

     <!-- <link rel="stylesheet" href="pengolahan_kios/css/peta.css"/> -->
     <script src="pengolahan_kios/js/leaflet.js"></script>
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
                  <li><a href="marketing.php"><i class="fa fa-home"></i> BERANDA </a></li>
                  <li><a href="marketing.php?page=list_kios"><i class=" 	fa fa-cube"></i> KIOS </a></li>
                  <li><a><i class="fa fa-table"></i> PERAMALAN <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="marketing.php?page=list_periode"><i class="fa fa-building"></i> PERIODE </a></li>
                      <li><a href="marketing.php?page=list_peramalan"><i class="fa fa-institution"></i> PERAMALAN </a></li>
                    </ul>
                  </li>
                  <li><a href="marketing.php?page=list_permintaan"><i class="fa fa-file-text"></i> PERMINTAAN </a></li>
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
            case 'list_kios': include "pengolahan_kios/list_kios.php"; break;
            case 'hapus_kios': include "pengolahan_kios/hapus_kios.php"; break;
            case 'edit_kios': include "pengolahan_kios/edit_kios.php"; break;
            case 'tambah_kios': include "pengolahan_kios/tambah_kios.php"; break;

          // PERIODE
            case 'list_periode': include "pengolahan_periode/list_periode.php"; break;
            case 'hapus_periode': include "pengolahan_periode/hapus_periode.php"; break;
            case 'edit_periode': include "pengolahan_periode/edit_periode.php"; break;

          // Permintaan
            case 'list_permintaan': include "pengolahan_permintaan/list_permintaan.php"; break;
            case 'hapus_permintaan': include "pengolahan_permintaan/hapus_permintaan.php"; break;
            case 'edit_permintaan': include "pengolahan_permintaan/edit_permintaan.php"; break;

          // Peramalan
            case 'list_peramalan': include "pengolahan_peramalan/list_peramalan.php"; break;
            case 'hapus_peramalan': include "pengolahan_peramalan/hapus_peramalan.php"; break;
            case 'edit_peramalan': include "pengolahan_peramalan/edit_peramalan.php"; break;

            case 'main':

            default: include 'peta/petaadmin.php';
        }
     ?>
        </div>
        <!-- /footer content -->
      </div>
    </div>

<script>
var map = L.map('map').setView([-6.820762, 107.142960], 10);
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


var theMarker = {};
  map.on('click',function(e){
    lat = e.latlng.lat;
    lon = e.latlng.lng;
    document.getElementById('lat').value = lat;
    document.getElementById('lon').value = lon;
    console.log("You clicked the map at LAT: "+ lat+" and LONG: "+lon );
        //Clear existing marker,

        if (theMarker != undefined) {
              map.removeLayer(theMarker);
        };

    //Add a marker to show where you clicked.
     theMarker = L.marker([lat,lon]).addTo(map);
});

</script>

<script type="text/javascript">
            $(document).ready(function () {
                $('.tahun').datepicker({
                    format: "yyyy",
                    autoclose:true
                });
            });
        </script>

        <script src="datepicker/bootstrap-datepicker.js"></script>
                <script type="text/javascript">
                    $(document).ready(function () {
                        $('.tanggal').datepicker({
                            format: "yyyy-mm-dd",
                            autoclose:true
                        });
                    });
                </script>

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
