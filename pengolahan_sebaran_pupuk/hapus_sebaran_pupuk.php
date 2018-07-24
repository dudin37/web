<?php
include "../lib/koneksi.php";
if (isset($_GET['id'])) {
	$id_distibusi = $_GET['id'];
} else {
	die ("Error tidak ada kode yang dipilih");
}
	if (!empty($id_distibusi) && $id_distibusi != "") {
		$query = "DELETE FROM tb_distribusi where id_distribusi = '$id_distibusi'";
		$sql   = mysqli_query($koneksi,$query);
		if($sql){
			 	?>
				 <script language="JavaScript">
				 alert('Data Berhasil Dihapus');
				 document.location='../kios.php?page=list_sebaran_pupuk';
				 </script>
				 <?php
		} else {
			?>
			 <script language="JavaScript">
			 alert('Data Gagal Dihapus');
			 document.location='../kios.php?page=list_sebaran_pupuk';
			 </script>
			 <?php
		}
	}
 ?>
