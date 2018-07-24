<?php
include "lib/koneksi.php";
if (isset($_GET['id'])) {
	$kd_kecamatan = $_GET['id'];
} else {
	die ("Error, Tidak ada kode terpilih");
}
// tampilkan data
$query1 =  "SELECT * FROM tb_kecamatan where kd_kecamatan = '$kd_kecamatan';";
$sql = mysqli_query($koneksi,$query1);
$hasil = mysqli_fetch_array($sql);
$kd_kecamatan = $hasil['kd_kecamatan'];
$nama_kecamatan = $hasil['nama_kecamatan'];
$polygon = $hasil['polygon'];
// proses edit
if(isset($_POST['edit'])){
$kd_kecamatan1 = $_POST['kd_kecamatan1'];
$nama_kecamatan1 = $_POST['nama_kecamatan1'];
$polygon1 = $_POST['polygon1'];
// update data
if ($polygon1=="") {
	$query = "UPDATE `tb_kecamatan` SET `kd_kecamatan` = '$kd_kecamatan1' , `nama_kecamatan` = '$nama_kecamatan1'
	          WHERE `kd_kecamatan` = '$kd_kecamatan';";
}else {
	$query = "UPDATE `tb_kecamatan` SET `kd_kecamatan` = '$kd_kecamatan1' , `nama_kecamatan` = '$nama_kecamatan1' , `polygon` = '$polygon1'
	          WHERE `kd_kecamatan` = '$kd_kecamatan';";
}

$sql = mysqli_query($koneksi,$query);
if ($sql) {
	   ?>
     <script language="JavaScript">
     alert('Data Berhasil Diubah');
     document.location='index.php?page=list_kecamatan';
     </script>
     <?php
} else {
	?>
    <script language="JavaScript">
     alert('Data Gagal Diubah');
     document.location='index.php?page=list_kecamatan';
     </script>
    <?php
	}
}
 ?>

<section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                DATA KECAMATAN
                            </h2>
                        </div>
                        <div class="body">
                            <form class="form-horizontal" action="" method="post" enctype="multypart/form-data" name="edit" id="edit">
                                <div class="form-group">
                                    <label for="contact-name" class="col-lg-3 control-label">Kode Kecamatan : </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="contract-name" placeholder="Masukan Kode kecamatan" name="kd_kecamatan1" value="<?php echo $kd_kecamatan ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for = "contact-msg" class="col-lg-3 control-label">Nama Kecamatan : </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="contract-name" placeholder="Masukan Nama kecamatan" name="nama_kecamatan1" value="<?php echo $nama_kecamatan ?>">
                                    </div>
                                </div>

																	<label for = "contact-msg" class="col-lg-3 control-label">Polygon : </label>
																	<div class="col-lg-6">
                                    <textarea name="polygon1" id="polygon" class="form-control" readonly=""><?php echo $polygon; ?></textarea>
																	</div>
																	<div class="form-group">
																		<input class="form-control" type="button" onclick="getGeoPoints();" value="Tambahkan Koordinat Polygon" />
																		<div id="map" style="width: 1045px; height: 300px"></div><br/>
																		<input class="form-control" type="button" onclick="drawArea();" value="Gambar Area" />
																		<input type="button" onclick="resetArea();" value="Hapus Peta" /><br/>
																	</div>
                                <div class="form-action no-margin-bottom" style="margin-left:40%">
                                <input class="btn btn-primary" type="submit" name="edit" id="edit" value="UBAH">
                                <a href="index.php?page=list_kecamatan" class="btn btn-primary">BATAL</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>
