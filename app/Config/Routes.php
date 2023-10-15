<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

use App\Controllers\News;
use App\Controllers\Pages;

use App\Controllers\Map;
use App\Controllers\Map_Admin;

use App\Controllers\Admin;

use App\Controllers\Recits;
use App\Controllers\Recits_Admin;

use App\Controllers\Ajout;
use App\Controllers\Modif;
use App\Controllers\Suppr;


// Routes créées pour le projet récits

//Pages visibles
$routes->match(['get', 'post'],'/', [Map::class, 'index']);
$routes->match(['get', 'post'],'/map', [Map::class, 'index']);
$routes->match(['get', 'post'],'/recits', [Recits::class, 'index']);
$routes->match(['get', 'post'],'/connexion', [Admin::class, 'showconnexion']);
$routes->match(['get', 'post'],'/creercompte',[Admin::class, 'showcreercompte']);
$routes->match(['get', 'post'],'/about', [Map::class, 'about']);
$routes->match(['get', 'post'],'/contact', [Map::class, 'contact']);
$routes->match(['get', 'post'], '/map/recits', [Map::class, 'index']);
$routes->match(['get', 'post'], '/map/places', [Map::class, 'index']);
$routes->match(['get', 'post'],'recits/(:segment)', [Recits::class, 'view']);
$routes->match(['get', 'post'], '/map/recits2', [Map::class, 'index']);
$routes->match(['get', 'post'],'/ajout_point', [Ajout::class, 'point']);
$routes->match(['get', 'post'],'/ajout_recit', [Ajout::class, 'recit']);
$routes->match(['get', 'post'],'/ajout_esclave', [Ajout::class, 'auteur']);
$routes->match(['get', 'post'],'/modif_point','Ajout::show_modification');
$routes->match(['get', 'post'],'/modif_recit', [Modif::class, 'modif']);
$routes->match(['get', 'post'],'/choix_esclave', [Modif::class, 'choixModifA']);
$routes->match(['get', 'post'],'/modif_esclave', [Modif::class, 'modifA']);
$routes->match(['get', 'post'],'/suppr_esclave', [Suppr::class, 'supprA']);
$routes->match(['get', 'post'],'language/changeLanguage/(:any)', 'Language::changeLanguage/$1');
$routes->match(['get', 'post'],'statistiques', 'Admin::statistiques');

//Pages invisibles pour insertion, ..
$routes->post('Ajout/InsertPoint', 'Ajout::InsertPoint');
$routes->post('Ajout/InsertRecit', 'Ajout::InsertRecit');
$routes->post('Ajout/InsertAuteur', 'Ajout::InsertAuteur');
$routes->post('Admin/login', 'Admin::login');
$routes->post('Admin/creercompte', 'Admin::creercompte');
$routes->get('/deconnexion', 'Admin::logout');
$routes->post('/Ajout/suppressionPoint','Ajout::suppressionPoint');
$routes->post('/Ajout/modificationPoint','Ajout::modificationPoint');
$routes->get('/suppr_recit', [Suppr::class, 'suppr']);
$routes->get('Suppr/SupprRecit', 'Suppr::SupprRecit');
$routes->post('Suppr/SupprAuteur', 'Suppr::SupprAuteur');
$routes->post('Modif/ModifRecit', 'Modif::ModifRecit');
$routes->post('Modif/ModifAuteur', 'Modif::ModifAuteur');





// Routes pour le tutoriel de CodeIgniter
$routes->get('/', [Pages::class, 'index']);
$routes->match(['get', 'post'], 'news/create', [News::class, 'create']);
$routes->get('news/(:segment)', [News::class, 'view']);
$routes->get('news', [News::class, 'index']);
$routes->get('pages', [Pages::class, 'index']);
$routes->get('(:segment)', [Pages::class, 'view']);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
