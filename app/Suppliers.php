<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
  protected $fillable = [
      'name',
      'address',
      'phone',
      'telephone',
      'note',
      // add all other fields
  ];

}
