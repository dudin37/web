<?php
  include "lib/koneksi.php";
?>
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="x_panel">
  <div class="x_title">
    <h2 class="nav navbar-right">Data Kios</h2>
    <ul class="nav navbar-left_col ">
      <!--  <button type="button" class="btn btn-success waves-effect" data-toggle="modal" data-target="#defaultModal">TAMBAH</button>-->
    <a type="button" class="btn btn-success waves-effect" href="marketing.php?page=tambah_kios">TAMBAH</a>
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <?php include 'peta/petaadmin.php'; ?>
    <table id="datatable-responsive" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
          <tr>
              <th>Aksi</th>
              <th>Nama Kios</th>
              <th>Alamat</th>
              <th>Desa</th>
              <th>Penanggung Jawab</th>
          </tr>
      </thead>
      <tbody>
          <?php
            $query = mysqli_query($koneksi,"SELECT
                                                tb_kios.kd_kios,
                                                tb_kios.nama_kios,
                                                tb_kios.alamat,
                                                tb_kios.penanggung_jawab,
                                                tb_desa.nama_desa
                                                FROM
                                                tb_kios
                                                INNER JOIN tb_desa ON tb_kios.kd_desa = tb_desa.kd_desa"
                                              );
            if ($query != null) {
            while ($result = mysqli_fetch_array($query)) {
             ?>
              <tr>
                <td align="center">
                  <a data-toggle="tooltip" title="UBAH DATA" href="marketing.php?page=edit_kios&id=<?php echo $result['kd_kios']; ?>">
                      <i class="fa fa-pencil"></i>
                  </a>
                  <a data-toggle="tooltip" title="HAPUS DATA" style="color : red;" href="pengolahan_kios/hapus_kios.php?page=hapus_kios&id=<?php echo $result['kd_kios'];?>"onclick="return confirm('Apakah yakin menghapus <?php echo $result['nama_kios'].' dari Data Kios'; ?> ?')">
                      <i class="fa fa-trash"></i>
                  </a>
                </td>
                <td>
                  <?php echo $result['nama_kios']; ?>
                </td>
                <td>
                  <?php echo $result['alamat']; ?>
                </td>
                <td>
                  <?php echo $result['nama_desa']; ?>
                </td>
                <td>
                  <?php echo $result['penanggung_jawab']; ?>
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
