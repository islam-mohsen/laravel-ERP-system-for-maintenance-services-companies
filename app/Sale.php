<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    //
    public function eng()
    {
        return $this->belongsTo('\App\Engineers','engineers_id');
    }
    public function cus()
    {
        return $this->belongsTo('\App\Customer','customers_id');
    }
    public function sal()
    {
        return $this->belongsTo('\App\SalesMen','sales_mens_id');
    }
}
