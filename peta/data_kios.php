<?php
header('Content-Type: application/json');

include "../lib/koneksi.php";
$sql = "SELECT * FROM `tb_kios`";

$data = mysqli_query($koneksi,$sql);
$json = 'var kios={"type": "FeatureCollection" ,';
$json .= '"features":[ ';
while($x = mysqli_fetch_assoc($data)){
	$json .= '{';
	$json .= '"type": "Feature",';
	$json .= '"geometry":{';
	$json .= '"type": "Point",';
	$json .= '"coordinates": ['.htmlspecialchars($x['lon']).','.htmlspecialchars($x['lat']);
	$json .= ']},';
	$json .= '"properties":{';
	$json .= '"kd_kios":"'.htmlspecialchars($x['kd_kios']).'",
		"nama_kios":"'.htmlspecialchars($x['nama_kios']).'",
		"alamat":"'.htmlspecialchars($x['alamat']).'",
    "penanggung_jawab":"'.htmlspecialchars($x['penanggung_jawab']).'",
    "latitude":"'.htmlspecialchars(preg_replace('/\s+/', '', $x['lat'])).'",
		"longitude":"'.htmlspecialchars(preg_replace('/\s+/', '', $x['lon'])).'",
		"kd_desa":"'.htmlspecialchars($x['kd_desa']);
	$json .= '"}';
	$json .= '},';
}
$json = substr($json,0,strlen($json)-1);
$json .= ']';
$json .= '}';
echo $json;
?>
