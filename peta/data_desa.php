<?php
header('Content-Type: application/json');

include "../lib/koneksi.php";
$sql = "SELECT * FROM `tampil_desa`";

$data = mysqli_query($koneksi,$sql);
$json = 'var desa={"type": "FeatureCollection" ,';
$json .= '"features":[ ';
while($x = mysqli_fetch_assoc($data)){
	$json .= '{';
	$json .= '"type": "Feature",';
	$json .= '"properties":';
	$json .= '{';
	$json .= '"nama_kecamatan":"'.htmlspecialchars($x['nama_kecamatan']).'",
		  	"nama_desa":"'.htmlspecialchars($x['nama_desa']).'",
				"kd_desa":'.htmlspecialchars($x['kd_desa']);
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
