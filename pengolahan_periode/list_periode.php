<?php
  include "lib/koneksi.php";
?>
<div class="col-md-12 col-sm-12 col-xs-12">
  <!-- modal dialog -->
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
  <h4 class="modal-title" id="defaultModalLabel">TAMBAH DATA PERIODE</h4>
</div>
<form action="pengolahan_periode/simpan_periode.php" method="post">
  <div class="modal-body">
      <div class="form-group form-float" hidden>
          <div class="form-line">
              <label class="form-label">id periode</label>
              <input type="text" id="id_periode" class="form-control" name="id_periode">
          </div>
      </div>

      <div>
      <label>Bulan</label>
      <select name="periode" class="form-control show-tick" data-live-search="true" required="true">
          <option selected disabled>-Pilih Bulan-</option>
          <option  value="Januari">-Januari-</option>
          <option  value="Februari">-Februari-</option>
          <option  value="Maret">-Maret-</option>
          <option  value="April">-April-</option>
          <option  value="Mei">-Mei-</option>
          <option  value="Juni">-Juni-</option>
          <option  value="Juli">-Juli-</option>
          <option  value="Agustus">-Agustus-</option>
          <option  value="September">-September-</option>
          <option  value="Oktober">-Oktober-</option>
          <option  value="Nopember">-Nopember-</option>
          <option  value="Desember">-Desember-</option>

      </select>
      </div>
      <div class="form-group form-float">
          <div class="form-line">
              <label class="form-label">Tahun</label>
               <input type="text" id="Tahun"  class="form-control tahun" name="Tahun" required>
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

<div class="x_panel">
  <div class="x_title">
    <h2 class="nav navbar-right">Data Periode</h2>
    <ul class="nav navbar-left_col ">
       <button type="button" class="btn btn-success waves-effect" data-toggle="modal" data-target="#defaultModal">TAMBAH</button>
    <!-- <a type="button" class="btn btn-success waves-effect" href="marketing.php?page=tambah_kios">TAMBAH</a> -->
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <table id="datatable-responsive" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
          <tr>
              <th>Aksi</th>
              <th>Bulan</th>
              <th>Tahun</th>
          </tr>
      </thead>
      <tbody>
          <?php
            $query = mysqli_query($koneksi,"SELECT
                                                *
                                                FROM
                                                tb_periode"
                                              );
            if ($query != null) {
            while ($result = mysqli_fetch_array($query)) {
             ?>
              <tr>
                <td align="center">
                  <a data-toggle="tooltip" title="UBAH DATA" href="marketing.php?page=edit_periode&id=<?php echo $result['id_periode']; ?>">
                      <i class="fa fa-pencil"></i>
                  </a>
                  <a data-toggle="tooltip" title="HAPUS DATA" style="color : red;" href="pengolahan_periode/hapus_periode.php?page=hapus_periode&id=<?php echo $result['id_periode'];?>"onclick="return confirm('Apakah yakin menghapus <?php echo $result['periode'].' dari Data Periode'; ?> ?')">
                      <i class="fa fa-trash"></i>
                  </a>
                </td>
                <td>
                  <?php echo $result['periode']; ?>
                </td>
                <td>
                  <?php echo $result['Tahun']; ?>
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
