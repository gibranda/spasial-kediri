<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link rel="stylesheet" href="qgis/css/leaflet.css" />
        <link rel="stylesheet" type="text/css" href="qgis/css/qgis2web.css">
        <link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="qgis/css/label.css" />
        <link rel="stylesheet" href="qgis/css/MarkerCluster.css" />
        <link rel="stylesheet" href="qgis/css/MarkerCluster.Default.css" />
        <script src="qgis/js/leaflet.js"></script>
        <script src="qgis/js/leaflet-heat.js"></script>
        <script src="qgis/js/leaflet.rotatedMarker.js"></script>
        <script src="qgis/js/OSMBuildings-Leaflet.js"></script>
        <script src="qgis/js/leaflet-hash.js"></script>
        <script src="qgis/js/label.js"></script>
        <script src="qgis/js/Autolinker.min.js"></script>
        <script src="qgis/js/leaflet.markercluster.js"></script>
        <style>
        #map {
            width: 1119px;
            height: 574px;
        }
        /*table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 5px;
            text-align: left;
        }*/
        </style>
        <title>SPASIAL</title>
    </head>
    <body>
        <div class="row">
        <div id="map" class="col-md-9"></div>
        <div class="col-md-3">
        <h2 id="namadesa">Desa</h2>
            <div id="data-table" style="visibility: hidden;">
            <!-- <table> -->
            <table class="table"><tr><td id="data-id" colspan="2">' + (feature.properties['OBJECTID'] !== null ? Autolinker.link(String(feature.properties['OBJECTID'])) : '') + 
            '</td></tr><tr><td colspan="2" id="data-iddesa">' + (feature.properties['FID_IDDESA'] !== null ? Autolinker.link(String(feature.properties['FID_IDDESA'])) : '') + 
            '</td></tr><tr><td colspan="2" id="data-region">' + (feature.properties['REGION'] !== null ? Autolinker.link(String(feature.properties['REGION'])) : '') + 
            '</td></tr><tr><td colspan="2" id="data-desa">' + (feature.properties['DESA'] !== null ? Autolinker.link(String(feature.properties['DESA'])) : '') + 
            '</td></tr><tr><td colspan="2" id="data-kecamatan">' + (feature.properties['KECAMATAN'] !== null ? Autolinker.link(String(feature.properties['KECAMATAN'])) : '') + 
            '</td></tr><tr><td colspan="2" id="data-kabupaten">' + (feature.properties['KABUPATEN'] !== null ? Autolinker.link(String(feature.properties['KABUPATEN'])) : '') + 
            '</td></tr><tr><td colspan="2" id="data-provinsi">' + (feature.properties['PROVINSI'] !== null ? Autolinker.link(String(feature.properties['PROVINSI'])) : '') + 
            '</td></tr><tr><td colspan="2" id="data-negara">' + (feature.properties['NEGARA'] !== null ? Autolinker.link(String(feature.properties['NEGARA'])) : '') + 
            '</td></tr><tr><td colspan="2" id="data-kodeunsur">' + (feature.properties['KODE_UNSUR'] !== null ? Autolinker.link(String(feature.properties['KODE_UNSUR'])) : '') + 
            '</td></tr><tr><td colspan="2" id="data-topnym">' + (feature.properties['TOPONYM'] !== null ? Autolinker.link(String(feature.properties['TOPONYM'])) : '') + 
            '</td></tr><tr><td colspan="2" id="data-luasdesa">' + (feature.properties['LUAS_DESA'] !== null ? Autolinker.link(String(feature.properties['LUAS_DESA'])) : '') + 
            '</td></tr><tr><td colspan="2" id="data-luaskeca">' + (feature.properties['LUAS_KECA'] !== null ? Autolinker.link(String(feature.properties['LUAS_KECA'])) : '') + 
            '</td></tr><tr><td colspan="2" id="data-luaskabu">' + (feature.properties['LUAS_KABU'] !== null ? Autolinker.link(String(feature.properties['LUAS_KABU'])) : '') + 
            '</td></tr><tr><td colspan="2" id="data-luasprov">' + (feature.properties['LUAS_PROV'] !== null ? Autolinker.link(String(feature.properties['LUAS_PROV'])) : '') + 
            '</td></tr><tr><td colspan="2" id="data-luasunsur">' + (feature.properties['LUAS_UNSUR'] !== null ? Autolinker.link(String(feature.properties['LUAS_UNSUR'])) : '') + 
            '</td></tr><tr><td colspan="2" id="data-webprov">' + (feature.properties['WEB_PROV'] !== null ? Autolinker.link(String(feature.properties['WEB_PROV'])) : '') + 
            '</td></tr><tr><td colspan="2" id="data-webkabu">' + (feature.properties['WEB_KABU'] !== null ? Autolinker.link(String(feature.properties['WEB_KABU'])) : '') + 
            '</td></tr><tr><td colspan="2" id="data-shape">' + (feature.properties['Shape_Leng'] !== null ? Autolinker.link(String(feature.properties['Shape_Leng'])) : '') + 
            '</td></tr><tr><td colspan="2" id="data-shapearea"> ' + (feature.properties['Shape_Area'] !== null ? Autolinker.link(String(feature.properties['Shape_Area'])) : '') +'</td></tr></table>
            <!-- </table> -->
        </div>
        </div>
        </div>
        
        <!-- <div id="data-table" style="visibility: hidden;"> -->
        
        <script src="qgis/data/json_Administrasi0.js"></script>
        <script>
        function toggleAppearance(){
            var dataDiv = document.getElementById("data-table");
            if(dataDiv.style.visibility == "hidden"){
                dataDiv.style.visibility = "visible";
            }
        }
        L.ImageOverlay.include({
            getBounds: function () {
                return this._bounds;
            }
        });
        var map = L.map('map', {
            zoomControl:true, maxZoom:90, minZoom:1
        }).fitBounds([[-8.02236596475,111.686067969],[-7.58931817125,112.533170232]]);
        var hash = new L.Hash(map);
        map.attributionControl.addAttribution('<a href="https://github.com/tomchadwin/qgis2web" target="_blank">qgis2web</a>');
        var feature_group = new L.featureGroup([]);
        var bounds_group = new L.featureGroup([]);
        var raster_group = new L.LayerGroup([]);
        var basemap0 = L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors,<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
            maxZoom: 90
        });
        basemap0.addTo(map);
        var initialOrder = new Array();
        var layerOrder = new Array();
        function stackLayers() {
            for (index = 0; index < initialOrder.length; index++) {
                map.removeLayer(initialOrder[index]);
                map.addLayer(initialOrder[index]);
            }
        }
        function restackLayers() {
            for (index = 0; index < layerOrder.length; index++) {
                layerOrder[index].bringToFront();
            }
        }
        layerControl = L.control.layers({},{},{collapsed:false});
        function geoJson2heat(geojson, weight) {
          return geojson.features.map(function(feature) {
            return [
              feature.geometry.coordinates[1],
              feature.geometry.coordinates[0],
              feature.properties[weight]
            ];
          });
        }
        function pop_Administrasi0(feature, layer) {
            layer.on('click', function(e) {
                var dt = document.getElementById('data-table');
                if(dt.style.visibility="hidden"){
                    dt.style.visibility="visible";
                }
                document.getElementById('data-id').innerHTML = feature.properties['OBJECTID']; 
                document.getElementById('data-iddesa').innerHTML = feature.properties['FID_IDDESA']; 
                document.getElementById('data-region').innerHTML = feature.properties['REGION']; 
                document.getElementById('data-desa').innerHTML = feature.properties['DESA']; 
                document.getElementById('data-kecamatan').innerHTML = feature.properties['KECAMATAN']; 
                document.getElementById('data-kabupaten').innerHTML = feature.properties['KABUPATEN']; 
                document.getElementById('data-provinsi').innerHTML = feature.properties['PROVINSI']; 
                document.getElementById('data-negara').innerHTML = feature.properties['NEGARA']; 
                document.getElementById('data-kodeunsur').innerHTML = feature.properties['KODE_UNSUR']; 
                document.getElementById('data-topnym').innerHTML = feature.properties['TOPONYM'];
                document.getElementById('data-luasdesa').innerHTML = feature.properties['LUAS_DESA'];
                document.getElementById('data-luaskeca').innerHTML = feature.properties['LUAS_KECA'];
                document.getElementById('data-luaskabu').innerHTML = feature.properties['LUAS_KABU'];
                document.getElementById('data-luasprov').innerHTML = feature.properties['LUAS_PROV'];
                document.getElementById('data-luasunsur').innerHTML = feature.properties['LUAS_UNSUR'];
                document.getElementById('data-webprov').innerHTML = feature.properties['WEB_PROV'];
                document.getElementById('data-webkabu').innerHTML = feature.properties['WEB_KABU'];
                document.getElementById('data-shape').innerHTML = feature.properties['Shape_Leng'];
                document.getElementById('data-shapearea').innerHTML = feature.properties['Shape_Area']; 
            });
            layer.on('mouseover', function(e) {
                document.getElementById('namadesa').innerHTML = feature.properties['DESA'];
            });
            var popupContent = '<table><tr><td colspan="2">' + (feature.properties['OBJECTID'] !== null ? Autolinker.link(String(feature.properties['OBJECTID'])) : '') + '</td></tr><tr><td colspan="2">' + (feature.properties['FID_IDDESA'] !== null ? Autolinker.link(String(feature.properties['FID_IDDESA'])) : '') + '</td></tr><tr><td colspan="2">' + (feature.properties['REGION'] !== null ? Autolinker.link(String(feature.properties['REGION'])) : '') + '</td></tr><tr><td colspan="2">' + (feature.properties['DESA'] !== null ? Autolinker.link(String(feature.properties['DESA'])) : '') + '</td></tr><tr><td colspan="2">' + (feature.properties['KECAMATAN'] !== null ? Autolinker.link(String(feature.properties['KECAMATAN'])) : '') + '</td></tr><tr><td colspan="2">' + (feature.properties['KABUPATEN'] !== null ? Autolinker.link(String(feature.properties['KABUPATEN'])) : '') + '</td></tr><tr><td colspan="2">' + (feature.properties['PROVINSI'] !== null ? Autolinker.link(String(feature.properties['PROVINSI'])) : '') + '</td></tr><tr><td colspan="2">' + (feature.properties['NEGARA'] !== null ? Autolinker.link(String(feature.properties['NEGARA'])) : '') + '</td></tr><tr><td colspan="2">' + (feature.properties['KODE_UNSUR'] !== null ? Autolinker.link(String(feature.properties['KODE_UNSUR'])) : '') + '</td></tr><tr><td colspan="2">' + (feature.properties['TOPONYM'] !== null ? Autolinker.link(String(feature.properties['TOPONYM'])) : '') + '</td></tr><tr><td colspan="2">' + (feature.properties['LUAS_DESA'] !== null ? Autolinker.link(String(feature.properties['LUAS_DESA'])) : '') + '</td></tr><tr><td colspan="2">' + (feature.properties['LUAS_KECA'] !== null ? Autolinker.link(String(feature.properties['LUAS_KECA'])) : '') + '</td></tr><tr><td colspan="2">' + (feature.properties['LUAS_KABU'] !== null ? Autolinker.link(String(feature.properties['LUAS_KABU'])) : '') + '</td></tr><tr><td colspan="2">' + (feature.properties['LUAS_PROV'] !== null ? Autolinker.link(String(feature.properties['LUAS_PROV'])) : '') + '</td></tr><tr><td colspan="2">' + (feature.properties['LUAS_UNSUR'] !== null ? Autolinker.link(String(feature.properties['LUAS_UNSUR'])) : '') + '</td></tr><tr><td colspan="2">' + (feature.properties['WEB_PROV'] !== null ? Autolinker.link(String(feature.properties['WEB_PROV'])) : '') + '</td></tr><tr><td colspan="2">' + (feature.properties['WEB_KABU'] !== null ? Autolinker.link(String(feature.properties['WEB_KABU'])) : '') + '</td></tr><tr><td colspan="2">' + (feature.properties['Shape_Leng'] !== null ? Autolinker.link(String(feature.properties['Shape_Leng'])) : '') + '</td></tr><tr><td colspan="2">' + (feature.properties['Shape_Area'] !== null ? Autolinker.link(String(feature.properties['Shape_Area'])) : '') + '</td></tr><tr><td colspan="2">' + '<a href=data.php?'+feature.properties['OBJECTID']+'>show<a/>' +'</td></tr></table>';
            // var popupContent = '<table><tr><td colspan="2">' ++ '</td></tr></table>';
            // toggleAppearance();
            // layer.openPopup();
            // layer.bindPopup(popupContent);

        }



        // function showTable(feature, layer){
            
        // }

        function doStyleAdministrasi0(feature) {
            return {
                weight: 1.04,
                color: '#000000',
                fillColor: '#d6cd68',
                dashArray: '',
                lineCap: 'square',
                lineJoin: 'bevel',
                opacity: 1.0,
                fillOpacity: 1.0
            };
        }
        var json_Administrasi0JSON = new L.geoJson(json_Administrasi0, {
            onEachFeature: pop_Administrasi0,
            style: doStyleAdministrasi0
        });
        layerOrder[layerOrder.length] = json_Administrasi0JSON;
        bounds_group.addLayer(json_Administrasi0JSON);
        initialOrder[initialOrder.length] = json_Administrasi0JSON;
        feature_group.addLayer(json_Administrasi0JSON);
        raster_group.addTo(map);
        feature_group.addTo(map);
        stackLayers();
        map.on('overlayadd', restackLayers);
        </script>
    </body>
</html>
