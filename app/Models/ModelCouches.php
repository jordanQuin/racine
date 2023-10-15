<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelCouches extends Model
{
    protected $table = 'map3';
	protected $allowedFields = ['id', 'ville', 'id_recit','geoj', 'nom_esc', 'label', 'category'];

 
    public function search_adv($data)
	{
		$idr = $this->db->escapeLikeString($data['id_recit']);

        return $this->asArray()
        ->join('tab_recits_v3', 'map3.id_recit = tab_recits_v3.id_recit')
        ->Where(['map3.id_recit' => $idr])
        ->findAll(100);
	}

}

class ModelRoyAfr extends Model
{
    protected $table = 'roy_afr';
	protected $allowedFields = ['id','noms','geoj'];

    public function getRoyAfr()
	{
        return $this->asArray()
        ->findAll(20);
	}
}

 
class ModelAiresAut extends Model
{
    protected $table = 'autoch2';
	protected $allowedFields = ['id','id_style','geoj'];

    public function getAiresAut()
	{
        return $this->asArray()
        ->findAll(40);
	}
}

class ModelPoints extends Model
{
    protected $table = 'points';
	protected $allowedFields = ['id','type','geoj','id_recit', 'nom_esc', 'lien_recit'];

    public function search_pts($data)
	{
		$idr2 = $this->db->escapeLikeString($data['id_recit']);

        return $this->asArray()
        ->join('tab_recits_v3', 'points.id_recit = tab_recits_v3.id_recit')
        ->Where(['points.id_recit'=> $idr2])
        ->findAll();
	}
 


    public function search_place($data)
    {

		$type = $this->db->escapeLikeString($data['type']);

        return $this->asArray()
        ->join('tab_recits_v3', 'points.id_recit = tab_recits_v3.id_recit')
        ->like(['points.type'=> $type])
        ->findAll();

    }




}




class ModelPolygones extends Model
{
    protected $table = 'poly';
	protected $allowedFields = ['name_1','id_recit','type','name','label','id'];

    public function search_poly($data)
	{
		$idr = $this->db->escapeLikeString($data['id_recit']);

        return $this->asArray()
        ->join('tab_recits_v3', 'poly.id_recit = tab_recits_v3.id_recit')
        ->Where(['poly.id_recit'=> $idr])
        ->findAll();
	}
}














