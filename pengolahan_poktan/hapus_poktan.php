<?php
include "../lib/koneksi.php";
if (isset($_GET['id'])) {
	$kd_poktan = $_GET['id'];
} else {
	die ("Error tidak ada kode yang dipilih");
}
	if (!empty($kd_poktan) && $kd_poktan != "") {
		$query = "DELETE
		FROM `tb_poktan`
		WHERE `kd_poktan` = '$kd_poktan';";
		$sql   = mysqli_query($koneksi,$query);

		if($sql){
			?>
			 <script language="JavaScript">
			alert('Data Kelompok Tani Berhasil Dihapus');
			document.location='../kios.php?page=list_poktan';
			</script>
			<?php
		} else {
			?>
			 <script language="JavaScript">
			alert('Data Poktan Gagal Dihapus');
			document.location='../kios.php?page=list_poktan';
			</script>
			<?php
		}
	}
 ?>
