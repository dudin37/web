<?php
include "../lib/koneksi.php";
if (isset($_GET['id'])) {
	$id = $_GET['id'];
} else {
	die ("Error tidak ada kode yang dipilih");
}
	if (!empty($id) && $id != "") {
		$query = "DELETE
		FROM `tb_permintaan`
		WHERE `id_permintaan` = '$id';";
		$sql   = mysqli_query($koneksi,$query);

		if($sql){
			?>
			 <script language="JavaScript">
			alert('Data Permintaan Berhasil Dihapus');
			document.location='../marketing.php?page=list_permintaan';
			</script>
			<?php
		} else {
			?>
			 <script language="JavaScript">
			alert('Data Gagal Dihapus');
			document.location='../marketing.php?page=list_permintaan';
			</script>
			<?php
		}
	}
 ?>
