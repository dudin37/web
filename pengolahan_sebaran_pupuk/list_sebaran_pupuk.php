<?php
  include "lib/koneksi.php";
  $kd_kios = $_SESSION['username'];
 ?>



<div class="col-md-12 col-sm-12 col-xs-12">
                        <!-- modal dialog -->
        <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="defaultModalLabel">TAMBAH DISTRIBUSI</h4>
                    </div>
                    <form action="pengolahan_sebaran_pupuk/simpan_sebaran_pupuk.php" method="post">
                        <div class="modal-body">
                          <div class="form-group form-float" hidden>
                              <div class="form-line">
                                  <label class="form-label">id</label>
                                  <input type="text" id="id" class="form-control" name="id">
                              </div>
                          </div>
                            <div class="form-group form-float" hidden>
                                <div class="form-line">
                                    <label class="form-label">Kode Kios</label>
                                    <input type="text" value="<?php echo $kd_kios?>"id="kd_kios" class="form-control" name="kd_kios">
                                </div>
                            </div>
                            <div>
                            <label>Pupuk</label>
                            <select name="kd_pupuk" class="form-control show-tick" data-live-search="true" required="true">
                                <option selected disabled>-Pilih Pupuk</option>
                                <?php
                                $query =  mysqli_query($koneksi, "SELECT
                                                                    tb_pupuk.nama_pupuk,
                                                                    tb_pupuk.kd_pupuk
                                                                    FROM
                                                                    tb_pupuk");
                                while ( $row = mysqli_fetch_array($query)) {
                                    echo '<option value="'.$row['kd_pupuk'].'">'.$row['nama_pupuk'].'</option>';
                                }
                                ?>
                            </select>
                            </div>
                            <div>
                            <label>Kelompok Tani</label>
                            <?php
                              $query =  mysqli_query($koneksi, "SELECT * FROM tb_poktan WHERE kd_kios = '$kd_kios' ");
                              $rows = mysqli_fetch_array($query);
                            ?>
                            <select name="kd_poktan" id="kd_poktan" class="form-control show-tick" data-live-search="true" required="true" onchange="tes('<?php echo $rows['kd_poktan'] ?>')">
                                <option selected disabled>-Pilih Kelompok Tani</option>
                                <?php
                                $query =  mysqli_query($koneksi, "SELECT * FROM tb_poktan WHERE kd_kios = '$kd_kios' ");
                                while ( $row = mysqli_fetch_array($query)) {
                                    echo '<option value="'.$row['kd_poktan'].'">'.$row['nama_poktan'].$row['kd_poktan'].'</option>';
                                }
                                ?>
                            </select>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Desa</label>
                                    <input type="text" id="kd_desa" class="form-control" name="kd_desa" readonly required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Jumlah</label>
                                    <input type="text" id="jumlah" class="form-control" name="jumlah" onkeypress="return hanyaAngka(event)" required>
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
                                    <input type="text" id="tanggal"  class="form-control tanggal" name="tanggal" required>
                                </div>
                            </div>
                            <div class="form-group form-float" hidden>
                                <div class="form-line">
                                    <label class="form-label">Upload Bukti</label>
                                    <input type="file" id="bukti"  class="" name="bukti" required>
                                </div>
                            </div>
                        </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-link waves-effect">TAMBAH</button>
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">BATAL</button>
                    </div>
                    </form>
                  </div>
              </div>
          </div>
<!-- end modal -->
<div class="x_panel">
  <div class="x_title">
    <h2 class="nav navbar-right">Data Distribusi Pupuk</h2>
    <ul class="nav navbar-left_col ">
      <button type="button" class="btn btn-success waves-effect" data-toggle="modal" data-target="#defaultModal">TAMBAH</button>
      <!-- <a type="button" class="btn btn-success waves-effect" href="kios.php?page=tambah_sebaran_pupuk">TAMBAH</a> -->
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <table id="datatable-responsive" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
          <tr>
              <th>Aksi</th>
              <th>Nota</th>
              <th>Pupuk</th>
              <th>Kelompok Tani</th>
              <th>Jumlah</th>
              <th>Tanggal</th>
              <th>Bukti</th>
          </tr>
      </thead>
      <tbody>
          <?php
            $query = mysqli_query($koneksi,"SELECT
                                              tb_kios.nama_kios,
                                              tb_pupuk.nama_pupuk,
                                              tb_poktan.nama_poktan,
                                              tb_distribusi.no_nota,
                                              tb_distribusi.Jumlah,
                                              tb_distribusi.Tanggal,
                                              tb_distribusi.bukti,
                                              tb_distribusi.id_distribusi,
                                              tb_distribusi.kd_kios,
                                              tb_distribusi.kd_pupuk,
                                              tb_distribusi.kd_poktan
                                              FROM
                                              tb_distribusi
                                              INNER JOIN tb_poktan ON tb_distribusi.kd_poktan = tb_poktan.kd_poktan
                                              INNER JOIN tb_kios ON tb_distribusi.kd_kios = tb_kios.kd_kios AND tb_poktan.kd_kios = tb_kios.kd_kios
                                              INNER JOIN tb_pupuk ON tb_distribusi.kd_pupuk = tb_pupuk.kd_pupuk
                                              WHERE tb_distribusi.kd_kios = '$kd_kios'");
            if ($query != null) {
            while ($result = mysqli_fetch_array($query)) {
             ?>
              <tr>
                <td align="center">
                  <a data-toggle="tooltip" title="UBAH DATA" href="kios.php?page=edit_sebaran_pupuk&id=<?php echo $result['id_distribusi']; ?>">
                      <i class="fa fa-pencil"></i>
                  </a>
                  <a data-toggle="tooltip" title="HAPUS DATA" style="color : red;" href="pengolahan_sebaran_pupuk/hapus_sebaran_pupuk.php?page=hapus_sebaran_pupuk&id=<?php echo $result['id_distribusi'];?>"onclick="return confirm('Apakah yakin menghapus <?php echo $result['id_distribusi'].' dari Distribusi'; ?> ?')">
                      <i class="fa fa-trash"></i>
                  </a>
                </td>
                <td>
                  <?php echo $result['no_nota']; ?>
                </td>
                <td>
                  <?php echo $result['nama_pupuk']; ?>
                </td>
                <td>
                  <?php echo $result['nama_poktan']; ?>
                </td>
                <td>
                  <?php echo $result['Jumlah']; ?>
                </td>
                <td>
                  <?php echo $result['Tanggal']; ?>
                </td>
                <td>
                  <?php echo $result['bukti']; ?>
                </td>
              </tr>
              <?php
                }
              } else {
                  echo "Data Kosong";
                }
               ?>
      </tbody>
    </table>
           </div>
            </div>
        </div>
    </div>
</div>
</section>

<script src="datepicker/bootstrap-datepicker.js"></script>
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
