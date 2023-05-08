<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Engineers extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'address',
        'telephone',
        'phone',

        // add all other fields

    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

        /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'engineers';

    public function products ()
{
    return $this->belongsToMany('App\Product','engineer_products','engineer_id','product_id')->withPivot('quantity');
}
public function sale()
{
    return $this->hasMany('App\Sale');
}
}
