<?php
include "../lib/koneksi.php";
$kd_pupuk = isset($_POST['kd_pupuk']) ? $_POST['kd_pupuk']:"";
$nama_pupuk = isset($_POST['nama_pupuk']) ? $_POST['nama_pupuk']:"";
$stok = isset($_POST['stok']) ? $_POST['stok']:"";
$produsen = isset($_POST['produsen']) ? $_POST['produsen']:"";

if ($kd_pupuk=="" || $nama_pupuk == "") {
	 	?>
	 <script language="JavaScript">
	 alert('Data harus diisi lengkap, Silahkan coba lagi!');
	 document.location='../index.php?page=list_pupuk';
	 </script>
 <?php
} else {
	$query = mysqli_query($koneksi,"INSERT INTO `tb_pupuk` (`kd_pupuk`, `nama_pupuk`, `stok`, `produsen`)
  VALUES ('$kd_pupuk', '$nama_pupuk', '$stok', '$produsen');") or die (mysqli_error($koneksi));
 	?>
 <script language="JavaScript">
 alert('Data Berhasil Disimpan');
 document.location='../index.php?page=list_pupuk';
 </script>

 <?php
 }
 ?>
