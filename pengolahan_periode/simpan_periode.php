<?php
include "../lib/koneksi.php";
$id_periode = isset($_POST['id_periode']) ? $_POST['id_periode']:"";
$periode = isset($_POST['periode']) ? $_POST['periode']:"";
$Tahun = isset($_POST['Tahun']) ? $_POST['Tahun']:"";


if ($periode=="" || $Tahun == "") {
	 	?>
	 <script language="JavaScript">
	 alert('Data harus diisi lengkap, Silahkan coba lagi!');
	 document.location='../marketing.php?page=list_periode';
	 </script>
 <?php
} else {
	$query = mysqli_query($koneksi,"INSERT INTO `tb_periode` (`id_periode`, `periode`, `Tahun`)
  VALUES ('$id_periode', '$periode', '$Tahun');") or die (mysqli_error($koneksi));
 	?>
 <script language="JavaScript">
 alert('Data Berhasil Disimpan');
 document.location='../marketing.php?page=list_periode';
 </script>

 <?php
 }
 ?>
