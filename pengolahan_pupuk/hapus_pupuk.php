<?php
include "../lib/koneksi.php";
if (isset($_GET['id'])) {
	$kd_pupuk = $_GET['id'];
} else {
	die ("Error tidak ada kode yang dipilih");
}
	if (!empty($kd_pupuk) && $kd_pupuk != "") {
		$query = "DELETE FROM tb_pupuk where kd_pupuk = '$kd_pupuk'";
		$sql   = mysqli_query($koneksi,$query);
		if($sql){
			 	?>
				 <script language="JavaScript">
				 alert('Data Berhasil Dihapus');
				 document.location='../index.php?page=list_pupuk';
				 </script>
				 <?php
		} else {
			?>
			 <script language="JavaScript">
			 alert('Data Gagal Dihapus');
			 document.location='../index.php?page=list_pupuk';
			 </script>
			 <?php
		}
	}
 ?>
