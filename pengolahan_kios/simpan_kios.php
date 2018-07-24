<?php
session_start();
include "../lib/koneksi.php";
$nama_kios =  isset($_POST['nama_kios']) ? $_POST['nama_kios']:"";
$penanggung_jawab =  isset($_POST['penanggung_jawab']) ? $_POST['penanggung_jawab']:"";
$alamat =  isset($_POST['alamat']) ? $_POST['alamat']:"";
$kd_desa =  isset($_POST['kd_desa']) ? $_POST['kd_desa']:"";
$lat =  isset($_POST['lat']) ? $_POST['lat']:"";
$lon =  isset($_POST['lon']) ? $_POST['lon']:"";




$query1 =  "SELECT SUBSTR(MAX(kd_kios),-2) kios
FROM tb_kios WHERE kd_desa= '$kd_desa';";
$sql = mysqli_query($koneksi,$query1);
$hasil = mysqli_fetch_array($sql);
$kd = $hasil['kios']+1;
if ($kd < 10) {
    $kd="0$kd";
} else if ($kd > 10) {
    $kd="$kd";
}
$kd_kios="$kd_desa$kd";



if ($kd_kios == "" || $nama_kios =="") {
	?>
 <script language="JavaScript">
 alert('Data Gagal Disimpan, Silahkan isi dengan benar.  <?php echo "kios : ".$kd_kios. "Nama Kios :".$nama_kios ?>');
 document.location='../marketing.php?page=list_kios';
 </script>

 <?php
 } else {
   $query = mysqli_query($koneksi,"INSERT INTO `db_sig_pupuk`.`tb_kios` (`kd_kios`, `nama_kios`, `alamat`, `penanggung_jawab`, `kd_desa`, `lat`, `lon`)
   VALUES ('$kd_kios',
           '$nama_kios',
           '$alamat',
           '$penanggung_jawab',
           '$kd_desa',
           '$lat',
           '$lon'); ") or die (mysqli_error($koneksi));

  ?>
 <script language="JavaScript">
 alert('Data Berhasil Disimpan');
 document.location='../marketing.php?page=list_kios';
 </script>

 <?php
 }
 ?>
