<?php
header('Content-Type: application/json');

include "../lib/koneksi.php";
$sql = "SELECT * FROM `tb_kecamatan`";

$data = mysqli_query($koneksi,$sql);
$json = 'var kecamatan={"type": "FeatureCollection" ,';
$json .= '"features":[ ';
while($x = mysqli_fetch_assoc($data)){
	$json .= '{';
	$json .= '"type": "Feature",';
	$json .= '"properties":';
	$json .= '{';
	$json .= '"kd_kecamatan":"'.htmlspecialchars($x['kd_kecamatan']).'",
		  					"nama_kecamatan":'.htmlspecialchars($x['nama_kecamatan']);
	$json .= '},';
	$json .= '"geometry":';
	$json .= '{';
	$json .= '"type": "Polygon",';
	$json .= '"coordinates":'.htmlspecialchars($x['polygon']);
	$json .= '}';
	$json .= '},';
}

$json = substr($json,0,strlen($json)-2);
$json .= '}';
$json .= ']';
$json .= '}';

echo $json;

?>
