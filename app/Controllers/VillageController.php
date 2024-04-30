<?php

namespace App\Controllers;

use App\Models\VillagesModel;
use CodeIgniter\API\ResponseTrait;

class VillageController extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        
        $panchayatId = $this->request->getVar('panchayatId');
        
        if ($panchayatId !== null) {
            
            $villageModel = new VillagesModel();
            // return $villageModel;
            $villages = $villageModel->where('gram_panchayat_id', $panchayatId)->findAll();
            
            
            return $this->respond($villages);
        } else {
           
            return $this->fail('Gram Panchayat ID is required.', 400);
        }
    }
}
