<?php
include "lib/koneksi.php";
if (isset($_GET['id'])) {
	$kd_pupuk = $_GET['id'];
} else {
	die ("Error, Tidak ada kode terpilih");
}
// tampilkan data
$query1 =  "SELECT * FROM tb_pupuk where kd_pupuk = '$kd_pupuk';";
$sql = mysqli_query($koneksi,$query1);
$hasil = mysqli_fetch_array($sql);
$kd_pupuk = $hasil['kd_pupuk'];
$nama_pupuk = $hasil['nama_pupuk'];
$stok = $hasil['stok'];
$produsen = $hasil['produsen'];
// proses edit
if(isset($_POST['edit'])){
$kd_pupuk1 = $_POST['kd_pupuk1'];
$nama_pupuk1 = $_POST['nama_pupuk1'];
$stok1 = $_POST['stok1'];
$produsen1 = $_POST['produsen1'];
// update data
$query = "UPDATE `tb_pupuk` SET `kd_pupuk` = '$kd_pupuk1' , `nama_pupuk` = '$nama_pupuk1' , `stok` = '$stok1' , `produsen` = '$produsen1'
          WHERE `kd_pupuk` = '$kd_pupuk';";
$sql = mysqli_query($koneksi,$query);
if ($sql) {
	   ?>
     <script language="JavaScript">
     alert('Data Berhasil Diubah');
     document.location='index.php?page=list_pupuk';
     </script>
     <?php
} else {
	?>
    <script language="JavaScript">
     alert('Data Gagal Diubah');
     document.location='index.php?page=list_pupuk';
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
                                Data Pupuk
                            </h2>
                        </div>
                        <div class="body">
                            <form class="form-horizontal" action="" method="post" enctype="multypart/form-data" name="edit" id="edit">
                                <div class="form-group">
                                    <label for="contact-name" class="col-lg-3 control-label">Kode pupuk : </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="contract-name" placeholder="Masukan Kode pupuk" name="kd_pupuk1" value="<?php echo $kd_pupuk ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for = "contact-msg" class="col-lg-3 control-label">Nama pupuk : </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="contract-name" placeholder="Masukan Nama pupuk" name="nama_pupuk1" value="<?php echo $nama_pupuk ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for = "contact-msg" class="col-lg-3 control-label">Stok pupuk : </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="contract-name" placeholder="Masukan Stok pupuk" name="stok1" value="<?php echo $nama_pupuk ?>">
                                    </div>
                                </div>
                                <div>
                                <div class="form-group">
                                <label for = "contact-msg" class="col-lg-3 control-label">Produsen</label>
                                <div class="col-lg-6">
                                <select name="produsen1" class="form-control show-tick" data-live-search="true" required="true">
                                    <option selected disabled>Pilih Produsen</option>
                                    <option value="PT PUPUK KUJANG">PT PUPUK KUJANG</option>
                                    <option value="PT PUPUK PETROKIMIA">PT PUPUK PETROKIMIA</option>
                                </select>
                              </div>
                                </div>
                                </div>
                                <div class="form-action no-margin-bottom" style="margin-left:40%">
                                <input class="btn btn-primary" type="submit" name="edit" id="edit" value="UBAH">
                                <a href="index.php?page=list_pupuk" class="btn btn-primary">BATAL</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>
