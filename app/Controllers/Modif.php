<?php

namespace App\Controllers;

class Modif extends BaseController
{
    public function modif()
    {
        $session = \Config\Services::session();
        $model = model(ModelFormulaire::class);
        $model1 = model(ModelGetAuteur::class);

        $data = [
            'title' => $model->getRecit(),
            'auteurs' => $model1->getAuteurs()
        ];

        $session = \Config\Services::session();

        if ($session->has('is_admin') && $session->get('is_admin') === true) {
            return view('resclaves/header')
                . view('resclaves/modif_recit', $data);
        } else {
            return redirect()->to('/map');
        }
    }

    public function ModifRecit()
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
        $prefD = $this->request->getPost('prefD');
        $nomS = $this->request->getPost('nomS');
        $lienR = $this->request->getPost('lienR');

        $idR = $_GET['idR'];

        $nomE = '';
        foreach ($data['auteurs'] as $elt) {
            if($elt['id_auteur'] == $idE){
                $nomE = $elt['nom'];
            }
        }  

        $sql = 'UPDATE `tab_recits_v3` SET `nom_esc` = ?, `titre` = ?, `date_publi` = ?, `lieu_publi` = ?, `mode_publi` = ?, `type_recit` = ?, `historiographie` = ?, `preface_blanc` = ?, `details_preface` = ?, `id_auteur` = ?, `scribe_editeur` = ?, `lien_recit` = ?, `debut_titre` = ? WHERE `id_recit` = ?';
        $db = db_connect();
        $db->query($sql, [$nomE, $nomR, $dateP, $lieuP, $modeP, $typeR, $com, $pref, $prefD, $idE, $nomS, $lienR, $nomR, $idR]);

        return redirect()->to('/recits');
    }

    public function choixModifA()
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
                . view('resclaves/choix_esclave', $data);
        } else {
            return redirect()->to('/map');
        }
    }

    public function modifA()
    {
        $model = model(ModelFormulaire::class);
        $model1 = model(ModelGetAuteur::class);

        $data = [
            'title' => $model->getRecit(),
            'auteur' => $this->request->getPost('idE'),
            'auteurs' => $model1->getAuteurs()
        ];


        $session = \Config\Services::session();

        if ($session->has('is_admin') && $session->get('is_admin') === true) {
            if(isset($_POST['idE'])){
                return view('resclaves/header')
                . view('resclaves/modif_esclave', $data);
            } else {
                return redirect()->to('/choix_esclave');
            }
        } else {
            return redirect()->to('/map');
        }
    }
    
    public function ModifAuteur()
    {
        $model = model(ModelFormulaire::class);
        $model1 = model(ModelGetAuteur::class);
        $data = [
            'title' => $model->getRecit(),
            'auteurs' => $model1->getAuteurs()
        ];

        $nomE = $this->request->getPost('nomE');
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
        $idE = $this->request->getPost('idE');
        $plrs = 'non';
        $opSource = 'non';
        $idR = 0;

        foreach($data['title'] as $elt){
            if($elt['id_auteur'] == $idE){
                $idR = $elt['id_recit'];
                $sql = 'UPDATE `tab_recits_v3` SET `nom_esc` = ? WHERE `id_recit` = ?';
                $db = db_connect();
                $db->query($sql, [$nomE, $idR]);
            }
        }

        $sql = 'UPDATE `tab_auteurs` SET `nom` = ?, `naissance` = ?, `lieu_naissance` = ?, `deces` = ?, `lieu_deces` = ?, `lieu_esclavage` = ?, `moyen_lib` = ?, `lieuvie_ap_lib` = ?, `origine_parents` = ?, `militant_abolitionniste` = ?, `particularites` = ?, `plrs_recits` = ?, `id_auteur` = ?, `op_source` = ? WHERE `id_auteur` = ?';
        $db = db_connect();
        $db->query($sql, [$nomE, $anneeN, $lieuN, $dateD, $lieuD, $lieuE, $moy, $lieuV, $origP, $mil, $part, $plrs, $idE, $opSource, $idE]);

        

        return redirect()->to('/recits');
    }
}

