<?php

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;
use App\Libraries\DatabaseUtils;

class Map extends BaseController
{
    /* 
Fonction index : Fonction qui redirige vers différentes pages selon le type de filtre 
que l'utilisateur choisi. Etant donné que les filtres sont tous sur la même page,
l'information récupérée des formulaires de type 'post' doit être dans la même fonction.
*/
    public function index()
    {
        $model = model(ModelMap::class);
        $model2 = model(ModelCouches::class);

        $model3 = model(ModelRoyAfr::class);
        $model4 = model(ModelAiresAut::class);

        $model5 = model(ModelPoints::class);
        $model6 = model(ModelPolygones::class);
        helper('form');
        // affichage si l'utilisateur choisit le formulaire selon les récits
        if ($this->request->getPost('select_recit')) {


            $data2 = [
                'id_recit' => $this->request->getPost('select_recit')
            ];


            $data2 = [
                'points'  => $model->getPoints(),
                'couche'  => $model2->search_adv($data2),

                'aires' => $model4->getAiresAut(),
                'roy_afr' => $model3->getRoyAfr(),
                'pts' => $model5->search_pts($data2),
                'poly' => $model6->search_poly($data2),
            ];

            DatabaseUtils::insertVisit('map_recits');
            return view('resclaves/header')
                . view('resclaves/style')
                . view('templates/sidebar', $data2)
                . view('resclaves/accueil2', $data2)
                . view('templates/footer_resc');
        }


        // affichage si l'utilisateur choisit le formulaire selon les lieux
        else if ($this->request->getPost('select_place')) {

            $data = [
                'type' => $this->request->getPost('select_place')
            ];

            $data = [
                'points'  => $model->getPoints(),
                'place'  => $model5->search_place($data),
                'aires' => $model4->getAiresAut(),
                'roy_afr' => $model3->getRoyAfr()
            ];


            return view('resclaves/header')
                . view('resclaves/style')
                . view('templates/sidebar', $data)
                . view('resclaves/places', $data)
                . view('templates/footer_resc');
        }

        // affichage initial avec les différents récits
        else {

            $data = [
                'points'  => $model->getPoints(),
            ];


            return view('resclaves/header')
                . view('resclaves/style')
                . view('templates/sidebar', $data)
                . view('resclaves/accueil', $data)
                . view('templates/footer_resc');
        }
    }


    public function about()
    {
        DatabaseUtils::insertVisit('about');

        return view('resclaves/header')
            . view('resclaves/about_resc')
            . view('templates/footer_resc');
    }

    public function contact()
    {

        DatabaseUtils::insertVisit('contact');
        
        return view('resclaves/header')
            . view('resclaves/contact_resc')
            . view('templates/footer_resc');
    }
}
