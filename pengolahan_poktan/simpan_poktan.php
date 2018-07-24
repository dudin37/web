<?php
session_start();
include "../lib/koneksi.php";
$kd_kios =  isset($_POST['kd_kios']) ? $_POST['kd_kios']:"";
$nama_poktan = isset($_POST['nama_poktan']) ? $_POST['nama_poktan']:"";
$alamat = isset($_POST['alamat']) ? $_POST['alamat']:"";
$kd_desa =  isset($_POST['kd_desa']) ? $_POST['kd_desa']:"";



$query1 =  "SELECT SUBSTR(MAX(kd_poktan),-10) poktan
FROM tb_poktan WHERE kd_kios = '$kd_kios';";
$sql = mysqli_query($koneksi,$query1);
$hasil = mysqli_fetch_array($sql);
$kd = $hasil['poktan']+1;
if ($kd < 10) {
    $kd="00$kd";
} else if ($kd > 10) {
    $kd="0$kd";
} else if ($kd > 100) {
    $kd="$kd";
}
$kd_poktan="$kd_kios$kd";

// $query2 =  "SELECT SUBSTR(MAX(kd_desa),-4) desa
// FROM tb_poktan WHERE kd_kios = '$kd_kios';";
// $sq2 = mysqli_query($koneksi,$query2);
// $hasil1 = mysqli_fetch_array($sql);
// $kd1 = $hasil1['desa'];
// $kd_desa = "$kd1";


if ($nama_poktan == "") {
	?>
 <script language="JavaScript">
 alert('Data Gagal Disimpan, Silahkan isi dengan benar.  <?php echo "kios : ".$kd_kios."poktan :".$nama_poktan ?>');
 document.location='../kios.php?page=list_poktan';
 </script>

 <?php
 } else {
   $query = mysqli_query($koneksi,"INSERT INTO tb_poktan(kd_poktan,nama_poktan,alamat,kd_desa,kd_kios)
    VALUES ('$kd_poktan',
             '$nama_poktan',
             '$alamat',
             '$kd_desa',
             '$kd_kios');") or die (mysqli_error($koneksi));

  ?>
 <script language="JavaScript">
 alert('Data Berhasil Disimpan');
 document.location='../kios.php?page=list_poktan';
 </script>

 <?php
 }
 ?>
