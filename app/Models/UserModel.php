<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_name',
        'phone',
        'district_id',
        'tehsil_id',
        'gp_id',
        'village_id',
        'slot',
        'department_id',
        'token',
        'created_at'
    ];
    
}