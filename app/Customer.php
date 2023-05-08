<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
  protected $fillable = [
      'name',
      'address',
      'phone',
      'telephone',
      'note',
      // add all other fields
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $table = 'customers';
}
