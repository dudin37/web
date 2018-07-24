<?php
include "../lib/koneksi.php";
// move_uploaded_file($_FILES["bukti"]["tmp_name"],"images/" . $_FILES["bukti"]["name"]);

$id= isset($_POST['id_permintaan']) ? $_POST["id_permintaan"]:"";
$bukti= "";
$kd_kios =  isset($_POST['kd_kios']) ? $_POST['kd_kios']:"";
$kd_pupuk =  isset($_POST['kd_pupuk']) ? $_POST['kd_pupuk']:"";
$jumlah = isset($_POST['jumlah']) ? $_POST['jumlah']:"";
$tanggal =  isset($_POST['tanggal']) ? $_POST['tanggal']:"";



if ($kd_kios == "" || $kd_pupuk == "") {
	?>
 <script language="JavaScript">
 alert('Data Gagal Disimpan, Silahkan isi dengan benar.  <?php echo "kios : ".$kd_kios." Pupuk :".$kd_pupuk ?>');
 document.location='../marketing.php?page=list_permintaan';
 </script>

 <?php
 } else {
   $query = mysqli_query($koneksi,"INSERT INTO `db_sig_pupuk`.`tb_permintaan` (`id_permintaan`, `kd_kios`, `kd_pupuk`, `jumlah`, `tanggal`, `bukti`)
                                    VALUES ('$id',
                                            '$kd_kios',
                                            '$kd_pupuk',
                                            '$jumlah',
                                            '$tanggal',
                                            '$bukti');") or die (mysqli_error($koneksi));

  ?>
 <script language="JavaScript">
 alert('Data Berhasil Disimpan');
 document.location='../marketing.php?page=list_permintaan';
 </script>

 <?php
 }
 ?>
