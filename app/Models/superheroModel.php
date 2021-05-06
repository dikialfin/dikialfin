<?php

namespace App\Models;

use CodeIgniter\Model;

class superheroModel extends Model
{
    protected $table      = 'tb_superhero';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'jenis_kelamin'];
}