<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table = 'tasks';
    protected $primaryKey = 'id';
    // Hanya mengizinkan kolom teks, tanpa lampiran file
    protected $allowedFields = ['title', 'description', 'status'];
    protected $useTimestamps = true;
}