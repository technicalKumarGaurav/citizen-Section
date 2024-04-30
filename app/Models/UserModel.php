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
        'created_at',
        'file'
    ];
    

    public function department()
    {
        return $this->belongsTo(DepartmentModel::class, 'department_id','id');
    }
    
    public function district()
    {
        return $this->belongsTo(DistrictModel::class, 'district_id');
    }
    
    public function tehsil()
    {
        return $this->belongsTo(TehsilModel::class, 'tehsil_id');
    }
    
    public function gramPanchayat()
    {
        return $this->belongsTo(GramPanchayatModel::class, 'gp_id');
    }
    
    public function village()
    {
        return $this->belongsTo(VillageModel::class, 'village_id');
    }
}