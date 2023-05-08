<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales_from extends Model
{
    //
    public function sale()
    {
        return $this->belongsTo(\App\Sale::class);
    }

    public function prds()
    {
        return $this->belongsTo(\App\Product::class,'part_num_id','id');
    }
}
