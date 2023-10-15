

<?php //echo $points[1]['id_recit'];
//echo "  test_url : ", site_url()."recits/".$points[1]['id_recit'] ;
?>

<br>
<div id="carte"></div>


<script> 

var map = L.map('carte').setView([29.052497808641004, -45.60848140244032],3);
map.addControl(new L.Control.Fullscreen());

// Fond ESRI relief
var Esri_WorldShadedRelief = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Shaded_Relief/MapServer/tile/{z}/{y}/{x}', {
  attribution: 'Tiles &copy; Esri &mdash; Source: Esri',
  maxZoom: 13
});

// Fond World Terrain Base
var ESRI_Terrain_Base = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Terrain_Base/MapServer/tile/{z}/{y}/{x}', {
    attribution: 'Tiles &copy; Esri &mdash; Source: USGS, Esri, TANA, DeLorme, and NPS',
    maxZoom: 13
});

// Fond ESRI World Physical
var Esri_WorldPhysical = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Physical_Map/MapServer/tile/{z}/{y}/{x}', {
  attribution: 'Tiles &copy; Esri &mdash; Source: US National Park Service',
  maxZoom: 8
}).addTo(map);

var OpenTopoMap = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
  maxZoom: 17,
  attribution: 'Map data: &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, <a href="http://viewfinderpanoramas.org">SRTM</a> | Map style: &copy; <a href="https://opentopomap.org">OpenTopoMap</a> (<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)'
});

var OpenStreetMap_Mapnik = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
	maxZoom: 19,
	attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
});


// Fonds de carte
    var baseMaps = {
      "OpenTopoMap": OpenTopoMap,
      "ESRI World Physical": Esri_WorldPhysical,
      "ESRI Shaded Relief": Esri_WorldShadedRelief,
      "ESRI Terrain Base": ESRI_Terrain_Base,
      "OpenStreetMap Standard": OpenStreetMap_Mapnik
  };

  // Ajout d'une fonctionnalité permettant le choix du fond de carte et des couches wfs
  var layerControl = L.control.layers(baseMaps).addTo(map);

    // Ajout d'une échelle
    var echelle = L.control.scale().addTo(map);

    // Button to return to initial view
    L.control.resetView({
                position: "topleft",
                title: "Reset view",
                latlng: L.latLng([29.052497808641004, -45.60848140244032]),
                zoom: 3.3,
            }).addTo(map);


// légende statique
var legend = L.control({ position: "bottomright" });
legend.onAdd = function(map) {
  var div = L.DomUtil.create("div", "legend");
  div.innerHTML += '<i class="publi"></i><span> Lieux de publication des récits </span><br>';
  return div;
};

legend.addTo(map);

// Dessin des points de publications 
    <?php 
		if (! empty($points) && is_array($points)) {
			$nbt = count($points);
			// Liste des géographies des terrains
      $reponse = 'var points_publi = {"type": "FeatureCollection", "features": [';
			for ($i = 0; $i < $nbt; $i++) {
				//echo ("geo_points.push(".$points[$i]['geoj'].");\r\n");
            $reponse .= '{"geometry": '.$points[$i]['geoj'].',"id": '.$points[$i]['id'].', "type": "Feature", "properties": {"nom_esc": "'.$points[$i]['nom_esc'].'",
              "id_recit": "'.$points[$i]['id_recit'].'",
              "date_publi": "'.$points[$i]['date_publi'].'", "ville": "'.$points[$i]['ville'].'"
            }},'."\r\n";
          }
          $reponse = substr($reponse,0,strlen($reponse)-1);
          $reponse .= ']};';
          echo $reponse;
			}
	?>
 

var style_c = style_clust("publication"); 
var cluster = new L.MarkerClusterGroup({
    iconCreateFunction: function(cluster) {
        return L.divIcon({ 
            html: "<div class="+style_c+">"+cluster.getChildCount()+"</div>", 
            className: "", 
            iconSize: null 
        });
    }
});


// Dessin des points de publication
		var f = points_publi;
    cluster.addLayer(L.geoJSON(f,{
      pointToLayer: function (feature, latlng) {
        return L.circleMarker(latlng, style_publi);
    },
  onEachFeature: function (feature, layer) {
    var url = '<?=site_url()."recits/"?>' + feature.properties.id_recit ;
    var id_recit = feature.properties.id_recit
    layer.bindPopup(

   '<a id="trya" href="' + url +'">' + "<h3 id='h3popup'>"+feature.properties.nom_esc+"</h3>" + "</a>"+
   "<p class='text_popup'>Date de publication : "+ feature.properties.date_publi+ "</p>"+
  

   "<form id='formulaire' action='<?= base_url();?>/map/recits' method='post'>"+
   " <button id='bouton' type='submit' name ='select_recit' value="+ id_recit +"> <p id='pop_carte'>Visualiser la carte du récit </p>" +
   "</button></form>"
    ),

    layer.bindTooltip(feature.properties.ville,
       {permanent: true, direction: 'auto',opacity: 0.65}
       ).openTooltip(),

      layer.on('mouseover', function () {
      this.bindTooltip(feature.properties.ville + "<br>" + feature.properties.nom_esc,
       {permanent: false, direction: 'right',opacity: 0.65}
       );
        });
  }
}));
    map.addLayer(cluster);


  var extension = cluster.getBounds();
	map.flyToBounds(extension);



</script>

<br><br><br><br><br>

            





