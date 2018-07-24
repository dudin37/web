<?php
include "lib/koneksi.php";
error_reporting(0);
if (isset($_GET['id'])) {
    $kd_det_kios = $_GET['id'];
} else {
    die ("Error, Tidak ada kode terpilih");
}

// tampilkan data
$query1 =  "SELECT * FROM tb_detail_kios where kd_det_kios = $kd_det_kios;";
$sql = mysqli_query($koneksi,$query1);
$hasil = mysqli_fetch_array($sql);
$kd_det_kios = $hasil['kd_det_kios'];
$kd_kios = $hasil['kd_kios'];
$kd_pupuk = $hasil['kd_pupuk'];
$Stok = $hasil['Stok'];


// proses edit
if(isset($_POST['edit'])){
$kd_det_kios1 = $_POST['kd_det_kios1'];
$kd_kios1 = $_POST['kd_kios1'];
$kd_pupuk1 = $_POST['kd_pupuk1'];
$Stok1 = $_POST['Stok1'];


$query = "UPDATE `tb_detail_kios`
            SET `kd_pupuk` = '$kd_pupuk1',
              `Stok` = '$Stok1'
            WHERE `kd_det_kios` = '$kd_det_kios';";

$sql = mysqli_query($koneksi,$query);
if ($sql) {
    ?>
    <script language="JavaScript">
     alert('Data desa Berhasil Disimpan');
     document.location='kios.php?page=list_detail_kios';
     </script>
    <?php
} else {
    ?>
    <script language="JavaScript">
     alert('Data Pupuk Gagal Disimpan <?php echo $kd_pupuk1 ?>');
     document.location='kios.php?page=list_detail_kios';
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
                                         <label class="form-label">Pupuk</label>
                                         <select class="form-group form-control form-float" name="kd_pupuk1">
                                             <option value="" disabled selected>-- Pilih Pupuk --</option>
                                             <?php
                                                 $query1 = "SELECT tb_pupuk.nama_pupuk,tb_pupuk.kd_pupuk
                                                              FROM
                                                            tb_pupuk ORDER BY tb_pupuk.nama_pupuk";
                                                 $sql1 = mysqli_query($koneksi,$query1);
                                                 while ( $baris = mysqli_fetch_array($sql1)) {
                                                     if ($kd_pupuk == $baris['kd_pupuk']){
                                                         echo "<option value=$baris[kd_pupuk] selected>$baris[nama_pupuk]</option>";
                                                     }else {
                                                         echo "<option value=$baris[kd_pupuk]>$baris[nama_pupuk]</option>";
                                                     }
                                                 }
                                              ?>
                                         </select>
                                     </div>
                                 </div>
                                 <div class="form-group form-float">
                                     <div class="form-line">
                                         <label class="form-label">Stok</label>
                                         <input type="text" id="Stok" class="form-control" name="Stok1" value="<?php echo $Stok ?>"required>
                                     </div>
                                 </div>
                         </div>
                         </div>
                                 <div class="form-action no-margin-bottom" style="margin-left:40%">
                                     <input class="btn btn-primary" type="submit" name="edit" id="edit" value="UBAH">
                                     <a href="kios.php?page=list_detail_kios" class="btn btn-primary">BATAL</a>
                                 </div>
                         </form>
                         </div>
                     </div>
                 </div>
             </div>
             <!-- #END# Exportable Table -->
         </div>
     </section>
