<?php
// Remplacez ces valeurs par les vôtres

$userId = "12590816";
$apiKey = "KOxihaGOFAJo7XOhFIqvtGyg";
// clé de la collection 'test'
$key = "8QXA7IIX";


// URL de l'API Zotero
$url = "https://api.zotero.org/users/$userId/collections/$key/items";
//$url = "https://api.zotero.org/users/$userId/collections";
//$url = "https://api.zotero.org/users/$userId/collections/8QXA7IIX/items?itemType=journalArticle";


$data =[];

//foreach($keys as $key){

    //$url = "https://api.zotero.org/users/$userId/collections/$key/items?fields=-data.dateModified,-data.dateAdded,-ISBN";

    // Configuration de la requête cURL
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer $apiKey"));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    // Exécution de la requête
    $response = curl_exec($curl);
    $httpStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    // Gestion de la réponse
    if ($httpStatus == 200) {
        $data[$key] = json_decode($response, true);
        // Traitez les données ici
    
        var_dump($data);
    } else {
        echo "La requête a échoué avec le code de statut : $httpStatus";
    }

// Fermeture de la session cURL
curl_close($curl);
?>

<?php 
    $list =[
        'titre' => 'erreur',
        'auteur' => 'erreur',
        'type' => 'erreur',
        'date' => 'erreur',
        'lang' => 'erreur'
    ];

/*
    $titre ='';
    foreach ($data as &$elt){
        if($elt['data']['shortTitle'] == $valeur){
            $list =[
                'titre' => $elt['data']['title'],
                'auteur' => $elt['meta']['creatorSummary'],
                'type' => $elt['data']['itemType'],
                'date' => $elt['data']['date'],
                'lang' => $elt['data']['language']
            ];
            break;
        }
    }
    */
?>



<br><br>
<div class="container">
<p style="text-align:center; font-size:25px;padding:6px;">  
    <?= lang('view.title') ?></p>

    <div class="rec"><br>
    <p style="text-align:center; font-size:25px; font-style:italic;padding:6px;">

    <?= esc($rec['titre']) ?> </p><br>
</div>
    <br> 
    <div class="rec"><br>
    
        <div class="rec_par">
        <strong><p style="text-align:right;"><?= lang('view.year_publication') ?> :</strong> <?= esc($rec['date_publi']) ?> </p>
        <strong><p style="text-align:right;"><?= lang('view.method_publication') ?> :</strong> <?= esc($rec['mode_publi']) ?> </p>
        <strong><p style="text-align:right;"><?= lang('view.several_written_narratives') ?> :</strong> <?= esc($rec['plrs_recits']) ?> </p>

    <strong><p><?= lang('view.name_slave') ?> :</strong> <?= esc($rec['nom_esc']) ?> </p>
    <strong><p><?= lang('view.type_narrative') ?> :</strong> <?= esc($rec['type_recit']) ?> </p>

    <strong><p><?= lang('view.date_birth') ?> :</strong> <?= esc($rec['naissance']) ?> </p>
    <strong><p><?= lang('view.location_publication') ?> :</strong> <?= esc($rec['lieu_publi']) ?> </p>
    <strong><p><?= lang('view.origins_parents') ?> :</strong> <?= esc($rec['origine_parents']) ?> </p>
    <strong><p><?= lang('view.name_writer') ?> :</strong> <?= esc($rec['scribe_editeur']) ?> </p>
    <strong><p><?= lang('view.additional_information') ?> :</strong> <?= esc($rec['particularites']) ?> </p>

</div>
<br><br>

<div id="comm">
    <p style="text-align:center;">
        Commentaires / Historiographie: <br><br> 
        <?= html_entity_decode($histo) ?>

</p>
</div>

<br>
<p><?= lang('view.link_narrative') ?> : <a href="<?= esc($rec['lien_recit']) ?>"><?= esc($rec['lien_recit']) ?></a></p>


<br><br>
<div style="display:flex;">
<button class="button_return" onclick='window.location.href = 
"<?= site_url()."recits" ?>"'><p><?= lang('view.back_narratives_list_button') ?></p></button>
<button class="button_return" onclick='window.location.href = 
"<?= site_url()."map" ?>"'><p><?= lang('view.back_narratives_map_button') ?></p></button>
<br><br>
</div>
<br>
    </div>
    <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ma page</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<script>
    function afficherPopup(choix) {
  console.log("Début de l'affichage");

  var userId = "5400206";
  var apiKey = "E7a5WJBnmii1HdXPtMVRZcG1";
  var keys = [
    '7QK6BKPQ',
    'PQPUY22P',
    '8RS5C7VK',
    'LZL82L82',
    'AUL58SY9',
    '8QXA7IIX',
    'XVHKSNVS'
  ];

  var data = [];

  // Fonction pour effectuer la requête API avec une promesse
  function makeApiRequest(key) {
    console.log("Début de la requête pour la clé : " + key);
    var url = "https://api.zotero.org/users/" + userId + "/collections/" + key + "/items";

    return new Promise(function (resolve, reject) {
      $.ajax({
        url: url,
        headers: {
          'Authorization': 'Bearer ' + apiKey
        },
        method: 'GET',
        success: function (response) {
          console.log("Requête réussie pour la clé : " + key);
          data.push(response);
          resolve();
        },
        error: function (xhr, status, error) {
          console.log("Requête échouée pour la clé : " + key);
          console.error("La requête a échoué avec le code de statut : " + xhr.status);
          resolve(); // Nous résolvons toujours la promesse, même en cas d'erreur
        }
      });
    });
  }

  // Fonction pour vérifier les données et afficher la pop-up
  function checkData() {
    console.log("Début de la popup");
    var titre = "";
    var auteur = "";
    var type = "";
    var date = "";
    var lang = "";

    for (var i = 0; i < data.length; i++) {
      var items = data[i];
      for (var j = 0; j < items.length; j++) {
        var item = items[j];
        if (item.data.shortTitle === choix) {
          titre = item.data.title;
          auteur = item.meta.creatorSummary;
          type = item.data.itemType;
          date = item.data.date;
          lang = item.data.language;
          break; // Sortir de la boucle dès que vous trouvez un élément correspondant
        }
      }
    }

    // Vérifier si le titre est vide
    if (titre === "") {
            // Aucune référence trouvée, afficher un message d'erreur
            var popup = window.open('', '', 'width=400,height=200');
            popup.document.write('Référence non trouvée');
    } else {
            // Afficher les détails de la référence
            console.log("Ouverture de la popup");
            var contenuPopup = titre + ', ' + type + ' de ' + auteur + ', le ' + date + ' en ' + lang;
            var popup = window.open('', '', 'width=400,height=200');
            popup.document.write(contenuPopup);
    }
  }

  // Utilisation des promesses pour s'assurer que chaque requête est terminée avant d'afficher la popup
  var promises = [];
  for (var i = 0; i < keys.length; i++) {
    promises.push(makeApiRequest(keys[i]));
  }

  Promise.all(promises)
    .then(function () {
      checkData(); // Afficher la popup une fois que toutes les requêtes sont terminées
    })
    .catch(function (error) {
      console.error("Erreur :", error);
    });
}

</script>
