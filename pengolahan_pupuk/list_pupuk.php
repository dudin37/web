<?php
  include "lib/koneksi.php";
 ?>
<div class="col-md-12 col-sm-12 col-xs-12">
                        <!-- modal dialog -->
        <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="defaultModalLabel">TAMBAH DATA PUPUK</h4>
                    </div>
                    <form action="pengolahan_pupuk/simpan_pupuk.php" method="post">
                    <div class="modal-body">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Kode Pupuk</label>
                                    <input type="text" id="kd_pupuk" class="form-control" name="kd_pupuk" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Nama Pupuk</label>
                                    <input type="text" id="nama_pupuk" class="form-control" name="nama_pupuk" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Stok</label>
                                    <input type="text" id="stok" class="form-control" name="stok" onkeypress="return hanyaAngka(event)"required>
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
                            <div>
                            <label>Produsen</label>
                            <select name="produsen" class="form-control show-tick" data-live-search="true" required="true">
                                <option selected disabled>Pilih Produsen</option>
                                <option value="PT PUPUK KUJANG">PT PUPUK KUJANG</option>
                                <option value="PT PUPUK PETROKIMIA">PT PUPUK PETROKIMIA</option>
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
    <h2 class="nav navbar-right">DATA PUPUK</h2>
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
              <th>Kode Pupuk</th>
              <th>Nama Pupuk</th>
              <th>Stok Pupuk</th>
              <th>Produsen Pupuk</th>
          </tr>
      </thead>
      <tbody>
          <?php
            $query = mysqli_query($koneksi,"SELECT * FROM tb_pupuk");
            if ($query != null) {
            while ($result = mysqli_fetch_array($query)) {
             ?>
              <tr>
                <td align="center">
                  <a data-toggle="tooltip" title="UBAH DATA" href="index.php?page=edit_pupuk&id=<?php echo $result['kd_pupuk']; ?>">
                      <i class="fa fa-pencil"></i>
                  </a> |
                  <a data-toggle="tooltip" title="HAPUS DATA" style="color : red;" href="pengolahan_pupuk/hapus_pupuk.php?page=hapus_pupuk&id=<?php echo $result['kd_pupuk'];?>"onclick="return confirm('Apakah yakin menghapus <?php echo $result['nama_pupuk'].' dari Data Pupuk'; ?> ?')">
                      <i class="fa fa-trash"></i>
                  </a>
                </td>
                <td>
                  <?php echo $result['kd_pupuk']; ?>
                </td>
                <td>
                  <?php echo $result['nama_pupuk']; ?>
                </td>
                <td>
                  <?php echo $result['stok']; ?>
                </td>
                <td>
                  <?php echo $result['produsen']; ?>
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
