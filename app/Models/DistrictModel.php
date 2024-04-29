<?php

namespace App\Models;

use CodeIgniter\Model;

class DistrictModel extends Model
{
    protected $table = 'districts';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name'];
}
