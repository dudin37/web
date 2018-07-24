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
            <script src="peta/layer_desa.geojson"></script>
            <script src="peta/layer_kecamatan.geojson"></script>
            <script src="peta/layer_kios.geojson"></script>
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
          function getKecamatanWarna(iD){
            if(iD == 30){
              return 'red';
            } else if (iD == 12){
              return 'blue' ;
            }else if (iD == 8){
              return 'white' ;
            }else if (iD == 7){
              return 'green' ;
            }else if (iD == 5){
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
        //inisialisasi map
        var map = L.map('map', {
                layers: [hikeMap], // only add one!
                zoomControl:false
            })
            .setView([-7.111743744378086, 107.14028120040894], 10);

        //memangil polygon dari json
        var Layerdesa = L.geoJson(desa).addTo(map);
        var Layerkecamatan = L.geoJson(
          kecamatan, {style :kecamatanStyle}).addTo(map);
        var Layerkios = L.geoJson(kios).addTo(map);
        // popup informasi

        var baseLayers = {
            "PETA DASAR": hikeMap,
            "PETA KONTUR": landMap
        };

        var overlays = {
            "Kios" : Layerkios,
            "Area Distribusi" : Layerdesa,
            "Wilayah Tanggung Jawab" : Layerkecamatan
        };
       map.fitBounds(Layerkecamatan.getBounds());
        L.control.layers(baseLayers,overlays).addTo(map);

        //konten zoom
        L.control.zoom({
             position:'topright'
        }).addTo(map);


        function getColor(d) {
            return d > 5 ? '#ff0000' :
                   d > 3  ? '#ff8a00' :
                   d > 2  ? '#2BD69C' :
                             '#66ff00' ;
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
