<?php
namespace App\Models;

use CodeIgniter\Model;

class ModelFormulaire extends Model
{

    protected $table = 'tab_recits_v3';
	protected $allowedFields = ['id_recit', 'titre'];

    // TOUT LES attribue sont selectionné
    public function getRecit()
	{
	    
        return $this->asArray()
        ->findAll();

    }
}

class ModelGetPoints extends Model
{
    protected $table = 'points';
	protected $allowedFields = ['id'];

    public function getLastPoint()
    {

        $result =  $this->select('id')
                    ->orderBy('CAST(id AS UNSIGNED)', 'DESC')
                    ->limit(1)
                    ->get()
                    ->getRow();

        if ($result) {
            // Retournez l'ID en tant que chaîne
            return (string)$result->id+1;
        }
        return null;
    }
}

class ModelGetAuteur extends Model
{
    protected $table = 'tab_auteurs';
    protected $allowedFields = ['nom', 'id_auteur'];

    public function getAuteurs()
    {
        return $this->asArray()
        ->findAll();
    }
}

class ModelGetPointsid extends Model
{
    protected $table = 'points';
	protected $allowedFields = ['id','ville','type','geoj','layer'];

    public function getselecpoint($id_point)
    {
        return $this->asArray()
                    ->Where(['id' => $id_point])
                    ->get()
                    ->getRow();
    }
}