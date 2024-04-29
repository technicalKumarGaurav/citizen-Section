<?php

namespace App\Models;

use CodeIgniter\Model;

class TehModel extends Model
{
    protected $table = 'tehsils'; // Adjusted to work with the 'tehsils' table
    protected $primaryKey = 'id'; // Assuming 'id' is the primary key column name

    protected $allowedFields = ['name', 'district_id']; // Define allowed fields for mass assignment
}
