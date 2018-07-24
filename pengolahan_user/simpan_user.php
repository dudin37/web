<?php
include "../lib/koneksi.php";
$kd_user = isset($_POST['username']) ? $_POST['username']:"";
$password = isset($_POST['password']) ? $_POST['password']:"";
$nama = isset($_POST['nama']) ? $_POST['nama']:"";
$alamat = isset($_POST['alamat']) ? $_POST['alamat']:"";
$telp = isset($_POST['telp']) ? $_POST['telp']:"";
$hak_akses = isset($_POST['hak_akses']) ? $_POST['hak_akses']:"";

if ($username=="" || $password == "") {
	 	?>
	 <script language="JavaScript">
	 alert('Username dan Password harus diisi, Silahkan coba lagi!');
	 document.location='../index.php?page=list_user';
	 </script>
 <?php
} else {
	$query = mysqli_query($koneksi,"INSERT INTO `tb_user`
            (`username`,
             `password`,
             `nama`,
             `alamat`,
             `telp`,
             `hak_akses`)
	VALUES ('$username',
    	    '$password','$nama','$alamt','$telp','$hak_akses');") or die (mysqli_error($koneksi));
 	?>
 <script language="JavaScript">
 alert('Data Berhasil Disimpan');
 document.location='../index.php?page=list_user';
 </script>

 <?php
 }
 ?>
