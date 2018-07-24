<?php
 include "lib/koneksi.php";
?>
<form action="pengolahan_kecamatan/simpan_kecamatan.php" method="post" class="form-horizontal form-label-left">
    <div class="modal-body">
      <div class="row">
                 <div class="col-md-16">
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
