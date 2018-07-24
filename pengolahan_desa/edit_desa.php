<?php
include "lib/koneksi.php";
if (isset($_GET['id'])) {
    $kd_desa = $_GET['id'];
} else {
    die ("Error, Tidak ada kode terpilih");
}
// tampilkan data
$query1 =  "SELECT * FROM tb_desa where kd_desa = '$kd_desa';";
$sql = mysqli_query($koneksi,$query1);
$hasil = mysqli_fetch_array($sql);
$kd_kecamatan = $hasil['kd_kecamatan'];
$nama_desa = $hasil['nama_desa'];
$polygon = $hasil['polygon'];


// proses edit
if(isset($_POST['edit'])){

$kd_kecamatan1 = $_POST['kd_kecamatan1'];
$nama_desa1 = $_POST['nama_desa1'];
$polygon1 = $_POST['polygon1'];
if ($polygon1=="") {
    $query = "UPDATE `tb_desa`
              SET `kd_kecamatan` = '$kd_kecamatan1',
                `nama_desa` = '$nama_desa1'
              WHERE `kd_desa` = '$kd_desa';";
} else {
$query = "UPDATE `tb_desa`
            SET `kd_kecamatan` = '$kd_kecamatan1',
              `nama_desa` = '$nama_desa1',
              `polygon` = '$polygon1'
            WHERE `kd_desa` = '$kd_desa';";
}
$sql = mysqli_query($koneksi,$query);
if ($sql) {
    ?>
    <script language="JavaScript">
     alert('Data desa Berhasil Disimpan');
     document.location='index.php?page=list_desa';
     </script>
    <?php
} else {
    ?>
    <script language="JavaScript">
     alert('Data desa Gagal Disimpan <?php echo $kd_desa2 ?>');
     document.location='index.php?page=list_desa';
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
                                DATA DESA
                            </h2>
                        </div>
                        <div class="body">
                        <form  action="" method="post" enctype="multypart/form-data" name="edit" id="edit">
                        <div class="row">
                        <div class="col-md-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Kecamatan</label>
                                        <select class="form-group form-control form-float" name="kd_kecamatan1">
                                            <option value="" disabled selected>-- Pilih Kecamatan --</option>
                                            <?php
                                                $query1 = "SELECT kd_kecamatan,nama_kecamatan FROM tb_kecamatan ORDER BY nama_kecamatan;";
                                                $sql1 = mysqli_query($koneksi,$query1);
                                                while ( $baris = mysqli_fetch_array($sql1)) {
                                                    if ($kd_kecamatan == $baris['kd_kecamatan']){
                                                        echo "<option value=$baris[kd_kecamatan] selected>$baris[nama_kecamatan]</option>";
                                                    }else {
                                                        echo "<option value=$baris[kd_kecamatan]>$baris[nama_kecamatan]</option>";
                                                    }
                                                }
                                             ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Nama Desa</label>
                                        <input type="text" id="nama_desa" class="form-control" name="nama_desa1" value="<?php echo $nama_desa ?> " required>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <textarea name="polygon1" id="polygon" class="form-control" readonly=""><?php echo $polygon; ?></textarea>
                                </div>
                                <input type="button" onclick="getGeoPoints();" value="Tambahkan Koordinat Polygon" />
                                <div id="map" style="width: 1050px; height: 400px"></div><br />
                                <input type="button" onclick="drawArea();" value="Gambar Area" /> <input type="button" onclick="resetArea();" value="Hapus Peta" /><br />
                        </div>
                        </div>
                                <div class="form-action no-margin-bottom" style="margin-left:40%">
                                    <input class="btn btn-primary" type="submit" name="edit" id="edit" value="UBAH">
                                    <a href="index.php?page=list_desa" class="btn btn-primary">BATAL</a>
                                </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>
