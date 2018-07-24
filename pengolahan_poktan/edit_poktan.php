<?php
include "lib/koneksi.php";
error_reporting(0);
if (isset($_GET['id'])) {
    $kd_poktan = $_GET['id'];
} else {
    die ("Error, Tidak ada kode terpilih");
}

// tampilkan data
$query1 =  "SELECT * FROM tb_poktan where kd_poktan = '$kd_poktan';";
$sql = mysqli_query($koneksi,$query1);
$hasil = mysqli_fetch_array($sql);
$kd_poktan = $hasil['kd_poktan'];
$nama_poktan = $hasil['nama_poktan'];
$alamat = $hasil['alamat'];
$kd_desa = $hasil['kd_desa'];
$kd_kios = $hasil['kd_kios'];

// proses edit
if(isset($_POST['edit'])){
$kd_poktan1 = $_POST['kd_poktan1'];
$nama_poktan1 = $_POST['nama_poktan1'];
$alamat1 = $_POST['alamat1'];
$kd_desa1 = $_POST['kd_desa1'];
$kd_kios1 = $_POST['kd_kios1'];

$query = "UPDATE `tb_poktan`
            SET `nama_poktan` = '$nama_poktan1',
              `alamat` = '$alamat1',
              `kd_desa` = '$kd_desa1'
            WHERE `kd_poktan` = '$kd_poktan';";

$sql = mysqli_query($koneksi,$query);
if ($sql) {
    ?>
    <script language="JavaScript">
     alert('Data desa Berhasil Disimpan');
     document.location='kios.php?page=list_poktan';
     </script>
    <?php
} else {
    ?>
    <script language="JavaScript">
     alert('Data desa Gagal Disimpan <?php echo $kd_desa2 ?>');
     document.location='kios.php?page=list_poktan';
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
                                DATA KELOMPOK TANI
                            </h2>
                        </div>
                        <div class="body">
                        <form  action="" method="post" enctype="multypart/form-data" name="edit" id="edit">
                        <div class="row">
                        <div class="col-md-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Nama Poktan</label>
                                        <input type="text" id="nama_poktan" class="form-control" name="nama_poktan1" value="<?php echo $nama_poktan ?>" required>
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
                        </div>
                        </div>
                                <div class="form-action no-margin-bottom" style="margin-left:40%">
                                    <input class="btn btn-primary" type="submit" name="edit" id="edit" value="UBAH">
                                    <a href="kios.php?page=list_poktan" class="btn btn-primary">BATAL</a>
                                </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>
