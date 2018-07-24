<?php
 include "lib/koneksi.php";
?>
<form action="pengolahan_kios/simpan_kios.php" method="post" class="form-horizontal form-label-left">
    <div class="modal-body">
      <div class="row">
                 <div class="col-md-16">

                   <div class="form-group form-float">
                       <div class="form-line">
                           <label class="form-label">Nama Kios</label>
                           <input type="text" id="nama_kios" class="form-control" name="nama_kios" required>
                       </div>
                   </div>

                   <div class="form-group form-float">
                       <div class="form-line">
                           <label class="form-label">Penanggung Jawab</label>
                           <input type="text" id="penanggung_jawab" class="form-control" name="penanggung_jawab" required>
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

                   <div class="form-group form-float">
                       <div class="form-line">
                           <label class="form-label">Latitude</label>
                           <input type="text" id="lat" class="form-control" name="lat" required readonly>
                       </div>
                   </div>

                   <div class="form-group form-float">
                       <div class="form-line">
                           <label class="form-label">Longitude</label>
                           <input type="text" id="lon" class="form-control" name="lon" required readonly>
                       </div>
                   </div>

                   <div class="form-group form-float">
                       <div class="form-line">
                             <div id="map" style="width: 1070px; height: 400px"></div>
                       </div>
                   </div>

               </div>
               <div class="modal-footer">
                        <button type="submit" class="btn btn-info">TAMBAH</button>
                        <a href="marketing.php?page=list_kios" class="btn btn-primary">BATAL</a>
                    </div>
        </div>
    </div>
</form>



    <!-- <form>
      <label for="latitude">Latitude:</label>
      <input id="latitude" type="text" />
      <label for="longitude">Longitude:</label>
      <input id="longitude" type="text" />
      <div id="map" style="width: 1070px; height: 400px"></div></div>
    </form> -->
