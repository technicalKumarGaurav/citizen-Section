<?php

namespace App\Controllers;
error_reporting(0);
class Home extends BaseController
{
    public function index()
    {
        
        // return view('admin/dashboard/index');
        echo view('admin/layout/header');
        echo view('admin/dashboard/index');
        echo view('admin/layout/footer');
    }
}
