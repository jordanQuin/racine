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
map.createPane("pane_pays").style.zIndex = 252;

 map.createPane("pane_autoch").style.zIndex = 250;

 map.createPane("pane_usa").style.zIndex = 251;

 map.createPane("pane_afr").style.zIndex = 253;

 map.createPane("pane450").style.zIndex = 450;

 map.createPane("pane550").style.zIndex = 550;


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
var legendText = "<?php echo lang('accueil.locations_birth')?>"
  var legend = L.control({ position: "bottomright" });
  var legendText2 = "<?php echo lang('accueil.locations_publication')?>"
  var legend2 = L.control({ position: "bottomright" });
  var legendText3 = "<?php echo lang('accueil.locations_life')?>"
  var legend2 = L.control({ position: "bottomright" });
  var legendText4 = "<?php echo lang('accueil.locations_death')?>"
  var legend2 = L.control({ position: "bottomright" });
  var legendText5 = "<?php echo lang('accueil.locations_slavery')?>"
  var legend2 = L.control({ position: "bottomright" });
  legend.onAdd = function(map) {
    var div = L.DomUtil.create("div", "legend");
    div.innerHTML += '<i class="naissance"></i><span>' + legendText +'</span><br> ';
    div.innerHTML += '<i class="publi"></i><span>' + legendText2 +'</span><br>';
    div.innerHTML += '<i class="lieuvie"></i><span>' + legendText3 +'</span><br>';
    div.innerHTML += '<i class="deces"></i><span>' + legendText4 +'</span><br>';
    div.innerHTML += '<i class="esclavage"></i><span>' + legendText5 +'</span><br>';
    return div;
  };

  legend.addTo(map);


// Création des différentes couches GeoJSON 

<?php 
// Les ponctuels (naissance, esclavage, décès, lieu de vie, de publication)
if (! empty($pts) && is_array($pts)) {
  $nbt = count($pts);
  $reponse = 'var place = {"type": "FeatureCollection", "features": [';
  $type = 'var type = '."'".$pts[1]['type']."';";
  for ($i = 0; $i < $nbt; $i++) {
        $reponse .= '{"geometry": '.$pts[$i]['geoj'].',"id": '.$pts[$i]['id'].', "type": "Feature", "properties": {
            "type": "'.$pts[$i]['type'].'","nom_esc": "'.$pts[$i]['nom_esc'].'",
            "ville": "'.$pts[$i]['ville'].'","id_recit": "'.$pts[$i]['id_recit'].'",
            "date_publi": "'.$pts[$i]['date_publi'].'"
        
        }},'."\r\n";
      }
      $reponse = substr($reponse,0,strlen($reponse)-1);
      $reponse .= ']};';
      echo $reponse;
      echo $type;
  }

//Frontières etatsuniennes
		if (! empty($couche) && is_array($couche)) {
			$nbt = count($couche);
      $reponse = 'var maps = {"type": "FeatureCollection", "features": [';
			for ($i = 0; $i < $nbt; $i++) {
            $reponse .= '{"geometry": '.$couche[$i]['geoj'].',"id": '.$couche[$i]['id_1'].', "type": "Feature", "properties": {"label": "'.$couche[$i]['label'].'","category": "'.$couche[$i]['category'].'"}},'."\r\n";
          }
          $reponse = substr($reponse,0,strlen($reponse)-1);
          $reponse .= ']};';
          echo $reponse;
			}
 //Royaumes africains
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
// Aires autochtones amérindiennes
        if (! empty($aires) && is_array($aires)) {
          $nbt = count($aires);
          $reponse = 'var aires_aut = {"type": "FeatureCollection", "features": [';
          for ($i = 0; $i < $nbt; $i++) {
                $reponse .= '{"geometry": '.$aires[$i]['geoj'].',"id": '.$aires[$i]['id'].', "type": "Feature", "properties": {"id_style": "'.$aires[$i]['id_style'].'",}},'."\r\n";
              }
              $reponse = substr($reponse,0,strlen($reponse)-1);
              $reponse .= ']};';
              echo $reponse;
          }

 // Les polygones correspondant aux pays et états         
            if (! empty($poly) && is_array($poly)) {
              $nbt = count($poly);
              $reponse = 'var poly = {"type": "FeatureCollection", "features": [';
              $type = 'var type_pays =[';
              for ($i = 0; $i < $nbt; $i++) {
                    $reponse .= '{"geometry": '.$poly[$i]['geoj'].',"id": '.$poly[$i]['id'].', "type": "Feature", "properties": {"type": "'.$poly[$i]['type'].'"
                    ,"id_recit":"'.$poly[$i]['id_recit'].'",
                    "name":"'.$poly[$i]['name'].'"
                  }},'."\r\n";
                    $type .="'".$poly[$i]['type']."',";
                  }
                  $reponse = substr($reponse,0,strlen($reponse)-1);
                  $reponse .= ']};';
                  $type.= '];';
                 echo $reponse;
                 echo $type;
              }    
            
	?>

fillop = 0.7; weight = 0.2; 
  naissance = "#1CB1C4";
  deces = "#6E2168";
  lieuvie = "#20A238";
  esclavage = "#2E4C9B";
  publication = "#ED6D1D";


// Dessin des polygones (pays et états)
var pays = L.geoJSON(poly,{
  style: function(feature) {
        switch (feature.properties.type) {
          case 'naissance': return {fillColor: naissance, color: "#000", weight: weight,
          opacity: 1,fillOpacity: fillop
        } ;
          case 'publication': return {fillColor: publication, color: "#000", weight: weight,
          opacity: 1, fillOpacity: fillop
        } ;
          case 'deces': return { fillColor: deces, color: "#000", weight: weight,
          opacity: 1, fillOpacity: fillop
        } ;
          case 'lieuvie': return {
          fillColor: lieuvie, color: "#000", weight: weight,
          opacity: 1, fillOpacity: fillop
        } ;
        case 'lieuvie_deces': return {
          fillColor: lieuvie, color: deces, weight: 2.5,
          opacity: 1, fillOpacity: fillop
        } ;
          case 'esclavage': return { fillColor: esclavage, color: "#000", weight: weight,
          opacity: 1, fillOpacity: fillop
        } ;
          case 'naissance_esclavage': return { fillColor: esclavage, color: naissance, weight: 2.5,
          opacity: 1, fillOpacity: fillop
        } ;
          case 'esclavage_lieuvie': return { fillColor: esclavage, color: lieuvie, weight: 2.5,
          opacity: 1, fillOpacity: fillop
        } ;
          case 'esclavage_lieuvie_deces': return { fillColor: esclavage, color: lieuvie, weight: 2.5,
          opacity: 1, fillOpacity: fillop
        } ;
          case 'naissance_esclavage_lieuvie_deces': return { fillColor: esclavage, color: "#000", weight: weight,
          opacity: 1, fillOpacity: fillop
        } ;
        }
    },pane:"pane_pays",
    onEachFeature: function (feature, layer) {
    layer.bindPopup("<p>"+feature.properties.name+"</p>");
    }
        }
      ).addTo(map);




// Création des clusters
var style_c = style_clust("publication"); 
  var cluster = new L.MarkerClusterGroup({
      iconCreateFunction: function(cluster) {
          return L.divIcon({ 
              html: "<div class="+style_c+">"+cluster.getChildCount()+"</div>", 
              className: "", 
              iconSize: null 
          });
      }
  })

//ajout des points au cluster
     
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
    var extension = cluster.getBounds();
    map.flyToBounds(extension);


///////////// FRONTIERES USA //////////////////
    var maps = L.geoJSON(maps,{
        style:{
          color:"black",
          fillColor:"lightgrey",
          fillOpacity:0.1,
          weight:0.4
        },
        pane: "pane_usa",
  onEachFeature: function (feature, layer) {
    layer.bindPopup("<p>"+feature.properties.label+"</p>");
    }}
        ).addTo(map);


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
      pane:"pane_autoch",
      
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


            





