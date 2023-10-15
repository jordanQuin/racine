<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8" />


  <!-- Import de la librairie Leaflet -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/css/commun.css"   media="screen">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/css/theme.css"   media="screen">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
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

  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/css/style.css" media="screen">
  <!-- Leaflet fullscreen-->
  <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
  <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css' rel='stylesheet' />
</head>

<body>
<?php 
 // Démarrer la session
 $session = \Config\Services::session();
 
helper('language');

use App\Libraries\DatabaseUtils;

if($session->get('visit') != 'yes'){
  $session->set('visit', 'yes');
  DatabaseUtils::insertVisit('site');
}
?>
    <!--Modification de la couleur du fond directement dans le code, non fonctionnel-->
    <style>
      body {
        background-color: #FAEBD7;
      }
    </style>

    <nav class="navbar navbar-expand-lg ">
      <a class="navbar-brand" href="<?= site_url() . "map" ?>"><?= lang('headergeo.nav_bar.home')?></a>
      <a class="navbar-brand" href="<?= site_url() . "recits" ?>"><?= lang('headergeo.nav_bar.list_narratives')?></a>

      <?php if ($session->get('is_admin')) : ?>
    <a class="navbar-brand" href="<?= site_url('statistiques') ?>"><?= lang('headergeo.nav_bar.statistics') ?></a>
      <?php endif; ?>

      <div class="language">
      <a href="#" id="changeLanguageEN" class="language-link<?php echo ($session->get('locale') === 'en') ? ' language-link-active' : ''; ?>">EN</a>
      <a href="#" id="changeLanguageFR" class="language-link<?php echo ($session->get('locale') === 'fr') ? ' language-link-active' : ''; ?>">FR</a>
      </div>
    </nav>
    
    <div id="menu_mobile_container" class="d-block d-lg-none ">
  <nav class="navbar_mobile">
    <div class="burgermobile" id="boutonburger">	
          <svg id="burger" class="ham1" viewBox="0 0 100 100" width="90" >
            <path
                class="line top"
                d="m 30,33 h40 l -42,38" />
            <path
                class="line middle"
                d="m 30,50 h 40" />
            <path
                class="line bottom"
                d="m 30,67 h40 l -42,-38" />
          </svg>
      </div>
  </nav>
  <div class="contenu_menu_mobile">
    <a  href="<?= site_url() . "map" ?>"><?php echo lang('headergeo.nav_bar.home')?></a>
    <hr />
    <a  href="<?= site_url() . "recits" ?>"><?php echo lang('headergeo.nav_bar.list_narratives')?></a>
    <hr />
    <?php if ($session->get('is_admin')) : ?>
      <a href="<?= site_url('statistiques') ?>">Statistiques</a>
      <hr />
    <?php endif; ?>
    <div class="language">
      <a href="#" id="changeLanguageEN" class="language-link<?php echo ($session->get('locale') === 'en') ? ' language-link-active' : ''; ?>">EN</a>
      <a href="#" id="changeLanguageFR" class="language-link<?php echo ($session->get('locale') === 'fr') ? ' language-link-active' : ''; ?>">FR</a>
    </div>
  </div>
</div>

    <h1 class=tprinc><?php echo lang('headergeo.title')?><?= $session->get('is_admin') ? lang('headergeo.isConnected') : '' ?> </h1>
    <h3> <?php echo lang('headergeo.subtitle')?> </h3>

    <script type="text/javascript">
      //script pour envoyer methode post pour language EN
  document.getElementById('changeLanguageEN').addEventListener('click', function(event) {
    event.preventDefault();

    var form = document.createElement('form');
    form.method = 'post';
    form.action = '<?php echo base_url('language/changeLanguage/en'); ?>';

    // Ajouter le champ pour l'ID
    var idInput = document.createElement('input');
    idInput.type = 'hidden';
    idInput.name = 'idE';
    idInput.value = '<?php echo isset($_POST['idE']) ? htmlspecialchars($_POST['idE']) : null; ?>'; // Remplacez par la valeur de votre ID
    form.appendChild(idInput);

      // Ajouter le champ pour l'ID
      var idInput = document.createElement('input');
    idInput.type = 'hidden';
    idInput.name = 'boutonaj';
    idInput.value = '<?php echo isset($_POST['boutonaj']) ? htmlspecialchars($_POST['boutonaj']) : null; ?>'; // Remplacez par la valeur de votre ID
    form.appendChild(idInput);

    document.body.appendChild(form);
    form.submit();
  });

      //script pour envoyer methode post pour language EN
      document.getElementById('changeLanguageFR').addEventListener('click', function(event) {
    event.preventDefault();

    var form = document.createElement('form');
    form.method = 'post';
    form.action = '<?php echo base_url('language/changeLanguage/fr'); ?>';

    // Ajouter le champ pour l'ID
    var idInput = document.createElement('input');
    idInput.type = 'hidden';
    idInput.name = 'idE';
    idInput.value = '<?php echo isset($_POST['idE']) ? htmlspecialchars($_POST['idE']) : null; ?>'; // Remplacez par la valeur de votre ID
    form.appendChild(idInput);

     // Ajouter le champ pour l'ID
     var idInput = document.createElement('input');
    idInput.type = 'hidden';
    idInput.name = 'boutonaj';
    idInput.value = '<?php echo isset($_POST['boutonaj']) ? htmlspecialchars($_POST['boutonaj']) : null; ?>'; // Remplacez par la valeur de votre ID
    form.appendChild(idInput);


    document.body.appendChild(form);
    form.submit();
  });
  jQuery('#menu_mobile_container').css('top',jQuery('#menu_header_bandeau').outerHeight());
  jQuery('#burger').click(function () {
    if (jQuery(this).hasClass('ouvert')) {
      jQuery('#menu_mobile_container').css('left','-100vw');
      jQuery(this).removeClass('active ouvert');
      jQuery('body').css('overflow', 'visible');
    } else {
      jQuery(this).addClass('active ouvert');
      jQuery('#menu_mobile_container').css('left','0');
      jQuery('body').css('overflow', 'hidden');
    }
  });
</script>
