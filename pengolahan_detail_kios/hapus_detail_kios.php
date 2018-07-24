<?php
include "../lib/koneksi.php";
if (isset($_GET['id'])) {
	$kd_det_kios = $_GET['id'];
} else {
	die ("Error tidak ada kode yang dipilih");
}
	if (!empty($kd_det_kios) && $kd_det_kios != "") {
		$query = "DELETE
		FROM `tb_detail_kios`
		WHERE `kd_det_kios` = '$kd_det_kios';";
		$sql   = mysqli_query($koneksi,$query);

		if($sql){
			?>
			 <script language="JavaScript">
			alert('Data Pupuk Berhasil Dihapus');
			document.location='../kios.php?page=list_detail_kios';
			</script>
			<?php
		} else {
			?>
			 <script language="JavaScript">
			alert('Data Poktan Gagal Dihapus');
			document.location='../kios.php?page=list_detail_kios';
			</script>
			<?php
		}
	}
 ?>
