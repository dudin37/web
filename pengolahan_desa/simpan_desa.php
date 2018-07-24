<?php
include "../lib/koneksi.php";
$kd_kecamatan = isset($_POST['kd_kecamatan']) ? $_POST['kd_kecamatan']:"";
$nama_desa = isset($_POST['nama_desa']) ? $_POST['nama_desa']:"";
$polygon = isset($_POST['polygon']) ? $_POST['polygon']:"";


$query1 =  "SELECT SUBSTR(MAX(kd_desa),-2) akhir
FROM tb_desa WHERE kd_kecamatan = '$kd_kecamatan';";
$sql = mysqli_query($koneksi,$query1);
$hasil = mysqli_fetch_array($sql);
$kd = $hasil['akhir']+1;
if ($kd < 10) {
    $kd="0$kd";
} else if ($kd > 10) {
    $kd="$kd";
}
$kd_desa = "$kd_kecamatan$kd";


if ($kd_kecamatan=="" || $nama_desa == "") {
	?>
 <script language="JavaScript">
 alert('Data Gagal Disimpan, Silahkan isi dengan benar.  <?php echo "kec : ".$kd_kecamatan."des :".$kd_desa ?>');
 document.location='../index.php?page=list_desa';
 </script>

 <?php
} else {
    if ($polygon=="") {
            $query = mysqli_query($koneksi,"INSERT INTO `tb_desa`
            (`kd_desa`,
             `kd_kecamatan`,
             `nama_desa`
             )
VALUES ('$kd_desa',
        '$kd_kecamatan',
        '$nama_desa'
        );") or die (mysqli_error($koneksi));
    } else {
	$query = mysqli_query($koneksi,"INSERT INTO `tb_desa`
            (`kd_desa`,
             `kd_kecamatan`,
             `nama_desa`,
             `polygon`)
VALUES ('$kd_desa',
        '$kd_kecamatan',
        '$nama_desa',
        '$polygon');") or die (mysqli_error($koneksi));
    }
 	?>
 <script language="JavaScript">
 alert('Data Berhasil Disimpan');
 document.location='../index.php?page=list_desa';
 </script>

 <?php
 }
 ?>
