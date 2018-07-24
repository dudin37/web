<?php
 include "lib/koneksi.php";
?>
<form action="pengolahan_desa/simpan_desa.php" method="post" class="form-horizontal form-label-left">
    <div class="modal-body">
      <div class="row">
                 <div class="col-md-16">
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
                          <div id="map" style="width: 1070px; height: 400px"></div><br />
                           <input type="button" onclick="drawArea();" value="Gambar Area" /> <input type="button" onclick="resetArea();" value="Hapus Peta" /><br />
                         </div>
                   </div>
               </div>
               <div class="modal-footer">
                        <button type="submit" class="btn btn-info">TAMBAH</button>
                        <a href="index.php?page=list_desa" class="btn btn-primary">BATAL</a>
                    </div>
        </div>
    </div>
</form>
