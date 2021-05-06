<?php

namespace App\Models;

use CodeIgniter\Model;

class skillModel extends Model
{
    protected $table      = 'tb_skill';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama'];
}