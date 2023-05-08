<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{    use SoftDeletes;

    //
    public function dec()
    {
        return $this->belongsTo(\App\Description::class);
    }

    public function brand()
    {
        return $this->belongsTo(\App\Brand::class, 'brand_name_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo(\App\Product_type::class, 'prd_type_id', 'id');
    }

    public function prdMod()
    {
        return $this->belongsTo(\App\Product_model::class);
    }

    public function buy()
    {
        return $this->hasOne(\App\Buy_product::class, 'id', 'id');
    }

    public function saleItem()
 {
        return $this->hasMany(\App\Sales_from::class,'id', 'part_num_id' );
    }

    public function engineers ()
{
    return $this->belongsToMany('App\Engineers','engineer_products','product_id','engineer_id')->withPivot('quantity');
}

    public function roomOFProduct ()
    {
     return $this->belongsTo(\App\Room_of_prd::class,'part_num_id','id');
     }
protected $fillable = [
    'brand_name_id',
    'dec_id',
    'part_num',
    'part_num_hp',
    'prd_mod_id',
    'prd_type_id',
    'cost',
    'min',
    'img',

    // add all other fields
];

}
