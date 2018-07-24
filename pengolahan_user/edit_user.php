<?php
include "lib/koneksi.php";
if (isset($_GET['id'])) {
    $username = $_GET['id'];
} else {
    die ("Error, Tidak ada kode terpilih");
}
// tampilkan data
$query1 =  "SELECT * FROM tb_user where username = '$username';";
$sql = mysqli_query($koneksi,$query1);
$hasil = mysqli_fetch_array($sql);
$username   = $hasil['username'];
$password = $hasil['password'];
$nama       = $hasil['nama'];
$telp   = $hasil['telp'];
$hak_akses   = $hasil['hak_akses'];
// proses edit
if(isset($_POST['edit'])){
$username1   = $_POST['username1'];
$password1 = $_POST['password1'];
$nama1       = $_POST['nama1'];
$telp1   = $_POST['telp1'];
$hak_akses1   = $_POST['hak_akses1'];
// update data
$query = "UPDATE `tb_user` SET `username` = '$username1' ,    `password` = '$password1' ,    `nama` = '$nama1' ,    `telp` = '$telp1' , `hak_akses` = '$hak_akses1'
WHERE `username` = '$username'";
$sql = mysqli_query($koneksi,$query);
//echo mysqli_error($query);
if ($sql) {
       ?>
     <script language="JavaScript">
    // alert(data);
     alert('Data Berhasil Diubah');
     document.location='index.php?page=list_user';
     </script>
     <?php
} else {
    ?>
    <script language="JavaScript">
    //alert(data);
    alert('Data Gagal Diubah');
     document.location='index.php?page=list_user';
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
                                DATA USER
                            </h2>
                        </div>
                        <div class="body">
                            <form class="form-horizontal" action="" method="post" enctype="multypart/form-data" name="edit" id="edit">
                                <div class="form-group">
                                    <label for="contact-name" class="col-lg-3 control-label">Username : </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="contract-name" placeholder="Masukan Kode User" name="username1" value="<?php echo $username ?>" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for = "contact-msg" class="col-lg-3 control-label">Password : </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="contract-name" placeholder="Masukan Nama User" name="password1" value="<?php echo $password ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for = "contact-msg" class="col-lg-3 control-label">Nama : </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="contract-name" placeholder="Masukan nama User" name="nama1" value="<?php echo $nama ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for = "contact-msg" class="col-lg-3 control-label">No Telp : </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="contract-name" placeholder="Masukan telp User" name="telp1" value="<?php echo $telp ?>">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for = "contact-msg" class="col-lg-3 control-label">Hak Akses : </label>
                                    <div class="col-lg-6">
                                    <select name="hak_akses1" id="contract-name" class="form-control"><?php echo $hak_akses ?>
                                        <option value=>Hak Akses</option>
                                        <option value="Direktur">Direktur</option>
                                        <option value="Kios">Kios</option>
                                        <option value="Marketing">Marketing</option>
                                        <option value="Admin/CS">Admin/CS</option>
                                    </select>
                                </div>
                            </div>
                                <div class="form-action no-margin-bottom" style="margin-left:40%">
                                <input class="btn btn-primary" type="submit" name="edit" id="edit" value="UBAH">
                                <a href="index.php?page=list_user" class="btn btn-primary">BATAL</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>
