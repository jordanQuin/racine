<?php

namespace App\Controllers;
 
use CodeIgniter\Exceptions\PageNotFoundException;
 
class Recits_Admin extends BaseController
{
    public function index()
    {

        $model = model(ModelRecit::class);
 
        $data = [
        'recits'  => $model->get5Recits(),
        ];

        return view ('resclaves/header_recit_admin')
        . view ('resclaves/recits_admin',$data)
        . view ('templates/footer_resc_admin');
    }

    public function view($idrec = null)
    {
        $model = model(ModelRecit::class);

        $data['rec'] = $model->getIdRec($idrec);

		if (empty($data['rec'])) {
            throw new PageNotFoundException('Cannot find the news item: ' . $idre);
        }

        return view('resclaves/header_recit_admin')
            . view('resclaves/view_admin',$data)
            . view('templates/footer_resc_admin');
    }

}
