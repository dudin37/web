<?php
include "lib/koneksi.php";
error_reporting(0);
if (isset($_GET['id'])) {
    $id_distribusi = $_GET['id'];
} else {
    die ("Error, Tidak ada kode terpilih");
}

// tampilkan data
$query1 =  "SELECT * FROM tb_distribusi WHERE id_distribusi =  '$id_distribusi';";
$sql = mysqli_query($koneksi,$query1);
$hasil = mysqli_fetch_array($sql);
$id_distribusi = $hasil['id'];
$no_nota = $hasil['no_nota'];
$kd_kios = $hasil['kd_kios'];
$kd_pupuk = $hasil['kd_pupuk'];
$kd_poktan = $hasil['kd_poktan'];
$kd_desa = $hasil['kd_desa'];
$jumlah = $hasil['jumlah'];
$tanggal = $hasil['tanggal'];
$bukti = $hasil['bukti'];



// proses edit
if(isset($_POST['edit'])){
  $id_distribusi1 = $_POST['id1'];
  $no_nota1 = $_POST['no_nota1'];
  $kd_kios1 = $_POST['kd_kios1'];
  $kd_pupuk1 = $_POST['kd_pupuk1'];
  $kd_poktan1 = $_POST['kd_poktan1'];
  $kd_desa1 = $_POST['kd_desa1'];
  $jumlah1 = $_POST['jumlah1'];
  $tanggal1 = $_POST['tanggal1'];
  $bukti1 = $_POST['bukti1'];


  $query1 =  "SELECT SUBSTR(MAX(kd_poktan),-10)no_nota
  FROM tb_distribusi WHERE tanggal = '$tanggal';";
  $sql = mysqli_query($koneksi,$query1);
  $hasil = mysqli_fetch_array($sql);
  $kd = $hasil['no_nota']+1;
  if ($kd < 100) {
      $kd="0$kd";
  } else if ($kd > 100) {
      $kd="$kd";
  }
  $no_nota1="$tanggal1-$kd_poktan1-$kd";


$query = "UPDATE `tb_distribusi`
            SET `no_nota` = '$no_nota1',
              `kd_pupuk` = '$kd_kios1',
              `kd_poktan` = '$kd_pupuk1',
              `kd_desa` = '$kd_desa1',
              `jumlah` = '$jumlah1',
              `tanggal` = '$tanggal1'
            WHERE `id_distribusi` = '$id_distribusi';";

$sql = mysqli_query($koneksi,$query) or die(mysqli_error($koneksi));
if ($sql) {
    ?>
    <script language="JavaScript">
     alert('Data desa Berhasil Disimpan <?php echo $no_nota1,'|',
                                                   $kd_kios1,'|',
                                                   $kd_pupuk1,'|',
                                                   $kd_poktan1,'|',
                                                   $kd_desa1,'|',
                                                   $jumlah1,'|',
                                                   $tanggal1,'|',
                                                   $bukti1 ?>');
     document.location='kios.php?page=list_sebaran_pupuk';
     </script>
    <?php
} else {
    ?>
    <script language="JavaScript">
     alert('Data Gagal Disimpan : <?php echo mysqli_error($koneksi,$query) ?>');
     document.location='kios.php?page=list_sebaran_pupuk';
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
                                 DATA DISTRIBUSI
                             </h2>

                         </div>
                         <div class="body">
                         <form  action="" method="post" enctype="multypart/form-data" name="edit" id="edit">
                         <div class="row">
                         <div class="col-md-12">
                           <div class="form-group form-float" hidden>
                               <div class="form-line">
                                   <label class="form-label">Kode Kios</label>
                                   <input type="text" value="<?php echo $kd_kios?>"id="kd_kios" class="form-control" name="kd_kios1">
                               </div>
                           </div>

                           <div class="form-group form-float">
                               <div class="form-line">
                                   <label class="form-label">Pupuk</label>
                                   <select class="form-group form-control form-float" name="kd_pupuk1">
                                       <option disabled selected>-- Pilih Pupuk --</option>
                                       <?php
                                           $query1 = "SELECT *
                                                      FROM
                                                      tb_pupuk" ;
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
                                   <label class="form-label">Kelompok Tani</label>
                                   <?php
                                     $query =  mysqli_query($koneksi, "SELECT * FROM tb_poktan WHERE kd_kios = '$kd_kios' ");
                                     $rows = mysqli_fetch_array($query);
                                   ?>
                                   <select class="form-group form-control form-float" name="kd_poktan1">
                                       <option disabled selected>-- Pilih Kelompok Tani --</option>
                                       <?php
                                           $query1 = "SELECT * FROM tb_poktan WHERE kd_kios = '$kd_kios' " ;
                                           $sql1 = mysqli_query($koneksi,$query1);
                                           while ( $baris = mysqli_fetch_array($sql1)) {
                                               if ($kd_poktan == $baris['kd_poktan']){
                                                   echo "<option value=$baris[kd_poktan] selected>$baris[nama_poktan] </option>";
                                               }else {
                                                   echo "<option value=$baris[kd_poktan]>$baris[nama_poktan] </option>";
                                               }
                                           }
                                        ?>
                                   </select>
                               </div>
                           </div>


                           <div class="form-group form-float">
                               <div class="form-line">
                                   <label class="form-label">Desa</label>
                                   <input type="text" id="kd_desa" class="form-control" name="kd_desa1" value="<?php echo $kd_desa ?>" readonly required>
                               </div>
                           </div>

                           <div class="form-group form-float">
                               <div class="form-line">
                                   <label class="form-label">Jumlah</label>
                                   <input type="text" id="jumlah" class="form-control" name="jumlah1" onkeypress="return hanyaAngka(event)" value="<?php echo $jumlah?>" required>
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
                                   <input type="text" id="tanggal"  class="form-control tanggal" name="tanggal1" value="<?php echo $tanggal?>" required>
                               </div>
                           </div>

                           <!-- <div class="form-group form-float" hidden>
                               <div class="form-line">
                                   <label class="form-label">Upload Bukti</label>
                                   <input type="file" id="bukti"  class="" name="bukti1" required>
                               </div>
                           </div> -->

                         </div>
                         </div>
                                 <div class="form-action no-margin-bottom" style="margin-left:40%">
                                     <input class="btn btn-primary" type="submit" name="edit" id="edit" value="UBAH">
                                     <a href="kios.php?page=list_sebaran_pupuk" class="btn btn-primary">BATAL</a>
                                 </div>
                         </form>
                         </div>
                     </div>
                 </div>
             </div>
             <!-- #END# Exportable Table -->
         </div>
     </section>


     <scipt src="datepicker/bootstrap-datepicker.js"></script>
             <script type="text/javascript">
                 $(document).ready(function () {
                     $('.tanggal').datepicker({
                         format: "yyyy-mm-dd",
                         autoclose:true
                     });
                 });

                 function tes(str){
                   var id = str;

                   $.ajax({
                       type: "POST",
                       cache: false,
                       url: 'pengolahan_sebaran_pupuk/get_desa.php',
                       data: 'id='+id,
                       success: function(data) {
                           // alert(data);
                           $("#kd_desa").val(data);
                       }
                   });
                 }


             </script>
