<?php

namespace App\Controllers;

use App\Libraries\DatabaseUtils;

class Ajout extends BaseController
{
    public function point()
    {
        $model = model(ModelFormulaire::class);


        $data = [
            'title' => $model->getRecit(),
        ];

        $session = \Config\Services::session();

        if ($session->has('is_admin') && $session->get('is_admin') === true) {
            DatabaseUtils::insertVisit('ajout_point');

            return view('resclaves/header')
                . view('resclaves/ajout_point', $data);
        } else {
            return redirect()->to('/map');
        }
    }

    public function InsertPoint()
    {
        $model = model(ModelFormulaire::class);
        $model1 = model(ModelGetPoints::class);

        $coord = $this->request->getPost('coord');
        $ville = $this->request->getPost('ville');
        $type = $this->request->getPost('type');
        $id_recit = $this->request->getPost('recit');
        $id_point = $model1->getLastPoint();

        //if si >10

        $layer = 'points_R' . $id_recit . '_pt_' . $type;

        $licoord = is_string($coord) ? explode(',', $coord) : [];
        $licoord = count($licoord) === 2 ? $licoord : [];
        $wkt = 'POINT (' . $licoord[0] . ' ' . $licoord[1] . ')';
        $geoj = '{\"type\": \"Point\", \"coordinates\": [' . $licoord[1] . ', ' . $licoord[0] . ']}';

        // recupérer le dernier id de point

        $sql = 'INSERT INTO `points` (`WKT`, `ville`, `layer`,`id`, `id_recit`, `type`, `geoj`) VALUES (\'' . $wkt . '\',\'' . $ville . '\',\'' . $layer . '\',\'' . $id_point . '\',\'' . $id_recit . '\',\'' . $type . '\',\'' . $geoj . '\')';
        //echo $sql;
        $db = db_connect();
        $db->query($sql);

        return redirect()->to('/map');
    }

    public function recit()
    {
        $model = model(ModelFormulaire::class);
        $model1 = model(ModelGetAuteur::class);


        $data = [
            'title' => $model->getRecit(),
            'auteurs' => $model1->getAuteurs()
        ];

        $session = \Config\Services::session();

        if ($session->has('is_admin') && $session->get('is_admin') === true) {

            DatabaseUtils::insertVisit('ajout_recit');

            return view('resclaves/header')
                . view('resclaves/ajout_recit', $data);
        } else {
            return redirect()->to('/map');
        }
    }

    public function InsertRecit()
    {
        $model = model(ModelFormulaire::class);
        $model1 = model(ModelGetAuteur::class);
        $data = [
            'title' => $model->getRecit(),
            'auteurs' => $model1->getAuteurs()
        ];

        $nomR = $this->request->getPost('nomR');
        $idE = $this->request->getPost('idE');
        $lieuP = $this->request->getPost('lieuP');
        $infoSup = $this->request->getPost('infoSup');
        $dateP = $this->request->getPost('dateP');
        $typeR = $this->request->getPost('typeR');
        $pref = $this->request->getPost('pref');
        $com = $this->request->getPost('com');
        $modeP = $this->request->getPost('modeP');
        $dateN = $this->request->getPost('dateN');
        $nomS = $this->request->getPost('nomS');
        $lienR = $this->request->getPost('lienR');

        $prefD = "il écrit lui-même l'introduction";
        $idR = 0;
        foreach ($data['title'] as $elt) {
            if($elt['id_recit'] > $idR){
                $idR = $elt['id_recit'];
            }
        }
        $idR ++;

        $nomE = '';
        foreach ($data['auteurs'] as $elt) {
            if($elt['id_auteur'] == $idE){
                $nomE = $elt['nom'];
            }
        }  



        /*$sql = 'INSERT INTO `tab_recits_v3` (`nom_esc`, `titre`, `date_publi`,`lieu_publi`, `mode_publi`, `type_recit`, `historiographie`, `preface_blanc`, `details_preface`, `id_auteur`, `id_recit`, `scribe_editeur`, `lien_recit`, `debut_titre`) VALUES (\'' . $nomE . '\',\'' . $nomR . '\',\'' . $dateP . '\',\'' . $lieuP . '\',\'' . $modeP . '\',\'' . $typeR . '\',\'' . $com . '\'' . $pref . '\'' . $prefD . '\'' . $idE . '\'' . $idR . '\'' . $nomS . '\'' . $lienR . '\'' . $nomR . '\')';
        //echo $sql;*/
        $sql = 'INSERT INTO `tab_recits_v3` (`nom_esc`, `titre`, `date_publi`, `lieu_publi`, `mode_publi`, `type_recit`, `historiographie`, `preface_blanc`, `details_preface`, `id_auteur`, `id_recit`, `scribe_editeur`, `lien_recit`, `debut_titre`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $db = db_connect();
        $db->query($sql, [$nomE, $nomR, $dateP, $lieuP, $modeP, $typeR, $com, $pref, $prefD, $idE, $idR, $nomS, $lienR, $nomR]);

        return redirect()->to('/map');
    }

    public function show_modification()
    {   
        $session = \Config\Services::session();
        $model1 = model(ModelFormulaire::class);
        $model = model(ModelGetPointsid::class);
        $id_point = $this->request->getPost('boutonaj');

        $data = $model->getselecpoint($id_point);

        if ($session->has('is_admin') && $session->get('is_admin') === true && isset($_POST['boutonaj'])) {
            $var = explode('[', $data->geoj);
            $var = explode(']', $var[1]);
            $var = explode(',', $var[0]);
    
            $coord = $var[1].', '.$var[0];
            $ville = $data->ville;
            $id_recit = $data->id_recit;
            $type = $data->type;
    
            $data = [
                'coord' => $coord,
                'ville' => $ville,
                'type' => $type,
                'title' => $model1->getRecit(),
                'id_point' => $id_point,
                'id_recit' => $id_recit
            ];

            return view('resclaves/header')
            . view('resclaves/modifier_point',$data);
        } else {
            return redirect()->to('/map');
        }
    }

    public function modificationPoint()
    {
        //suppression du point
        $db = db_connect();
        $id_point = $this->request->getPost('id_point');

        $sql = 'DELETE FROM points WHERE `points`.`id` ='.$id_point.'';
        $db->query($sql);


        //creation du nouveau point
        $model = model(ModelFormulaire::class);
        $model1 = model(ModelGetPoints::class);

        $coord = $this->request->getPost('coord');
        $ville = $this->request->getPost('ville');
        $type = $this->request->getPost('type');
        $id_recit = $this->request->getPost('recit');
        $id_point = $model1->getLastPoint();

        //if si >10

        $layer = 'points_R' . $id_recit . '_pt_' . $type;

        $licoord = is_string($coord) ? explode(',', $coord) : [];
        $licoord = count($licoord) === 2 ? $licoord : [];
        $wkt = 'POINT (' . $licoord[0] . ' ' . $licoord[1] . ')';
        $geoj = '{\"type\": \"Point\", \"coordinates\": [' . $licoord[1] . ', ' . $licoord[0] . ']}';

        // recupérer le dernier id de point

        $sql = 'INSERT INTO `points` (`WKT`, `ville`, `layer`,`id`, `id_recit`, `type`, `geoj`) VALUES (\'' . $wkt . '\',\'' . $ville . '\',\'' . $layer . '\',\'' . $id_point . '\',\'' . $id_recit . '\',\'' . $type . '\',\'' . $geoj . '\')';
        //echo $sql;
        $db->query($sql);

        return redirect()->to('/map');
    }

    public function suppressionPoint()
    {
        //suppression du point
        $db = db_connect();
        $id_point = $this->request->getPost('boutonsup');

        $sql = 'DELETE FROM points WHERE `points`.`id` ='.$id_point.'';
        $db->query($sql, [$id_point]);

        return redirect()->to('/map');
    }

    public function auteur()
    {
        $model = model(ModelFormulaire::class);
        $model1 = model(ModelGetAuteur::class);
        $data = [
            'title' => $model->getRecit(),
            'auteurs' => $model1->getAuteurs()
        ];

        $session = \Config\Services::session();

        if ($session->has('is_admin') && $session->get('is_admin') === true) {
            DatabaseUtils::insertVisit('ajout_esclave');

            return view('resclaves/header')
                . view('resclaves/ajout_esclave', $data);
        } else {
            return redirect()->to('/map');
        }
    }

    public function InsertAuteur()
    {
        $model = model(ModelFormulaire::class);
        $model1 = model(ModelGetAuteur::class);
        $data = [
            'title' => $model->getRecit(),
            'auteurs' => $model1->getAuteurs()
        ];

        $nomR = $this->request->getPost('nomR');
        $anneeN = $this->request->getPost('anneeN');
        $lieuN = $this->request->getPost('lieuN');
        $dateD = $this->request->getPost('dateD');
        $lieuD = $this->request->getPost('lieuD');
        $lieuE = $this->request->getPost('lieuE');
        $moy = $this->request->getPost('moy');
        $lieuV = $this->request->getPost('lieuV');
        $origP = $this->request->getPost('origP');
        $mil = $this->request->getPost('mil');
        $part = $this->request->getPost('part');

        $idA = 0;
        foreach ($data['auteurs'] as $elt) {
            if($elt['id_auteur'] > $idA){
                $idA = $elt['id_auteur'];
            }
        }
        $idA ++;

        $plrs = "non";
        $opS = "";

        $sql = 'INSERT INTO `tab_auteurs` (`nom`, `naissance`, `lieu_naissance`, `deces`, `lieu_deces`, `lieu_esclavage`, `moyen_lib`, `lieuvie_ap_lib`, `origine_parents`, `militant_abolitionniste`, `particularites`, `plrs_recits`, `id_auteur`, `op_source`)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $db = db_connect();
        $db->query($sql, [$nomR, $anneeN, $lieuN, $dateD, $lieuD, $lieuE, $moy, $lieuV, $origP, $mil, $part, $plrs, $idA, $opS]);


        return redirect()->to('/map');
    }
}
