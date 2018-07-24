<?php
include "../lib/koneksi.php";
if (isset($_GET['id'])) {
	$kd_kecamatan = $_GET['id'];
} else {
	die ("Error tidak ada kode yang dipilih");
}
	if (!empty($kd_kecamatan) && $kd_kecamatan != "") {
		$query = "DELETE FROM tb_kecamatan where kd_kecamatan = '$kd_kecamatan'";
		$sql   = mysqli_query($koneksi,$query);
		if($sql){
			 	?>
				 <script language="JavaScript">
				 alert('Data Berhasil Dihapus');
				 document.location='../index.php?page=list_kecamatan';
				 </script>
				 <?php
		} else {
			?>
			 <script language="JavaScript">
			 alert('Data Gagal Dihapus');
			 document.location='../index.php?page=list_kecamatan';
			 </script>
			 <?php
		}
	}
 ?>
