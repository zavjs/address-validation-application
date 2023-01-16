<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsModel extends Model
{
  protected $table = 'address';
  protected $allowedFields = ['address'];
}