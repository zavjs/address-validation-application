<?php

namespace App\Models;

use CodeIgniter\Model;

class AddressModel extends Model
{
  protected $useAutoIncrement = true;
  protected $table = 'address';
  protected $allowedFields = ['address'];

  public function getAddresses()
  {
    return $this->findAll();
  }
}