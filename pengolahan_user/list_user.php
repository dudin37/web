<?php
  include "lib/koneksi.php";
 ?>
<div class="col-md-12 col-sm-12 col-xs-12">
                        <!-- modal dialog -->
        <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="defaultModalLabel">TAMBAH DATA USER</h4>
                    </div>
                    <form action="pengolahan_user/simpan_user.php" method="post">
                    <div class="modal-body">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Username</label>
                                    <input type="text" id="username" class="form-control" name="username" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Password</label>
                                    <input type="text" id="password" class="form-control" name="password" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Nama</label>
                                    <input type="text" id="nama" class="form-control" name="nama" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Alamat</label>
                                    <input type="text" id="alamat" class="form-control" name="alamat" required>
                                </div>
                            </div> 
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Telpon</label>
                                    <input type="text" id="telp" class="form-control" name="telp" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label"></label>
                                    <select name="hak_akses" id="hak_akses" class="form-control">
                                        <option value=>Hak Akses</option>
                                        <option value="Direktur">Direktur</option>
                                        <option value="Kios">Kios</option>
                                        <option value="Marketing">Marketing</option>
                                        <option value="Admin/CS">Admin/CS</option>
                                    </select>
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
    <h2 class="nav navbar-right">DATA USER</h2>
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
              <th>Username</th>
              <th>Password</th>
              <th>Nama</th>
              <th>Alamat</th>
              <th>Telpon</th>
              <th>Hak Akses</th>
          </tr>
      </thead>
      <tbody>
          <?php
            $query = mysqli_query($koneksi,"SELECT * FROM tb_user");
            if ($query != null) {
            while ($result = mysqli_fetch_array($query)) {
             ?>
              <tr>
                <td align="center">
                  <a data-toggle="tooltip" title="UBAH DATA" href="index.php?page=edit_user&id=<?php echo $result['username']; ?>">
                      <i class="fa fa-pencil"></i>
                  </a> |
                  <a data-toggle="tooltip" title="HAPUS DATA" style="color : red;" href="pengolahan_user/hapus_user.php?page=hapus_user&id=<?php echo $result['username'];?>"onclick="return confirm('Apakah yakin menghapus <?php echo $result['password'].' dari User'; ?> ?')">
                      <i class="fa fa-trash"></i>
                  </a>
                </td>
                <td>
                  <?php echo $result['username']; ?>
                </td>
                <td>
                  <?php echo $result['password']; ?>
                </td>
                <td>
                  <?php echo $result['nama']; ?>
                </td>
                <td>
                  <?php echo $result['alamat']; ?>
                </td>
                <td>
                  <?php echo $result['telp']; ?>
                </td>
                <td>
                  <?php echo $result['hak_akses']; ?>
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
