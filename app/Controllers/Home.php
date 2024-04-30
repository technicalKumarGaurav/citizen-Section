<?php

namespace App\Controllers;

use App\Models\UserModel;
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
    
        
        if (!$validation->withRequest($this->request)->run()) {
            
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        // var_dump($_POST);
        // die();
        $randomNumber1 = mt_rand(100, 999); 
        $randomNumber2 = mt_rand(100, 999);
        $userModel = new UserModel();
        $inputData = [
            'user_name' => $this->request->getPost('name'),
            'phone' => $this->request->getPost('phone'),
            'district_id' => $this->request->getPost('district'),
            'tehsil_id' => $this->request->getPost('tehsil'),
            'gp_id' => $this->request->getPost('gp'),
            'village_id' => $this->request->getPost('village'),
            'slot' => $this->request->getPost('slot'),
            'department_id' => $this->request->getPost('department'),
            'token' => "#" . $randomNumber1 . "#" . $randomNumber2 . "#",
            'created_at' => date('Y-m-d H:i:s')
        ];
        $userModel->insert($inputData);
        return redirect()->route('thankyou')->with('Token', "#" . $randomNumber1 . "#" . $randomNumber2 . "#");
    }

    //
    public function thnakyou()
    {
        return "Thank you";
    }
    //
    public function status()
    {       
        $usersModel = new UserModel();
        $sql = "SELECT users.*, departments.department_name 
                FROM users 
                JOIN departments ON departments.id = users.department_id";

        $query = $usersModel->query($sql);

        $usersData = $query->getResult();
        echo view('admin/layout/header');
        echo view('admin/dashboard/status', compact('usersData'));
        echo view('admin/layout/footer');
    }

    public function userDetails($userId)
    {
        $userModel = new UserModel();
        $user = $userModel->find($userId);
        // print_r($user);
        // die();
        echo view('admin/layout/header');
        echo view('admin/dashboard/user_details', compact('user'));
        echo view('admin/layout/footer');
    }
}
