<?php
include "../lib/koneksi.php";
 $q = $_REQUEST['id'];
// $q = 1203003002;
//
//
//
$sql="SELECT
tb_poktan.kd_poktan,
tb_poktan.nama_poktan,
tb_poktan.alamat,
tb_poktan.kd_desa,
tb_poktan.kd_kios,
tb_desa.nama_desa
FROM
tb_desa
INNER JOIN tb_poktan ON tb_poktan.kd_desa = tb_desa.kd_desa
WHERE kd_poktan = '".$q."'";
$result = mysqli_query($koneksi,$sql);
$hasil = mysqli_fetch_array($result);
$kd = $hasil['kd_desa'];

echo $kd;

?>
