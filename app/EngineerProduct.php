<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class EngineerProduct extends Model
{
    //
    protected $fillable = [
        'quantity',
        'engineer_id',
        'product_id',

        // add all other fields
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'engineer_products';
}
