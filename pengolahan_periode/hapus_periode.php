<?php
include "../lib/koneksi.php";
if (isset($_GET['id'])) {
	$id_periode = $_GET['id'];
} else {
	die ("Error tidak ada kode yang dipilih");
}
	if (!empty($id_periode) && $id_periode != "") {
		$query = "DELETE FROM tb_periode where id_periode = '$id_periode'";
		$sql   = mysqli_query($koneksi,$query);
		if($sql){
			 	?>
				 <script language="JavaScript">
				 alert('Data Berhasil Dihapus');
				 document.location='../marketing.php?page=list_periode';
				 </script>
				 <?php
		} else {
			?>
			 <script language="JavaScript">
			 alert('Data Gagal Dihapus');
			 document.location='../marketing.php?page=list_periode';
			 </script>
			 <?php
		}
	}
 ?>
