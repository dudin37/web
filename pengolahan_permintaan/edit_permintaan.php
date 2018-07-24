<?php
include "lib/koneksi.php";
error_reporting(0);
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    die ("Error, Tidak ada kode terpilih");
}

// tampilkan data
$query1 =  "SELECT * FROM tb_permintaan where id_permintaan = '$id';";
$sql = mysqli_query($koneksi,$query1);
$hasil = mysqli_fetch_array($sql);
$id = $hasil['id_permintaan'];
$kd_kios = $hasil['kd_kios'];
$kd_pupuk = $hasil['kd_pupuk'];
$jumlah = $hasil['jumlah'];
$tanggal = $hasil['tanggal'];
$bukti = $hasil['bukti'];

// proses edit
if(isset($_POST['edit'])){
  $id1 = $_POST['id_permintaan1'];
  $kd_kios1 = $_POST['kd_kios1'];
  $kd_pupuk1 = $_POST['kd_pupuk1'];
  $jumlah1 = $_POST['jumlah1'];
  $tanggal1 = $_POST['tanggal1'];
  $bukti1 = $_POST['bukti1'];


$query = "UPDATE `tb_permintaan`
            SET `kd_kios` = '$kd_kios1',
              `kd_pupuk` = '$kd_pupuk1',
              `jumlah` = '$jumlah1',
              `tanggal` = '$tanggal1',
              `bukti` = '$bukti1'
            WHERE `id_permintaan` = '$id';";

$sql = mysqli_query($koneksi,$query);
if ($sql) {
    ?>
    <script language="JavaScript">
     alert('Data Permintaan Berhasil Disimpan');
     document.location='marketing.php?page=list_permintaan';
     </script>
    <?php
} else {
    ?>
    <script language="JavaScript">
     alert('Data Permintaan Gagal Disimpan <?php echo $kd_kios1 ?>');
     document.location='marketing.php?page=list_permintaan';
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
                                DATA PERMINTAAN
                            </h2>
                        </div>
                        <div class="body">
                        <form  action="" method="post" enctype="multypart/form-data" name="edit" id="edit">
                        <div class="row">
                        <div class="col-md-12">
                          <div class="form-group form-float" hidden>
                              <div class="form-line">
                                  <label class="form-label">id</label>
                                  <input type="text" id="id_permintaan" class="form-control" name="id_permintaan1" value="<?php echo $id ?>">
                              </div>
                          </div>
                          <div class="form-group form-float">
                              <div class="form-line">
                                  <label class="form-label">Kios</label>
                                  <select class="form-group form-control form-float" name="kd_kios1">
                                      <option value="" disabled selected>-- Pilih Kios --</option>
                                      <?php
                                          $query1 = "SELECT
                                                     *
                                                     FROM
                                                     tb_kios ORDER BY nama_kios ASC";
                                          $sql1 = mysqli_query($koneksi,$query1);
                                          while ( $baris = mysqli_fetch_array($sql1)) {
                                              if ($kd_kios == $baris['kd_kios']){
                                                  echo "<option value=$baris[kd_kios] selected>$baris[nama_kios] </option>";
                                              }else {
                                                  echo "<option value=$baris[kd_kios]>$baris[nama_kios] </option>";
                                              }
                                          }
                                       ?>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group form-float">
                              <div class="form-line">
                                  <label class="form-label">Pupuk</label>
                                  <select class="form-group form-control form-float" name="kd_pupuk1">
                                      <option value="" disabled selected>-- Pilih Pupuk --</option>
                                      <?php
                                          $query1 = "SELECT
                                                     *
                                                     FROM
                                                     tb_pupuk ORDER BY nama_pupuk ASC";
                                          $sql1 = mysqli_query($koneksi,$query1);
                                          while ( $baris = mysqli_fetch_array($sql1)) {
                                              if ($kd_pupuk == $baris['kd_pupuk']){
                                                  echo "<option value=$baris[kd_pupuk] selected>$baris[nama_pupuk] </option>";
                                              }else {
                                                  echo "<option value=$baris[kd_pupuk]>$baris[nama_pupuk] </option>";
                                              }
                                          }
                                       ?>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group form-float">
                              <div class="form-line">
                                  <label class="form-label">Jumlah</label>
                                  <input type="text" id="jumlah" class="form-control" name="jumlah1" onkeypress="return hanyaAngka(event)" value="<?php echo $jumlah ?>"required>
                                  <script>
                                    function hanyaAngka(evt) {
                                      var charCode = (evt.which) ? evt.which : event.keyCode
                                       if (charCode > 31 && (charCode < 48 || charCode > 57))
                                        return false;
                                      return true;
                                    }
                                  </script>
                              </div>
                          </div>
                          <div class="form-group form-float">
                              <div class="form-line">
                                  <label class="form-label">Tanggal</label>
                                  <input type="text" id="tanggal"  class="form-control tanggal" name="tanggal1" value="<?php echo $tanggal ?>"required>
                              </div>
                          </div>

                        </div>
                        </div>
                                <div class="form-action no-margin-bottom" style="margin-left:40%">
                                    <input class="btn btn-primary" type="submit" name="edit" id="edit" value="UBAH">
                                    <a href="marketing.php?page=list_permintaan" class="btn btn-primary">BATAL</a>
                                </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>
