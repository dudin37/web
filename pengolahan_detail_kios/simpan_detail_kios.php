<?php
session_start();
include "../lib/koneksi.php";

$kd_det_kios =  isset($_POST['kd_det_kios']) ? $_POST['kd_det_kios']:"";
$kd_kios =  isset($_POST['kd_kios']) ? $_POST['kd_kios']:"";
$kd_pupuk =  isset($_POST['kd_pupuk']) ? $_POST['kd_pupuk']:"";
$Stok =  isset($_POST['Stok']) ? $_POST['Stok']:"";


if ($kd_pupuk == "" || $Stok == "") {
	?>
 <script language="JavaScript">
 alert('Data Gagal Disimpan, Silahkan isi dengan benar.  <?php echo "Pupuk : ".$kd_pupuk."Stok :".$Stok ?>');
 document.location='../kios.php?page=list_detail_kios';
 </script>

 <?php
 } else {
   $query = mysqli_query($koneksi,"INSERT INTO tb_detail_kios(kd_det_kios,kd_kios,kd_pupuk,Stok)
    VALUES ( '$kd_det_kios',
    				 '$kd_kios',
             '$kd_pupuk',
             '$Stok');") or die (mysqli_error($koneksi));

  ?>
 <script language="JavaScript">
 alert('Data Berhasil Disimpan');
 document.location='../kios.php?page=list_detail_kios';
 </script>

 <?php
 }
 ?>
