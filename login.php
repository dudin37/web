<?php
session_start();
/*if($_SESSION){
  // ganti
  header("Location: index.php");
  $username_ = $_SESSION['username'];
}*/
?>

<!DOCTYPE html>
<html>

<head>
    <title>
      SIG DISTRIBUSI DAN PENYEBARAN PUPUK
    </title>
    <!-- CSS -->
    <link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css" />
    <link href="stylesheets/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />
    <!-- Font Awesome -->
    <link href="lib/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="stylesheets/se7en-font.css" media="all" rel="stylesheet" type="text/css" />
    <link href="stylesheets/style.css" media="all" rel="stylesheet" type="text/css" />
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
  </head>

  <body class="login2">
    <!-- Login Screen -->
    <div class="login-wrapper">
      <a href="#"><img width="200" height="200" src="images/logo.png" /></a>
      <h3>CV.&nbsp;PRIMA&nbsp;SEJAHTERA&nbsp;ABADI&nbsp;
      <!-- Sql -->
      <?php
        $msg = '';
        if(isset($_POST['login']) && ($_POST['username'] != '') && ($_POST['password'] != ''))
            {
            include "lib/koneksi.php";
            $name = $_POST['username'];
            $pass = $_POST['password'];
              // username & password combination
              $query = mysqli_query($koneksi, "SELECT * FROM `tb_user` WHERE `username` = '$name' OR `nama` = '$name' AND `password` = '$pass'");
              $rows = mysqli_num_rows($query);
              if($rows > 0)
              {
                $row = mysqli_fetch_assoc($query);
                if($row['hak_akses'] == "Admin/CS"){
                  $_SESSION['username']=$name;
                  $_SESSION['hak_akses']='Admin/CS';
                  $_SESSION['nama']=$row['nama'];
                  header("Location: index.php");
                }else if($row['hak_akses'] == "Direktur"){
                  $_SESSION['username']=$name;
                  $_SESSION['hak_akses'] ='Direktur';
                  $_SESSION['nama']= $row['nama'];
                  header("Location: direktur.php ");
                }else if($row['hak_akses'] == "Kios"){
                  $_SESSION['username']=$name;
                  $_SESSION['hak_akses']='Kios';
                  $_SESSION['nama']= $row['nama'];
                  header("Location: kios.php");
              }else if($row['hak_akses'] == "Marketing"){
                $_SESSION['username']=$name;
                $_SESSION['hak_akses']='Marketing';
                $_SESSION['nama']= $row['nama'];
                header("Location: marketing.php");
            }else {
              echo '<div class="alert alert-danger"> Data Yang dimasukan Salah.</div>';
            }
          } else {
            echo '<div class="alert alert-danger"> Username atau Password yang anda masukan salah. Silahkan ulangi.</div>';
          }
        }
        ?>
      <form action="#" method="post">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <input class="form-control" name="username" placeholder="Username" type="text" required="true">
          </div>
        </div>
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
            <input class="form-control" placeholder="Password" name="password" type="password" required="true">
          </div>
        </div>
        <a class="pull-right" href="Login/forgotpassword.php">Lupa password?</a>
        <br>
        <input class="btn btn-lg btn-primary btn-block" type="submit" name="login" value="Log in">
      </form>

    </div>
    <!-- End Login Screen -->
  </body>
   <!-- JS -->
    <script src="http://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js" type="text/javascript"></script>
    <script src="javascripts/bootstrap.min.js" type="text/javascript"></script>
    <script src="javascripts/modernizr.custom.js" type="text/javascript"></script>
    <script src="javascripts/main.js" type="text/javascript"></script>

</html>
