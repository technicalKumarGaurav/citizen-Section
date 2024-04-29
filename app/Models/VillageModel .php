<?php

namespace App\Models;

use CodeIgniter\Model;

class VillageModel extends Model
{
    protected $table = 'villages';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'gram_panchayat_id'];

    public function getVillagesByPanchayat($panchayatId)
    {
        return $this->where('gram_panchayat_id', $panchayatId)->findAll();
    }
}
