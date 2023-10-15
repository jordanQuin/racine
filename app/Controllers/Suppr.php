<?php

namespace App\Controllers;

class Suppr extends BaseController
{
    public function suppr()
    {
        $model = model(ModelFormulaire::class);
        $model1 = model(ModelGetAuteur::class);

        $data = [
            'title' => $model->getRecit(),
            'auteurs' => $model1->getAuteurs()
        ];

        $session = \Config\Services::session();

        if ($session->has('is_admin') && $session->get('is_admin') === true) {
            return view('resclaves/suppr_recit', $data);
        } else {
            return redirect()->to('/map');
        }
    }

    public function SupprRecit()
    {   
        $db = db_connect();
        $idR = $_GET['idR'];

        $sql = 'DELETE FROM `tab_recits_v3` WHERE `id_recit` = ?';
        $db->query($sql, [$idR]);
        $sql = 'DELETE FROM points WHERE `points`.`id_recit` = ? ';
        $db->query($sql, [$idR]);

        return redirect()->to('/recits');
    }

    public function supprA()
    {
        $model = model(ModelFormulaire::class);
        $model1 = model(ModelGetAuteur::class);

        $data = [
            'title' => $model->getRecit(),
            'auteurs' => $model1->getAuteurs()
        ];

        $session = \Config\Services::session();

        if ($session->has('is_admin') && $session->get('is_admin') === true) {
            return view('resclaves/header')
                . view('resclaves/suppr_esclave', $data);
        } else {
            return redirect()->to('/map');
        }
    }

    public function SupprAuteur()
    {

        $model = model(ModelFormulaire::class);

        $data = [
            'title' => $model->getRecit()
        ];

        $idE = $this->request->getPost('idE');

        $idR = 0;
        foreach ($data['title'] as $elt) {
            if($elt['id_auteur'] == $idE){
                $idR = $elt['id_recit'];
                $sql = 'DELETE FROM `tab_recits_v3` WHERE `id_recit` = ?';
                $db = db_connect();
                $db->query($sql, [$idR]);

                $sql = 'DELETE FROM points WHERE `points`.`id_recit` = ? ';
                $db = db_connect();
                $db->query($sql, [$idR]);
            }
        }
        $sql = 'DELETE FROM `tab_auteurs` WHERE `id_auteur` = ?';
        $db = db_connect();
        $db->query($sql, [$idE]);

        return redirect()->to('/recits');
    }
}
