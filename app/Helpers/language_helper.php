<?php
use Config\App;
$session = \Config\Services::session();
$lang = \Config\Services::language();
$locale = (new App) -> defaultLocale;

 //On met la langue par défaut si il n'y a pas de langue
 if($session -> get('locale') == null){
    $session->set('locale', $locale);
   }

$lang->setlocale($session->get('locale'));