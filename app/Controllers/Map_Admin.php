<?php
  
namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

class Map_Admin extends BaseController
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
    if ($this->request->getPost('select_recit'))
    {
       

        $data2 = [
            'id_recit' => $this->request->getPost('select_recit')
        ];
        
    
        $data2 = [
        'points'  => $model->getPoints(),
        'couche'  => $model2->search_adv($data2),

        'aires' => $model4->getAiresAut(),
        'roy_afr' => $model3->getRoyAfr(),
        'pts' => $model5->search_pts($data2),
        'poly'=> $model6->search_poly($data2),
        ];

        
        return view ('resclaves/headergeo_admin')
        .view('resclaves/style_admin')
        . view ('templates/sidebar_admin',$data2)
        . view ('resclaves/accueil2_admin',$data2)
        . view ('templates/footer_resc_admin');
    }


    // affichage si l'utilisateur choisit le formulaire selon les lieux
    else if  ($this->request->getPost('select_place')) 
    {

        $data = [
        'type' => $this->request->getPost('select_place')
    ];

    $data = [
    'points'  => $model->getPoints(),
    'place'  => $model5->search_place($data),
    'aires' => $model4->getAiresAut(),
    'roy_afr' => $model3->getRoyAfr()
    ];
        

    return view ('resclaves/headergeo_admin')
    .view('resclaves/style')
    . view ('templates/sidebar', $data)
    . view ('resclaves/places',$data)
    . view ('templates/footer_resc');

    }

    // affichage initial avec les différents récits
    else {

        $data = [
            'points'  => $model->getPoints(),
            ];
            
        
        return view ('resclaves/headergeo_admin')
        .view('resclaves/style_admin')
        . view ('templates/sidebar_admin',$data)
        . view ('resclaves/accueil_admin',$data)
        . view ('templates/footer_resc_admin');
    }


    
}


    public function about()
    {

        return view ('resclaves/header_recit_admin')
        . view ('resclaves/about_resc')
        . view ('templates/footer_resc');
    }
    
    public function contact()
    {

        return view ('resclaves/header_recit_admin')
        . view ('resclaves/contact_resc')
        . view ('templates/footer_resc');
    }






}

