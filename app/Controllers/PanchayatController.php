<?php

namespace App\Controllers;

use App\Models\GramPanchayatModel;
use CodeIgniter\API\ResponseTrait;

class PanchayatController extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $tehsilId = $this->request->getVar('tehsilId');
        

        if ($tehsilId !== null) {
            
            $panchayatModel = new GramPanchayatModel();
            
            $panchayats = $panchayatModel->where('tehsil_id', $tehsilId)->findAll();
            
            return $this->respond($panchayats);
        } else {

            return $this->fail('Tehsil ID is required.', 400);
        }
    }
}
