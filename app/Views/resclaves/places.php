<br>
<div id="carte"></div>
<script> 

// Carte Leaflet 

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
	maxZoom: 7
}).addTo(map);

var OpenTopoMap = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
	maxZoom: 17,
	attribution: 'Map data: &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, <a href="http://viewfinderpanoramas.org">SRTM</a> | Map style: &copy; <a href="https://opentopomap.org">OpenTopoMap</a> (<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)'
});


// Mise en place de panneaux pour régler l'ordre des couches

map.createPane("pane_autoch").style.zIndex = 250;
map.createPane("pane_afr").style.zIndex = 253;



    // Ajout d'une échelle
    var echelle = L.control.scale().addTo(map);

    // Button to return to initial view
    L.control.resetView({
                position: "topleft",
                title: "Reset view",
                latlng: L.latLng([29.052497808641004, -45.60848140244032]),
                zoom: 3.3,
            }).addTo(map);

  
    
// Création des geojson
    <?php 
		if (! empty($place) && is_array($place)) {
			$nbt = count($place);
      $reponse = 'var place = {"type": "FeatureCollection", "features": [';
      $type = 'var type = '."'".$place[1]['type']."';";
			for ($i = 0; $i < $nbt; $i++) {
            $reponse .= '{"geometry": '.$place[$i]['geoj'].',"id": '.$place[$i]['id'].', "type": "Feature", "properties": {
                "type": "'.$place[$i]['type'].'","nom_esc": "'.$place[$i]['nom_esc'].'",
                "ville": "'.$place[$i]['ville'].'","id_recit": "'.$place[$i]['id_recit'].'",
                "date_publi": "'.$place[$i]['date_publi'].'"
            
            }},'."\r\n";
          }
          $reponse = substr($reponse,0,strlen($reponse)-1);
          $reponse .= ']};';
          echo $reponse;
          echo $type;
			}

      if (! empty($roy_afr) && is_array($roy_afr)) {
        $nbt = count($roy_afr);
        $reponse = 'var roy_afr = {"type": "FeatureCollection", "features": [';
        for ($i = 0; $i < $nbt; $i++) {
              $reponse .= '{"geometry": '.$roy_afr[$i]['geoj'].',"id": '.$roy_afr[$i]['id'].', "type": "Feature", "properties": {"Nom": "'.$roy_afr[$i]['noms'].'"}},'."\r\n";
            }
            $reponse = substr($reponse,0,strlen($reponse)-1);
            $reponse .= ']};';
            echo $reponse;
        } 

        if (! empty($aires) && is_array($aires)) {
          $nbt = count($aires);
          $reponse = 'var aires_aut = {"type": "FeatureCollection", "features": [';
          for ($i = 0; $i < $nbt; $i++) {
                $reponse .= '{"geometry": '.$aires[$i]['geoj'].',"id": '.$aires[$i]['id'].', "type": "Feature", "properties": {"id_style": "'.$aires[$i]['id_style'].'"}},'."\r\n";
              }
              $reponse = substr($reponse,0,strlen($reponse)-1);
              $reponse .= ']};';
              echo $reponse;
          }
	?>

var style_c = style_clust(type); 
var cluster = new L.MarkerClusterGroup({
        //spiderfyOnMaxZoom: true,
        //disableClusteringAtZoom: 3,
        //maxClusterRadius: 200,
        //animateAddingMarkers: false,
    iconCreateFunction: function(cluster) {
    // test grossissement en fonction de la valeur du cluster
    //  var digits = (cluster.getChildCount()+"").length;
        return L.divIcon({ 
            //html: "<div class=' " + style_c +" digits-"+ digits + " '>" + cluster.getChildCount()+"</div>",
            html: "<div class=" + style_c +">" + cluster.getChildCount()+"</div>",
            className: "", 
            iconSize: null 
        });
    }
});
console.log("test");

cluster.addLayer(L.geoJSON(place, {
    pointToLayer: function (feature, latlng) {
        var nom_esc = feature.properties.nom_esc;
        var style_test = style_pt(feature);
        return L.circleMarker(latlng, style_test);
    },
    onEachFeature: function (feature, layer) {
        var url = '<?=site_url()."recits/"?>' + feature.properties.id_recit;
        var id_recit = feature.properties.id_recit;
        var id_point = feature.id;

        layer.bindPopup(
            '<a href="' + url + '">' + "<h3 id='h3popup'>" + feature.properties.nom_esc + "</h3>" + "</a><br>" +
            "Date de publication : " + feature.properties.date_publi + "<br>" +

            "<form id='formulaire' action='<?= base_url();?>/map/recits' method='post'>"+
    " <button id='bouton' type='submit' name ='select_recit' value="+ id_recit +"> <p id='pop_carte'>Visualiser la carte du récit </p>" +
    "</button></form><br>"+
    "<form id='formulaire' action='<?= site_url('Ajout/show_modification') ?>' method='post'>"+
    "   <button id='boutonaj' name ='boutonaj' type='submit' value='"+ id_point +"'>Modifier</button>"+
    "</form>"+
    "<form  action='<?= site_url('Ajout/suppressionPoint') ?>' method='post'>"+
    "   <button id='boutonsup' name ='boutonsup' type='submit' value="+ id_point +">Supprimer</button>"+
    "</form>"
      ),

        layer.bindTooltip(feature.properties.ville, {
            permanent: true,
            direction: 'auto',
            opacity: 0.65
        }).openTooltip();

        layer.on('mouseover', function () {
            this.bindTooltip(feature.properties.ville + "<br>" + feature.properties.nom_esc, {
                permanent: false,
                direction: 'right',
                opacity: 0.65
            });
        });
    }
}));

    map.addLayer(cluster);











////////// ROYAUMES AFRICAINS //////////////
var roy_afr = L.geoJSON(roy_afr,{
      function(feature){
      var style_afr = style_afr(feature)
    },
      style: style_afr,
      onEachFeature: function (feature, layer) {
    layer.bindPopup("<p>"+feature.properties.Nom+"</p>");
    },
    pane:"pane_afr"
        }
      ).addTo(map);    


////////////////// AIRES AMERINDIENNES //////////////////
    var aires_aut = L.geoJSON(aires_aut,{
      function(feature){
      var style_autoch = style_autoch(feature)
    },
      style: style_autoch,
      pane:"pane_autoch"
      
        }
    ).addTo(map);



    // Fonds de carte
      var baseMaps = {
        "OpenTopoMap": OpenTopoMap,
        "ESRI World Physical": Esri_WorldPhysical,
        "ESRI Shaded Relief": Esri_WorldShadedRelief,
        "ESRI Terrain Base": ESRI_Terrain_Base
    };
    var overlayMaps = {
        "Aires amérindiennes": aires_aut,
        "Royaumes Africains": roy_afr,
        "Points": cluster
      };
      
    // Ajout d'une fonctionnalité permettant le choix du fond de carte et des couches
    var layerControl = L.control.layers(baseMaps, overlayMaps).addTo(map);

</script>
<br><br><br><br>


            





