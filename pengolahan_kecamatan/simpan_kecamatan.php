<?php
include "../lib/koneksi.php";
$kd_kecamatan = isset($_POST['kd_kecamatan']) ? $_POST['kd_kecamatan']:"";
$nama_kecamatan = isset($_POST['nama_kecamatan']) ? $_POST['nama_kecamatan']:"";

if ($kd_kecamatan=="" || $nama_kecamatan == "") {
	 	?>
	 <script language="JavaScript">
	 alert('Kode Kecamatan dan nama Kecamatan harus diisi, Silahkan coba lagi!');
	 document.location='../index.php?page=list_kecamatan';
	 </script>
 <?php
} else {
	$query = mysqli_query($koneksi,"INSERT INTO `tb_kecamatan`
            (`kd_kecamatan`,
             `nama_kecamatan`)
	VALUES ('$kd_kecamatan',
    	    '$nama_kecamatan');") or die (mysqli_error($koneksi));
 	?>
 <script language="JavaScript">
 alert('Data Berhasil Disimpan');
 document.location='../index.php?page=list_kecamatan';
 </script>

 <?php
 }
 ?>
