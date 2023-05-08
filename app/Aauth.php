<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aauth extends Model
{
    //
    public function product()
    {
        return $this->belongsTo(\App\Product::class, 'part_num', 'id');
    }
}
