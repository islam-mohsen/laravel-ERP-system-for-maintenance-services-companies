<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buy_product extends Model
{
    //

public function buyItem (){

    return $this->hasMany('BuyItem');
}
    public function supplier()
    {
        return $this->belongsTo(\App\Suppliers::class);
    }


}
