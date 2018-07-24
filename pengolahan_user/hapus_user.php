<?php
include "../lib/koneksi.php";
if (isset($_GET['id'])) {
	$username = $_GET['id'];
} else {
	die ("Error tidak ada kode yang dipilih");
}
	if (!empty($username) && $username != "") {
		$query = "DELETE FROM tb_user where username = '$username'";
		$sql   = mysqli_query($koneksi,$query);
		if($sql){
			 	?>
				 <script language="JavaScript">
				 alert('Data Berhasil Dihapus');
				 document.location='../index.php?page=list_user';
				 </script>
				 <?php
		} else {
			?>
			 <script language="JavaScript">
			 alert('Data Gagal Dihapus');
			 document.location='../index.php?page=list_user';
			 </script>
			 <?php
		}
	}
 ?>