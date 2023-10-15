<?php
function traduire($texte)
{
  $session = \Config\Services::session();

    $texteATraduire = urlencode($texte);

    if($session->get('locale') == 'fr'){
        $source = 'en';
        $cible = 'fr';
      } else {
        $source = 'fr';
        $cible = 'en';
      }

      $url = "https://translate.googleapis.com/translate_a/single?client=gtx&sl=$source&tl=$cible&dt=t&q=$texteATraduire";

    // Utilisation de file_get_contents pour envoyer une requête GET à l'API
    $response = file_get_contents($url);

    // Analyser la réponse et extraire la traduction
    $traduction = json_decode($response, true);
    return $traduction[0][0][0];
}