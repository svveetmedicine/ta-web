<?php

namespace App\Models;

use CodeIgniter\Model;

class ShoeModel extends Model
{
    protected $table = 'shoes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['brandname', 'shoename', 'size', 'color', 'condition', 'price', 'contactinfo'];
}