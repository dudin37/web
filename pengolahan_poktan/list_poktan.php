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
                        <h4 class="modal-title" id="defaultModalLabel">TAMBAH DATA KELOMPOK TANI</h4>
                    </div>
                    <form action="pengolahan_poktan/simpan_poktan.php" method="post">
                        <div class="modal-body">
                            <div class="form-group form-float" hidden>
                                <div class="form-line">
                                    <label class="form-label">Kode Kios</label>
                                    <input type="text" value="<?php echo $kd_kios?>"id="kd_kios" class="form-control" name="kd_kios">
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Nama Kelompok Tani</label>
                                    <input type="text" id="nama_poktan" class="form-control" name="nama_poktan" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Alamat</label>
                                     <textarea class="form-control" rows="5" id="alamat" name="alamat" required></textarea>
                                </div>
                            </div>
                            <div>
                            <label>Desa</label>
                            <select name="kd_desa" class="form-control show-tick" data-live-search="true" required="true">
                                <option selected disabled>-Pilih Desa</option>
                                <?php
                                $query =  mysqli_query($koneksi, "SELECT
                                                        tb_desa.nama_desa,
                                                        tb_desa.kd_desa,
                                                        tb_kecamatan.nama_kecamatan
                                                        FROM
                                                        tb_kecamatan
                                                        INNER JOIN tb_desa ON tb_desa.kd_kecamatan = tb_kecamatan.kd_kecamatan
                                                        ");
                                while ( $row = mysqli_fetch_array($query)) {
                                    echo '<option value="'.$row['kd_desa'].'">'.$row['nama_desa'].' Kecamatan '.$row['nama_kecamatan'].'</option>';
                                }
                                ?>
                            </select>
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
    <h2 class="nav navbar-right">Data Kelompok Tani</h2>
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
              <th>Kode Kelompok Tani</th>
              <th>Nama Kelompok Tani</th>
              <th>Alamat</th>
              <th>Desa</th>
          </tr>
      </thead>
      <tbody>
          <?php
            $query = mysqli_query($koneksi,"SELECT
                                              tb_poktan.kd_poktan,
                                              tb_poktan.nama_poktan,
                                              tb_poktan.alamat,
                                              tb_desa.nama_desa
                                              FROM
                                              tb_poktan
                                              INNER JOIN tb_desa ON tb_poktan.kd_desa = tb_desa.kd_desa
                                              WHERE kd_kios = '$kd_kios'");
            if ($query != null) {
            while ($result = mysqli_fetch_array($query)) {
             ?>
              <tr>
                <td align="center">
                  <a data-toggle="tooltip" title="UBAH DATA" href="kios.php?page=edit_poktan&id=<?php echo $result['kd_poktan']; ?>">
                      <i class="fa fa-pencil"></i>
                  </a>
                  <a data-toggle="tooltip" title="HAPUS DATA" style="color : red;" href="pengolahan_poktan/hapus_poktan.php?page=hapus_poktan&id=<?php echo $result['kd_poktan'];?>"onclick="return confirm('Apakah yakin menghapus <?php echo $result['nama_poktan'].' dari Kelompok Tani'; ?> ?')">
                      <i class="fa fa-trash"></i>
                  </a>
                </td><td>
                  <?php echo $result['kd_poktan']; ?>
                </td>
                <td>
                  <?php echo $result['nama_poktan']; ?>
                </td>
                <td>
                  <?php echo $result['alamat']; ?>
                </td>
                <td>
                  <?php echo $result['nama_desa']; ?>
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
