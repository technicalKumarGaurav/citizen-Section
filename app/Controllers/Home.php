<?php

namespace App\Controllers;

use App\Models\DepartmentModel;
use App\Models\DistrictModel;
use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;

class Home extends BaseController
{
    protected $helpers = ['form'];
    use ResponseTrait;

    public function index()
    {
        $departmentModel = new DepartmentModel();
        $departments = $departmentModel->findAll();

        $districtModel = new DistrictModel();
        $districts = $districtModel->findAll();
        
        
        echo view('admin/layout/header');
        echo view('admin/dashboard/index', compact('departments', 'districts'));
        echo view('admin/layout/footer');
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required',
            'phone' => 'required|numeric',
            'district' => 'required',
            'tehsil' => 'required',
            'gp' => 'required',
            'village' => 'required',
            'slot' => 'required',
            'department' => 'required',
        ]);
    
        // Validate the request data
        if (!$validation->withRequest($this->request)->run()) {
            // Validation failed, redirect back with validation errors
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        
        // If validation passes, proceed to store data
        $name = $this->request->getPost('name');
        $phone = $this->request->getPost('phone');
        // Retrieve other form fields similarly

        // Perform data storage or further processing here
        
        return redirect()->to('success_page')->with('success', 'Data submitted successfully!');
    }
}
