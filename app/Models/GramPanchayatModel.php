<?php

namespace App\Models;

use CodeIgniter\Model;

class GramPanchayatModel extends Model
{
    protected $table = 'gram_panchayats';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'tehsil_id'];

    public function getPanchayatsByTehsil($tehsilId)
    {
        return $this->where('tehsil_id', $tehsilId)->findAll();
    }
}
