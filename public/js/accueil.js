
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


// Fonds de carte
    var baseMaps = {
      "OpenTopoMap": OpenTopoMap,
      "ESRI World Physical": Esri_WorldPhysical,
      "ESRI Shaded Relief": Esri_WorldShadedRelief,
      "ESRI Terrain Base": ESRI_Terrain_Base
  };

  // Ajout d'une fonctionnalité permettant le choix du fond de carte et des couches wfs
  var layerControl = L.control.layers(baseMaps).addTo(map);
