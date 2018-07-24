            <style type="text/css">
            .info {
                padding: 6px 8px;
                font: 14px/16px Arial, Helvetica, sans-serif;
                background: white;
                background: rgba(255,255,255,0.8);
                box-shadow: 0 0 15px rgba(0,0,0,0.2);
                border-radius: 5px;
            }
            .info h4 {
                margin: 0 0 5px;
                color: #777;
            }
            .legend {
                line-height: 18px;
                color: #555;
            }
            .legend i {
                width: 18px;
                height: 18px;
                float: left;
                margin-right: 8px;
                opacity: 0.7;
            }
            </style>
           <div class="x_panel">
            <div id="map" style="width : 100%; height : 48em;"></div>
            <script src="lib/leaflet/leaflet.js"></script>
            <script src="geocoder/Control.OSMGeocoder.js"></script>
            <!--<script src="peta/kios.geojson"></script>-->
            <script src="peta/layer_kecamatan.geojson"></script>
            <script src="peta/data_kios.php"></script>
            <script src="peta/data_desa.php"></script>
        <script>

        var hikeLink = '<a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            osmLink = '<a href="http://openstreetmap.org">OpenStreetMap</a>',
            thunLink = '<a href="http://thunderforest.com/">Thunderforest</a>';

        var hikeUrl = 'http://{s}.tiles.wmflabs.org/hikebike/{z}/{x}/{y}.png',
            hikeAttrib = '&copy; ' + hikeLink + ' Contributors',
            osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
            osmAttrib = '&copy; ' + hikeLink + ' Contributors & '+osmLink,
            landUrl = 'http://{s}.tile.thunderforest.com/landscape/{z}/{x}/{y}.png',
            thunAttrib = '&copy; '+osmLink+' Contributors & '+thunLink;

        var hikeMap = L.tileLayer(hikeUrl, {attribution: hikeAttrib}),
            osmMap = L.tileLayer(osmUrl, {attribution: osmAttrib}),
            landMap = L.tileLayer(landUrl, {attribution: thunAttrib});

        //style
          function getKecamatanWarna(id){
            if(id == 30){
              return 'red';
            } else if (id == 12){
              return 'blue' ;
            }else if (id == 8){
              return 'white' ;
            }else if (id == 7){
              return 'green' ;
            }else if (id == 5){
              return 'yellow' ;
            }
          }

          function kecamatanStyle(feature){
            return{
              fillColor : getKecamatanWarna(feature.properties.Id),
              weight  : 2,
              opacity :1,
              color : 'black',
              dashArray : 5,
              fillOpacity : 0.7
            }
          }

          function getDesaWarna(id){
            if(id == 0502){
              return 'yellow';
            } else if (id != 0502){
              return 'blue' ;
            }
          }
          function desaStyle(feature){
            return{
              fillColor : getDesaWarna(feature.properties.kd_desa),
              weight  : 2,
              opacity :1,
              color : 'black',
              dashArray : 5,
              fillOpacity : 0.7
            }
          }

          function highlightFeature(e) {
          var layer = e.target;

              layer.setStyle({
                  weight: 5,
                  color: '#fdfdfd',
                  dashArray: '',
                  fillOpacity: 0.7
              });

              if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
                  layer.bringToFront();
              }
          }

        function resetHighlight(e) {
            desa.resetStyle(e.target);
        }

        function resetHighlight(e) {
            desa.resetStyle(e.target);
        }

        //popup informasi kecamatan
        function popupkecamatan(feature, layer) {
            var popupContent = "";
            if (feature.properties.Id) {
                popupContent += "<h5> Wilayah Tanggung Jawab </h5>"+
                                "<h5> Kecamatan : "+feature.properties.Kecamatan+"</h5>";
            }
            layer.bindPopup(popupContent);

            layer.on({
              /*mouseover: highlightFeature,
              mouseout: resetHighlight*/
            });
        }

        // popup informasi desa
        function popupdesa(feature, layer) {
            var popupContent = "";
            if (feature.properties.kd_desa) {
                popupContent += "<h5> Desa : "+feature.properties.nama_desa+"</h5>"+
                                "<h7> Kecamatan : "+feature.properties.nama_kecamatan+"</h7><br>";
            }
            layer.bindPopup(popupContent);

            layer.on({
              /*mouseover: highlightFeature,
              mouseout: resetHighlight*/
            });
        }

        // popup informasi kios
        function popupkios(feature, layer) {
            var popupContent = "";
            if (feature.properties.kd_kios) {
                popupContent += "<h5> Nama Kios         : "+feature.properties.nama_kios+"</h5>"+
                                "<h7> Penanggung Jawab  : "+feature.properties.penanggung_jawab+"</h7><br>"+
                                "<h7> Alamat  : "+feature.properties.alamat+"</h7><br>";
            }
            layer.bindPopup(popupContent);
            layer.on({
              /*  mouseover: highlightFeature,
                mouseout: resetHighlight                */
            });
        }

        var LeafIcon = L.Icon.extend({
                          options: {
                              shadowUrl: 'marker-shadow.png',
                              iconSize:     [48, 48],
                              shadowSize:   [50, 64],
                              iconAnchor:   [22, 94],
                              shadowAnchor: [4, 62],
                              popupAnchor:  [-3, -76]
                          }
                      });

        var newIcon = new LeafIcon({iconUrl:'marker-icon.png'});

        L.icon = function (options) {
            return new L.Icon(options);
        };

        //inisialisasi map
        var map = L.map('map', {
                layers: [hikeMap], // only add one!
                zoomControl:false
            })
            .setView([-7.111743744378086, 107.14028120040894], 10);

        //memangil polygon dari json
        var layerkios = L.geoJson(kios, {icon : newIcon,
                                        onEachFeature :popupkios
                                        }).addTo(map);
        var layerdesa = L.geoJson(desa, {onEachFeature :popupdesa,
                                          style :desaStyle}).addTo(map);
        var Layerkecamatan = L.geoJson(kecamatan, {onEachFeature : popupkecamatan,
                                          style :kecamatanStyle}).addTo(map);
          // popup informasi
        var baseLayers = {
            "PETA DASAR": hikeMap,
            "PETA KONTUR": landMap
        };

        var overlays = {
            "Kios" : layerkios,
            "Distribusi" : layerdesa,
            "Kecamatan" : Layerkecamatan
        };
       map.fitBounds(Layerkecamatan.getBounds());
        L.control.layers(baseLayers,overlays).addTo(map);

        //konten zoom
        L.control.zoom({
             position:'topright'
        }).addTo(map);


        function getColor(d) {
            return d > 5 ? ' #ff0000' :
                    d > 4 ? ' #FFFF00' :
                   d > 3  ? '#00FF00' :
                   d > 2  ? '#0000FF' :
                             ' 	#ffffff' ;
        }

        //legend
        var legend = L.control({position: 'bottomleft'});
        legend.onAdd = function (map) {
            var div = L.DomUtil.create('div', 'info legend');
            var labels = [
              "Kecamatan Mande",
              "Kecamatan Cikalong Kulon",
              "Kecamatan Karangtengah",
              "Kecamatan Ciranjang",
              "Kecamatan Leles"
            ];
            var grades = [1,2,3,4,5];
            div.innerHTML = '<div><b>Legenda</b></div>';
            // loop through our density intervals and generate a label with a colored square for each interval
            for (var i = 0; i < grades.length; i++) {
                div.innerHTML += '<i style="background:'
                + getColor(grades[i] + 1) + '">&nbsp;&nbsp;</i>&nbsp;&nbsp;'
                + labels[i]+'<br/>';
            }
            return div;
        };
      legend.addTo(map);

            </script>
</div>
