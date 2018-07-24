<?php
  include "lib/koneksi.php";
 ?>
<div class="col-md-12 col-sm-12 col-xs-12">
                        <!-- modal dialog -->
        <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="defaultModalLabel">TAMBAH DATA DESA</h4>
                    </div>
                    <form action="pengolahan_desa/simpan_desa.php" method="post">
                    <div class="modal-body">
                            <div>
                            <label>Kecamatan</label>
                            <select name="kd_kecamatan" class="form-control show-tick" data-live-search="true" required="true">
                                <option selected disabled>-PILIH KECAMATAN</option>
                                <?php
                                $query =  mysqli_query($koneksi, "SELECT kd_kecamatan,nama_kecamatan FROM tb_kecamatan ORDER BY nama_kecamatan");
                                while ( $row = mysqli_fetch_array($query)) {
                                    echo '<option value="'.$row['kd_kecamatan'].'">'.$row['nama_kecamatan'].'</option>';
                                }
                                ?>
                            </select>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Nama Desa</label>
                                    <input type="text" id="nama_desa" class="form-control" name="nama_desa" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                  <div>
                                  <label>POLYGON</label>
                                    <textarea class="form-control" name="polygon" id="polygon" placeholder="Masukan koordinat polygon" readonly=""></textarea>
                                  </div>
                                  <input type="button" onclick="getGeoPoints();" value="Tambahkan Koordinat Polygon" />
                                    <!-- peta -->
                                  <div id="map" style="width: 570px; height: 200px"></div><br />
                                    <input type="button" onclick="drawArea();" value="Gambar Area" /> <input type="button" onclick="resetArea();" value="Hapus Peta" /><br />
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
    <h2 class="nav navbar-right">DATA DESA</h2>
    <ul class="nav navbar-left_col ">
        <!--  <button type="button" class="btn btn-success waves-effect" data-toggle="modal" data-target="#defaultModal">TAMBAH</button>-->
      <a type="button" class="btn btn-success waves-effect" href="index.php?page=tambah_desa">TAMBAH</a>
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <table id="datatable-responsive" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
          <tr>
              <th>Aksi</th>
              <th>Kode Desa</th>
              <th>Nama Desa</th>
              <th>Nama Kecamatan</th>
          </tr>
      </thead>
      <tbody>
          <?php
            $query = mysqli_query($koneksi,"SELECT
                                              tb_desa.kd_desa,
                                              tb_desa.nama_desa,
                                              tb_kecamatan.nama_kecamatan
                                              FROM
                                              tb_desa
                                              INNER JOIN tb_kecamatan ON tb_desa.kd_kecamatan = tb_kecamatan.kd_kecamatan");
            if ($query != null) {
            while ($result = mysqli_fetch_array($query)) {
             ?>
              <tr>
                <td align="center">
                  <a data-toggle="tooltip" title="UBAH DATA" href="index.php?page=edit_desa&id=<?php echo $result['kd_desa']; ?>">
                      <i class="fa fa-pencil"></i>
                  </a>
                  <a data-toggle="tooltip" title="HAPUS DATA" style="color : red;" href="pengolahan_desa/hapus_desa.php?page=hapus_desa&id=<?php echo $result['kd_desa'];?>"onclick="return confirm('Apakah yakin menghapus <?php echo $result['nama_desa'].' dari Desa'; ?> ?')">
                      <i class="fa fa-trash"></i>
                  </a>
                </td>
                <td>
                  <?php echo $result['kd_desa']; ?>
                </td>
                <td>
                  <?php echo $result['nama_desa']; ?>
                </td>
                <td>
                  <?php echo $result['nama_kecamatan']; ?>
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
