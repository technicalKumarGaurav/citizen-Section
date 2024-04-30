<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\DepartmentModel;
use App\Models\DistrictModel;
use App\Models\DateSlotModel;
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
        
        $dateSlotModel = new DateSlotModel();
        $dates = $dateSlotModel->findAll();
        
        echo view('admin/layout/header');
        echo view('admin/dashboard/index', compact('departments', 'districts','dates'));
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
            'user_file' => 'uploaded[user_file]|max_size[user_file,1024]|ext_in[user_file,png,jpg,gif]'
        ]);
        
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
    
        // File Upload and Move Logic
        $file = $this->request->getFile('user_file');
        $newName = $file->getRandomName();
        $file->move(ROOTPATH . 'public/uploads', $newName);

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
            'created_at' => date('Y-m-d H:i:s'),
            'file'=>$newName
        ];
        $userModel->insert($inputData);
        return redirect()->route('thankyou')->with('Token', "#" . $randomNumber1 . "#" . $randomNumber2 . "#");
    }

    //
    public function thankyou()
    {
        return view('thankyou');
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
        $sql = "SELECT users.*, departments.department_name ,districts.name as district_name, tehsils.name as tehsil_name, gram_panchayats.name as panchayat_name, villages.name as village_name
        FROM users 
        JOIN departments ON departments.id = users.department_id
        JOIN districts ON districts.id = users.district_id
        JOIN tehsils ON tehsils.id = users.tehsil_id
        JOIN gram_panchayats ON gram_panchayats.id = users.gp_id
        JOIN villages ON villages.id = users.village_id
        WHERE users.id = $userId";
        $query = $userModel->query($sql);
        $results = $query->getResult();
        if (!empty($results)) {
            $user = $results[0]; 
        }
        echo view('admin/layout/header');
        echo view('admin/dashboard/user_details', compact('user'));
        echo view('admin/layout/footer');
    }


    
}
