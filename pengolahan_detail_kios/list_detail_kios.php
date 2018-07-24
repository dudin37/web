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
                        <h4 class="modal-title" id="defaultModalLabel">TAMBAH DATA</h4>
                    </div>
                    <form action="pengolahan_detail_kios/simpan_detail_kios.php" method="post">
                        <div class="modal-body">
                          <div class="form-group form-float" hidden>
                              <div class="form-line">
                                  <label class="form-label">Kode Detail Kios</label>
                                  <input type="text" id="kd_det_kios" class="form-control" name="kd_det_kios">
                              </div>
                          </div>
                            <div class="form-group form-float" hidden>
                                <div class="form-line">
                                    <label class="form-label">Kode Kios</label>
                                    <input type="text" value="<?php echo $kd_kios?> "id="kd_kios" class="form-control" name="kd_kios">
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
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Stok</label>
                                    <input type="text" id="Stok" class="form-control" name="Stok" onkeypress="return hanyaAngka(event)" required>
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
    <h2 class="nav navbar-right">Data Kios</h2>
    <ul class="nav navbar-left_col ">
      <button type="button" class="btn btn-success waves-effect" data-toggle="modal" data-target="#defaultModal">TAMBAH</button>
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <table id="datatable-responsive" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
          <tr>
              <th>Aksi</th>
              <th>Nama Pupuk</th>
              <th>Stok Kios</th>
          </tr>
      </thead>
      <tbody>
          <?php
            $query = mysqli_query($koneksi,"SELECT
                                              tb_detail_kios.kd_pupuk,
                                              tb_pupuk.nama_pupuk,
                                              tb_detail_kios.Stok,
                                              tb_detail_kios.kd_det_kios,
                                              tb_detail_kios.kd_kios
                                              FROM
                                              tb_pupuk
                                              INNER JOIN tb_detail_kios ON tb_detail_kios.kd_pupuk = tb_pupuk.kd_pupuk
                                              ");
            if ($query != null) {
            while ($result = mysqli_fetch_array($query)) {
             ?>
              <tr>
                <td align="center">
                  <a data-toggle="tooltip" title="UBAH DATA" href="kios.php?page=edit_detail_kios&id=<?php echo $result['kd_det_kios']; ?>">
                      <i class="fa fa-pencil"></i>
                  </a>
                  <a data-toggle="tooltip" title="HAPUS DATA" style="color : red;" href="pengolahan_detail_kios/hapus_detail_kios.php?page=hapus_detail_kios&id=<?php echo $result['kd_det_kios'];?>"onclick="return confirm('Apakah yakin menghapus <?php echo $result['nama_pupuk'].' dari Data Kios'; ?> ?')">
                      <i class="fa fa-trash"></i>
                  </a>
                </td><td>
                  <?php echo $result['nama_pupuk']; ?>
                </td>
                <td>
                  <?php echo $result['Stok']; ?>
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
