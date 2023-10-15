<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelMap extends Model
{
    protected $table = 'points';
	protected $allowedFields = ['id', 'ville', 'id_recit','geoj', 'nom_esc', 'titre','date_publi'];

 
    public function getPoints()
	{
	    
        return $this->asArray()
	    ->join('tab_recits_v3', 'points.id_recit = tab_recits_v3.id_recit')
        ->Where(['points.type'=> 'publication'])
        ->findAll(60);

    }


    public function getIdRec($idrec = false)
    {
        $this->join('tab_auteurs', 'tab_recits_v3.id_auteur = tab_auteurs.id_auteur');

        if ($idrec === false) {
            return $this->findAll();
        }

        return $this->where(['id_recit' => $idrec])->first();
    }



}
