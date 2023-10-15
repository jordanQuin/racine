<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAdmin extends Model
{
    protected $table = 'user';
	protected $allowedFields = ['pwd'];

    public function getPass($username)
	{
        $result = $this->select('pwd')
                        ->Where(['user.user' => $username])
                        ->limit(1)
                        ->get()
                        ->getRow();

        if ($result) {
            return (string)$result->pwd;
        }
        return null;
    }

    public function issetUser($username)
    {
        $result = $this->select('user')
                        ->Where(['user.user' => $username])
                        ->limit(1)
                        ->get()
                        ->getRow();

        if ($result) {
            return (string)$result->user;
        }
        return null;
    }
}