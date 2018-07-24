<?php
include "../lib/koneksi.php";
if (isset($_GET['id'])) {
	$kd_desa = $_GET['id'];
} else {
	die ("Error tidak ada kode yang dipilih");
}
	if (!empty($kd_desa) && $kd_desa != "") {
		$query = "DELETE
		FROM `tb_desa`
		WHERE `kd_desa` = '$kd_desa';";
		$sql   = mysqli_query($koneksi,$query);

		if($sql){
			?>
			 <script language="JavaScript">
			alert('Data Desa Berhasil Dihapus');
			document.location='../index.php?page=list_desa';
			</script>
			<?php
		} else {
			?>
			 <script language="JavaScript">
			alert('Data Desa Gagal Dihapus');
			document.location='../index.php?page=list_desa';
			</script>
			<?php
		}
	}
 ?>
