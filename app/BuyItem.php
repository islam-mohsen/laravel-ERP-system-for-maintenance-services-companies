<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuyItem extends Model
{
    //
    public function buy_product()
    {
        return $this->belongsTo(\App\Buy_product::class);
    }

    public function product()
    {
        return $this->belongsTo(\App\Product::class);
    }

    public function brand()
    {
        return $this->belongsTo(\App\Brand::class, 'brand_name_id', 'id');
    }

    public function dec()
    {
        return $this->belongsTo(\App\Description::class);
    }

    public function prdMod()
    {
        return $this->belongsTo(\App\Product_model::class, 'prd_mod_id', 'id');
    }
}
