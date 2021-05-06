<?php

namespace App\Models;

use CodeIgniter\Model;

class skillSuperheroModel extends Model
{
    protected $table      = 'tb_skill_superhero';
    protected $allowedFields = ['id_superhero', 'id_skill'];
}