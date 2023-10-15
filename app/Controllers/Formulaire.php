<?php

namespace App\Controllers;

class Formulaire extends BaseController
{

    public function getRecit()
    {
        $model = model(ModelFormulaire::class);


        $data = [
            'titre' => $this->request->getRecit()
        ];


        return view('welcome_message',$data);
    }
}
