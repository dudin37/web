<?php
  include "lib/koneksi.php";
   ?>
<div class="col-md-12 col-sm-12 col-xs-12">
                        <!-- modal dialog -->
        <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="defaultModalLabel">TAMBAH PERMINTAAN</h4>
                    </div>
                    <form action="pengolahan_permintaan/simpan_permintaan.php" method="post">
                        <div class="modal-body">
                          <div class="form-group form-float" hidden>
                              <div class="form-line">
                                  <label class="form-label">id</label>
                                  <input type="text" id="id_permintaan" class="form-control" name="id_permintaan">
                              </div>
                          </div>
                            <div>
                            <label>Kios</label>
                            <select name="kd_kios" class="form-control show-tick" data-live-search="true" required="true">
                                <option selected disabled>-Pilih Kios</option>
                                <?php
                                $query =  mysqli_query($koneksi, "SELECT
                                                                    *
                                                                    FROM
                                                                    tb_kios ORDER BY nama_kios ASC");
                                while ( $row = mysqli_fetch_array($query)) {
                                    echo '<option value="'.$row['kd_kios'].'">'.$row['nama_kios'].'</option>';
                                }
                                ?>
                            </select>
                            </div>
                            <div>
                            <label>Pupuk</label>
                            <select name="kd_pupuk" class="form-control show-tick" data-live-search="true" required="true">
                                <option selected disabled>-Pilih Pupuk</option>
                                <?php
                                $query =  mysqli_query($koneksi, "SELECT
                                                                    *
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
                                    <input type="file" id="bukti"  class="" name="bukti">
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
    <h2 class="nav navbar-right">Data Permintaan Pupuk</h2>
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
              <th>Kios</th>
              <th>Penanggung Jawab</th>
              <th>Pupuk</th>
              <th>Jumlah</th>
              <th>Tanggal</th>
              <th>Bukti</th>
          </tr>
      </thead>
      <tbody>
          <?php
            $query = mysqli_query($koneksi,"SELECT
                                              tb_permintaan.id_permintaan,
                                              tb_permintaan.kd_kios,
                                              tb_permintaan.kd_pupuk,
                                              tb_permintaan.jumlah,
                                              tb_permintaan.tanggal,
                                              tb_permintaan.bukti,
                                              tb_kios.nama_kios,
                                              tb_kios.penanggung_jawab,
                                              tb_pupuk.nama_pupuk
                                              FROM
                                              tb_permintaan
                                              INNER JOIN tb_kios ON tb_permintaan.kd_kios = tb_kios.kd_kios
                                              INNER JOIN tb_pupuk ON tb_permintaan.kd_pupuk = tb_pupuk.kd_pupuk");
            if ($query != null) {
            while ($result = mysqli_fetch_array($query)) {
             ?>
              <tr>
                <td align="center">
                  <a data-toggle="tooltip" title="UBAH DATA" href="marketing.php?page=edit_permintaan&id=<?php echo $result['id_permintaan']; ?>">
                      <i class="fa fa-pencil"></i>
                  </a>
                  <a data-toggle="tooltip" title="HAPUS DATA" style="color : red;" href="pengolahan_permintaan/hapus_permintaan.php?page=hapus_permintaan&id=<?php echo $result['id_permintaan'];?>"onclick="return confirm('Apakah yakin menghapus <?php echo $result['id_permintaan'].' dari data permintaan'; ?> ?')">
                      <i class="fa fa-trash"></i>
                  </a>
                </td>
                <td>
                  <?php echo $result['nama_kios']; ?>
                </td>
                <td>
                  <?php echo $result['penanggung_jawab']; ?>
                </td>
                <td>
                  <?php echo $result['nama_pupuk']; ?>
                </td>
                <td>
                  <?php echo $result['jumlah']; ?>
                </td>
                <td>
                  <?php echo $result['tanggal']; ?>
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
