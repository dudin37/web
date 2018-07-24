<?php
session_start();
include "../lib/koneksi.php";
// move_uploaded_file($_FILES["bukti"]["tmp_name"],"images/" . $_FILES["bukti"]["name"]);

$id= isset($_POST['id']) ? $_POST["id"]:"";
$bukti= "";
$kd_kios =  isset($_POST['kd_kios']) ? $_POST['kd_kios']:"";
$kd_pupuk =  isset($_POST['kd_pupuk']) ? $_POST['kd_pupuk']:"";
$kd_poktan = isset($_POST['kd_poktan']) ? $_POST['kd_poktan']:"";
$jumlah = isset($_POST['jumlah']) ? $_POST['jumlah']:"";
$tanggal =  isset($_POST['tanggal']) ? $_POST['tanggal']:"";
$kd_desa =  isset($_POST['kd_desa']) ? $_POST['kd_desa']:"";



$query1 =  "SELECT SUBSTR(MAX(kd_poktan),-10)no_nota
FROM tb_distribusi WHERE tanggal = '$tanggal';";
$sql = mysqli_query($koneksi,$query1);
$hasil = mysqli_fetch_array($sql);
$kd = $hasil['no_nota']+1;
if ($kd < 100) {
    $kd="0$kd";
} else if ($kd > 100) {
    $kd="$kd";
}
$no_nota="$tanggal-$kd_poktan-$kd";





if ($tanggal == "") {
	?>
 <script language="JavaScript">
 alert('Data Gagal Disimpan, Silahkan isi dengan benar.  <?php echo "pupuk : ".$kd_pupuk." Tanggal :".$tanggal ?>');
 document.location='../kios.php?page=list_poktan';
 </script>

 <?php
 } else {
   $query = mysqli_query($koneksi,"INSERT INTO tb_distribusi(id_distribusi,no_nota,kd_kios,kd_pupuk,kd_poktan,kd_desa,jumlah,tanggal,bukti)
    VALUES ('$id',
             '$no_nota',
             '$kd_kios',
             '$kd_pupuk',
             '$kd_poktan',
             '$kd_desa',
             '$jumlah',
             '$tanggal',
             '$bukti');") or die (mysqli_error($koneksi));

  ?>
 <script language="JavaScript">
 alert('Data Berhasil Disimpan');
 document.location='../kios.php?page=list_sebaran_pupuk';
 </script>

 <?php
 }
 ?>
