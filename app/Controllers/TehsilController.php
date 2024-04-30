<?php

namespace App\Controllers;

use App\Models\TehModel;
use CodeIgniter\API\ResponseTrait;

class TehsilController extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $districtId = $this->request->getVar('districtId');
  
        
        if ($districtId !== null) {
            
            $tehsilModel = new TehModel();
            
            $tehsils = $tehsilModel->where('district_id', $districtId)->findAll();
           
            return $this->respond($tehsils);
        } else {

            return $this->fail('District ID is required.', 400);
        }
    }
}
