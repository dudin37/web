<?php
include "../lib/koneksi.php";
if (isset($_GET['id'])) {
	$kd_kios = $_GET['id'];
} else {
	die ("Error tidak ada kode yang dipilih");
}
	if (!empty($kd_kios) && $kd_kios != "") {
		$query = "DELETE
		FROM `tb_kios`
		WHERE `kd_kios` = '$kd_kios';";
		$sql   = mysqli_query($koneksi,$query);

		if($sql){
			?>
			 <script language="JavaScript">
			alert('Data Kios Berhasil Dihapus');
			document.location='../marketing.php?page=list_kios';
			</script>
			<?php
		} else {
			?>
			 <script language="JavaScript">
			alert('Data Kios Gagal Dihapus');
			document.location='../marketing.php?page=list_kios';
			</script>
			<?php
		}
	}
 ?>
