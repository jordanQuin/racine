<?php

namespace App\Controllers;

use App\Libraries\DatabaseUtils;

class Admin extends BaseController
{
    public function showconnexion()
    {
        DatabaseUtils::insertVisit('connexion');
        // Votre logique pour afficher la page de connexion
        return view('resclaves/header')
            . view('resclaves/connexion');
    }

    public function statistiques()
    {
        $session = \Config\Services::session();
        
        if ($session->has('is_admin') && $session->get('is_admin') === true) {
            return view('resclaves/header')
                . view('resclaves/statistiques');
        } else {
            return redirect()->to('/map');
        }
    }

    public function login()
    {
        // Obtenez les données de formulaire
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $hashpassword = hash('sha256', $password, true);
        $hashexa = bin2hex($hashpassword);

        $model = model(ModelAdmin::class);

        $storedPassword = $model->getPass($username);

        // Vérifiez les identifiants (à adapter selon votre logique de vérification)
        if ($hashexa == $storedPassword & $storedPassword !== null) {
            // Démarrer la session
            $session = \Config\Services::session();
            // Définir is_admin à true
            $session->set('is_admin', true);

            // Rediriger vers la page d'administration
            return redirect()->to('/map');
        } else {
            // Gérer l'échec de la connexion
            // ...
            //afficher un message d'erreur

            //commenté pour afficher les mdp
            return redirect()->to('/connexion');
        }
    }

    public function logout()
    {
        // Démarrer la session
        $session = \Config\Services::session();
        // Détruire la session
        $session->destroy();

        // Rediriger vers la page d'accueil ou de connexion
        return redirect()->to('/map');
    }

    public function showcreercompte()
    {
        //afficher la page de création de compte
        DatabaseUtils::insertVisit('creercompte');

        return view('resclaves/header')
            . view('resclaves/creercompte');
    }

    public function creercompte()
    {

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        //méthode de hashage probleme avec des caractères spéciaux.
        $hashpassword = hash('sha256', $password, true);
        $hashexa = bin2hex($hashpassword);

        $model = model(ModelAdmin::class);

        $issetUser = $model->issetUser($username);

        if($issetUser == null){
            $sql = 'INSERT INTO `user` (`user`, `pwd`) VALUES (\'' . $username . '\',\'' . $hashexa . '\')';
            //echo $sql;
            $db = db_connect();
            $db->query($sql);
            return redirect()->to('/connexion');
        }else{
            return redirect()->to('/creercompte');
        }
    }
}
