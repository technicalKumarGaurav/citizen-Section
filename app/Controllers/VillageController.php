<?php

namespace App\Controllers;

use App\Models\VillageModel;
use CodeIgniter\API\ResponseTrait;

class VillageController extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $panchayatId = $this->request->getVar('panchayatId');

        if ($panchayatId !== null) {
            // Load the Village model
            $villageModel = new VillageModel();
            
            // Fetch villages for the specified Gram Panchayat ID
            $villages = $villageModel->where('panchayat_id', $panchayatId)->findAll();
            
            // Respond with villages in JSON format
            return $this->respond($villages);
        } else {
            // Respond with an error if Gram Panchayat ID is not provided
            return $this->fail('Gram Panchayat ID is required.', 400);
        }
    }
}
