<?php

namespace App\Models;

use CodeIgniter\Model;

class TehModel extends Model
{
    protected $table = 'tehsils'; 
    protected $primaryKey = 'id'; 

    protected $allowedFields = ['name', 'district_id']; 
    
}
