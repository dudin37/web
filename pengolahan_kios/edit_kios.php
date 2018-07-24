<?php
include "lib/koneksi.php";
error_reporting(0);
if (isset($_GET['id'])) {
    $kd_kios = $_GET['id'];
} else {
    die ("Error, Tidak ada kode terpilih");
}

//tampil Data
$query1 = "SELECT * FROM tb_kios WHERE kd_kios ='$kd_kios'";
$sql = mysqli_query($koneksi,$query1);
$hasil = mysqli_fetch_array($sql);
$kd_kios = $hasil['kd_kios'];
$nama_kios = $hasil['nama_kios'];
$alamat = $hasil['alamat'];
$penanggung_jawab = $hasil['penanggung_jawab'];
$kd_desa = $hasil['kd_desa'];
$lat = $hasil['lat'];
$lon = $hasil['lon'];

// proses edit
if(isset($_POST['edit'])){
  $kd_kios1 = $_POST['kd_kios1'];
  $nama_kios1 = $_POST['nama_kios1'];
  $alamat1 = $_POST['alamat1'];
  $penanggung_jawab1 = $_POST['penanggung_jawab1'];
  $kd_desa1 = $_POST['kd_desa1'];
  $lat1 = $_POST['lat1'];
  $lon1 = $_POST['lon1'];

$query = "UPDATE `tb_kios`
            SET `nama_kios` = '$nama_kios1',
              `alamat` = '$alamat1',
              `penanggung_jawab` = '$penanggung_jawab1',
              `kd_desa` = '$kd_desa1',
              `lat` = '$lat1',
              `lon` = '$lon1'
            WHERE `kd_kios` = '$kd_kios';";

$sql = mysqli_query($koneksi,$query);
if ($sql) {
    ?>
    <script language="JavaScript">
     alert('Data desa Berhasil Disimpan');
     document.location='marketing.php?page=list_kios';
     </script>
    <?php
} else {
    ?>
    <script language="JavaScript">
     alert('Data desa Gagal Disimpan <?php echo $kd_desa2 ?>');
     document.location='marketing.php?page=list_kios';
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
                                DATA KIOS
                            </h2>
                        </div>
                        <div class="body">
                        <form  action="" method="post" enctype="multypart/form-data" name="edit" id="edit">
                        <div class="row">
                        <div class="col-md-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Nama Kios</label>
                                        <input type="text" id="nama_kios" class="form-control" name="nama_kios1" value="<?php echo $nama_kios ?>" required>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">penanggung jawab</label>
                                        <input type="text" id="penanggung_jawab" class="form-control" name="penanggung_jawab1" value="<?php echo $penanggung_jawab ?>" required>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                  <div class="form-line">
                                      <label class="form-label">Alamat</label>
                                       <textarea class="form-control" rows="5" id="alamat" name="alamat1" required><?php echo $alamat?></textarea>
                                  </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Desa</label>
                                        <select class="form-group form-control form-float" name="kd_desa1">
                                            <option value="" disabled selected>-- Pilih Desa --</option>
                                            <?php
                                                $query1 = "SELECT
                                                                        tb_desa.nama_desa,
                                                                        tb_desa.kd_desa,
                                                                        tb_kecamatan.nama_kecamatan
                                                                        FROM
                                                                        tb_kecamatan
                                                                        INNER JOIN tb_desa ON tb_desa.kd_kecamatan = tb_kecamatan.kd_kecamatan";
                                                $sql1 = mysqli_query($koneksi,$query1);
                                                while ( $baris = mysqli_fetch_array($sql1)) {
                                                    if ($kd_desa == $baris['kd_desa']){
                                                        echo "<option value=$baris[kd_desa] selected>$baris[nama_desa] Kecamatan $baris[nama_kecamatan]</option>";
                                                    }else {
                                                        echo "<option value=$baris[kd_desa]>$baris[nama_desa] Kecamatan $baris[nama_kecamatan]</option>";
                                                    }
                                                }
                                             ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Latitude</label>
                                        <input type="text" id="lat" class="form-control" name="lat1" value="<?php echo $lat ?>" required readonly>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Longitude</label>
                                        <input type="text" id="lon" class="form-control" name="lon1" value="<?php echo $lat ?>" required readonly>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                          <div id="map" style="width: 1070px; height: 400px"></div>
                                    </div>
                                </div>
                        </div>
                        </div>
                                <div class="form-action no-margin-bottom" style="margin-left:40%">
                                    <input class="btn btn-primary" type="submit" name="edit" id="edit" value="UBAH">
                                    <a href="marketing.php?page=list_kios" class="btn btn-primary">BATAL</a>
                                </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>
