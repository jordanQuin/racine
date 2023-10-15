<!doctype html>
<html lang="fr"> 
<head>
<meta charset="utf-8" />


<!-- Import de la librairie Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
 
<!-- Style Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- jQuery (ajax) -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>





<!-- Leaflet Marker Cluster -->
    <script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>
		<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css">
		<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css">

<!-- Reset View button-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@drustack/leaflet.resetview/dist/L.Control.ResetView.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@drustack/leaflet.resetview/dist/L.Control.ResetView.min.js"></script>

    <script src="https://unpkg.com/Leaflet.Deflate/dist/L.Deflate.js"></script>
    
 <!-- Librairie datatable -->   
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.13.2/datatables.min.css"/>
 
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.2/datatables.min.js"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/css/style.css"   media="screen">
<!-- Leaflet fullscreen-->
    <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
  <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css' rel='stylesheet'/>
</head>

<body>

  <!--Modification de la couleur du fond directement dans le code, non fonctionnel-->
<style>
   body{
     background-color:#FAEBD7;
   }
  </style>

<nav class="navbar navbar-expand-lg ">
	<a class="navbar-brand" href="<?= site_url()."map" ?>">Accueil</a>
  <a class="navbar-brand" href="<?= site_url()."recits" ?>">Liste des récits</a>
</nav>

<h1 class=tprinc> Slave narratives </h1>
<h3> every voice needs to be heard </h3>

