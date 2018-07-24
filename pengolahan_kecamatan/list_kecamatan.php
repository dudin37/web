<?php
  include "lib/koneksi.php";
 ?>
<div class="col-md-12 col-sm-12 col-xs-12">
                        <!-- modal dialog -->
        <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="defaultModalLabel">TAMBAH DATA KECAMATAN</h4>
                    </div>
                    <form action="pengolahan_kecamatan/simpan_kecamatan.php" method="post">
                    <div class="modal-body">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Kode Kecamatan</label>
                                    <input type="text" id="kd_kecamatan" class="form-control" name="kd_kecamatan" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Nama Kecamatan</label>
                                    <input type="text" id="nama_kecamatan" class="form-control" name="nama_kecamatan" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                  <div>
                                  <label>Polygon</label>
                                    <textarea class="form-control" name="polygon" id="polygon" placeholder="Masukan koordinat polygon" readonly=""></textarea>
                                  </div>
                                  <input type="button" onclick="getGeoPoints();" value="Tambahkan Koordinat Polygon" />
                                    <!-- peta -->
                                  <div id="map" style="width: 400px; height: 250px"></div><br />
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
    <h2 class="nav navbar-right">DATA KECAMATAN</h2>
    <ul class="nav navbar-left_col ">
      <!--<button type="button" class="btn btn-success waves-effect" data-toggle="modal" data-target="#defaultModal">TAMBAH</button>-->
      <a type="button" class="btn btn-success waves-effect" href="index.php?page=tambah_kec">TAMBAH</a>
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <table id="datatable-responsive" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
          <tr>
              <th>Aksi</th>
              <th>Kode Kecamatan</th>
              <th>Nama Kecamatan</th>
          </tr>
      </thead>
      <tbody>
          <?php
            $query = mysqli_query($koneksi,"SELECT * FROM tb_kecamatan");
            if ($query != null) {
            while ($result = mysqli_fetch_array($query)) {
             ?>
              <tr>
                <td align="center">
                  <a data-toggle="tooltip" title="UBAH DATA" href="index.php?page=edit_kecamatan&id=<?php echo $result['kd_kecamatan']; ?>">
                      <i class="fa fa-pencil"></i>
                  </a> |
                  <a data-toggle="tooltip" title="HAPUS DATA" style="color : red;" href="pengolahan_kecamatan/hapus_kecamatan.php?page=hapus_kecamatan&id=<?php echo $result['kd_kecamatan'];?>"onclick="return confirm('Apakah yakin menghapus <?php echo $result['nama_kecamatan'].' dari Kecamatan'; ?> ?')">
                      <i class="fa fa-trash"></i>
                  </a>
                </td>
                <td>
                  <?php echo $result['kd_kecamatan']; ?>
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
