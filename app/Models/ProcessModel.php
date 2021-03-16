<?php

namespace App\Models;

use CodeIgniter\Model;

class ProcessModel extends Model
{
    protected $table      = 'processes';
    protected $primaryKey = 'id';

    protected $allowedFields = ['process_name'];
}
