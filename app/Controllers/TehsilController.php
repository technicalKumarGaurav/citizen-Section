<?php

namespace App\Controllers;

use App\Models\TehModel;
use CodeIgniter\API\ResponseTrait;

class TehsilController extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        // Get district ID from the query parameters
        $districtId = $this->request->getVar('districtId');
  
        // Check if district ID is provided
        if ($districtId !== null) {
            // Fetch tehsils for the specified district
            
            $tehsilModel = new TehModel();
            
            $tehsils = $tehsilModel->findAll();
           
            
            // Return tehsils as JSON response
            return $this->respond($tehsils);
        } else {
            // District ID is not provided, return empty response or appropriate error
            return $this->fail('District ID is required.', 400);
        }
    }
}
